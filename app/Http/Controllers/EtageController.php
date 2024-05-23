<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ListIp;
use App\Models\Batiment;
use App\Models\Etage;
use App\Models\Bureau;
use App\Models\Port;
use App\Models\Commutateur;
class EtageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($theid)
    {
        $batiment = Batiment::find($theid);
        $etages = Etage::where('batiment_id', $theid)->orderBy('num')->get();
        return view('batiment.layout',['theid'=>$theid,'etages'=>$etages]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($theid)
    {
        return view('etage.create',compact('theid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$theid)
    {
        $request->validate([
            'num' => [
                'required',
                Rule::unique('etages', 'num')->where('batiment_id', $theid),
            ],
            'nbbureau' => 'required',
        ]);
        if ($user = Auth::user()) {
            $batiment = Batiment::find($theid);
            $input = $request->all();
            $etage =new Etage($input);
            $etage->batiment_id = $theid;
            $etage->batiment()->associate($batiment);
            $etage->save();
            $batiment->nbetage++;
            $batiment->etages()->save($etage);
            $batiment->save();
            for($i=1;$i<=$etage->nbbureau;$i++)
            {
                $bureau = new Bureau([
                'titre'=>'',
                'num' => $i,
                'etage_id'=>$etage->id,
                'nbport'=>0, 
            ]);
            // Associate the bureau with the etage
            $bureau->etage()->associate($etage);
            $bureau->save();
            }
        return redirect()->route('etage.show',$etage->id);
        }
        else
        {
// User is not authenticated, handle accordingly (e.g., redirect to login)
            return redirect()->route('login'); // Adjust the route accordingly
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Etage $etage,$theid)
    {
        $etage=Etage::find($theid);
        $bureaux = Bureau::where('etage_id', $theid)->orderBy('num')->get();
        return view('etage.layout',['etage'=>$etage,'bureaux'=>$bureaux,'batiment_id'=>$etage->batiment_id]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etage $etage,$theid)
    {
        return view('etage.edit',['etage'=>$etage,'theid'=>$theid]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etage $etage,$theid)
    {
        $request->validate([
            'num' => [
                'required',
                Rule::unique('etages', 'num')->where('batiment_id', $theid),
            ],
        ]);
        $input=$request->all();
        $etage->update($input);
        return redirect()->route('batiment.show',$theid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etage $etage,$theid)
    {
        $listips = ListIp::where('batiment_id', $theid)->get();
        foreach($listips as $listip)
        {
            $listip->bureau_id = 0; 
            $listip->port_id = 0;
            $listip->save();
        }
        $cesbureaux=Bureau::where('etage_id',$etage->id)->get();
        foreach($cesbureaux as $bureau)
        {
            $ports = Port::where('bureau_id', $bureau->id)->get();
            foreach($ports as $port)
            {
                $com = Commutateur::find($port->commutateur_id);
                if ($com) {
                    $com->nbportdispo++;
                    $com->save();
                }
            }

        }
        
        $etage->delete();
        $batiment = Batiment::find($theid);
        $batiment->nbetage--;
        $batiment->save();
        return redirect()->route('batiment.show',[$theid]);
    }
}

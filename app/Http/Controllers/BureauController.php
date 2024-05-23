<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ListIp;
use App\Models\Etage;
use App\Models\Bureau;
use App\Models\Commutateur;
use App\Models\Port;
class BureauController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($theid)
    {
        return view('bureau.create',compact('theid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$theid)
    {
        $request->validate([
            'titre'=>'',
            'num' => [
                'required',
                Rule::unique('bureaux', 'num')->where('etage_id', $theid),
            ],
            'nbport' => 'required',
        ]);
        if ($user = Auth::user()) {
            $etage = Etage::find($theid);
            $input = $request->all();
            $bureau =new Bureau($input);
            $bureau->etage_id = $theid;
            $bureau->etage()->associate($etage);
            $bureau->save();
            $etage->nbbureau++;
            $etage->bureaux()->save($bureau);
            $etage->save();         
            for($i=1;$i<=$bureau->nbport;$i++)
            {
                $port = new Port([
                'num' => $i,
                'bureau_id'=>$bureau->id,
                'commutateur_id'=>0,
                'active'=>false, 
            ]);
            // Associate the bureau with the etage
            $port->bureau()->associate($bureau);
            $port->save();
            }
        return redirect()->route('bureau.show',[$bureau->id,$etage->batiment_id]);
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
    public function show(Bureau $bureau,$theid,$batiment_id)
    {
        $bureau=Bureau::find($theid);
        $ports =Port::where('bureau_id', $theid)->orderBy('num')->get();
        $listips = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $theid)->get();
        return view('bureau.layout',['bureau'=>$bureau,'ports'=>$ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bureau $bureau,$theid)
    {
        return view('bureau.edit',['bureau'=>$bureau,'theid'=>$theid]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bureau $bureau,$theid)
    {
        $unnumero=$bureau->num;
        $bureau->num=-1;
        $bureau->update();
        $request->validate([
            'titre'=>'',
            'num' => [
                'required',
                Rule::unique('bureaux', 'num')->where('etage_id', $theid),
            ],
        ]);
        $bureau->num=$unnumero;
        $input=$request->all();
        $bureau->update($input);
        return redirect()->route('etage.show',$theid);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bureau $bureau,$theid)
    {
        
        $etage = Etage::find($theid);
        $listips = ListIp::where('batiment_id', $etage->batiment_id)->get();        
        foreach($listips as $listip)
        {
            $listip->bureau_id = 0; 
            $listip->port_id = 0;
            $listip->save();
        }
        $ports = Port::where('bureau_id', $bureau->id)->get();
        foreach($ports as $port)
        {
            $com = Commutateur::find($port->commutateur_id);
            if ($com) {
                $com->nbportdispo++;
                $com->save();
            }
        }
        $etage->nbbureau--;
        $etage->save();
        $bureau->delete();
        return redirect()->route('etage.show',$theid);
    }
}

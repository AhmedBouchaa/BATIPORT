<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Commutateur;
use App\Models\ListIp;
use App\Models\Etage;
use App\Models\Bureau;
use App\Models\Port;
use App\Models\Batiment;
class CommutateurController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create($batiment_id)
    {
        return view('commutateur.create',compact('batiment_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$batiment_id)
    {
         $request->validate([
            'num' => [
                'required',
                Rule::unique('commutateurs', 'num')->where('batiment_id', $batiment_id),
            ],
            'nbport' => 'required',
        ]);
        if ($user = Auth::user()) {
            $batiment = Batiment::find($batiment_id);
            $input = $request->all();
            $commutateur =new Commutateur($input);
            $commutateur->batiment_id = $batiment_id;
            $commutateur->nbportdispo=$request->nbport;
            $commutateur->batiment()->associate($batiment);
            $commutateur->save();   
            $batiment->nbcommut++;
            $batiment->commutateurs()->save($commutateur);
            $batiment->save();     
            return redirect()->route('batiment.show',$batiment_id);
        }
        else
        {
// User is not authenticated, handle accordingly (e.g., redirect to login)
            return redirect()->route('login'); // Adjust the route accordingly
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Commutateur $commutateur,$theid)
    {
        $listips = ListIp::where('batiment_id', $theid)->get();

        foreach($listips as $listip)
        {
            $listip->bureau_id = 0; 
            $listip->port_id = 0;
            $listip->save();
        }

        $ports = Port::where('commutateur_id', $commutateur->id)->get();
        foreach($ports as $port)
        {
            $port->commutateur_id = 0; 
            $port->active = !$port->active;
            $port->save();
        }

        $commutateur->delete();
        $batiment = Batiment::find($theid);
        $batiment->nbcommut--;
        $batiment->save();
        return redirect()->route('batiment.show',[$theid]);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\ListIp;
use App\Models\Commutateur;
use App\Models\Port;
use App\Models\Bureau;
class PortController extends Controller
{
    public function change(Request $request,$pid,$bid,$batiment_id)
    {
        $bureau = Bureau::find($bid);
        $port = Port::find($pid);
        if(!$port->active)
        {
            $listip = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', 0)
                        ->where('port_id', 0)
                        ->first();
            $com = Commutateur::where('batiment_id',$batiment_id)
                    ->where('num', $request->input('switchNumber'))
                    ->first();
            if (!$com){
                session()->flash('error', 'il n\'y a pas un commutateur de ce numero');
                $ports = Port::where('bureau_id', $bid)->orderBy('num')->get();
                $listips = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $bid)->get();
                return view('bureau.layout', ['bureau' => $bureau, 'ports' => $ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);
            }
            if ($listip && $com && $com->nbportdispo>=1){
                $com->nbportdispo--;
                $com->ports()->save($port);
                $com->save();
                $listip->bureau_id = $bid;
                $listip->port_id = $pid;
                $listip->save();
                $port->active = !$port->active;
                $port->commutateur_id =$com->id;
                $port->save();
                $ports = Port::where('bureau_id', $bid)->orderBy('num')->get();
                $listips = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $bid)->get();
                return view('bureau.layout',['bureau'=>$bureau,'ports'=>$ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);

            }
            else{
                if($com->nbportdispo==0)
                {
                    session()->flash('error', 'il n\'y a des port disponible dan le commutateur '.$com->num);
                }
                else
                {
                    session()->flash('error', 'il n\'y a pas assez d\'adresse ip');
                }
                $ports = Port::where('bureau_id', $bid)->orderBy('num')->get();
                $listips = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $bid)->get();
                return view('bureau.layout', ['bureau' => $bureau, 'ports' => $ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);
            }
        }
        else
        {
            $com=Commutateur::find($port->commutateur_id);
            $com->nbportdispo++;
            $com->ports()->save($port);
            $com->save();
            $listip = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $bid)
                        ->where('port_id', $pid)
                        ->first();
            if ($listip) {
                $listip->bureau_id = 0; // ou la valeur initiale appropriée
                $listip->port_id = 0; // ou la valeur initiale appropriée
                $listip->save();
                $port->active = !$port->active;
                $port->commutateur_id =0;
                $port->save();
                $ports = Port::where('bureau_id', $bid)->orderBy('num')->get();
                $listips = ListIp::where('batiment_id', $batiment_id)
                ->where('bureau_id', $bid)->get();
                return view('bureau.layout',['bureau'=>$bureau,'ports'=>$ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);
            }

        }
    }
    public function create($theid,$batiment_id)
    {
        $bureau = Bureau::find($theid);
        $ports = Port::where('bureau_id', $theid)->orderBy('num')->get();
        $port = new Port([
                'num' => $ports->count()+1,
                'commutateur_id'=>0,
                'bureau_id'=>$theid,
                'active'=>false,]);
        $port->bureau()->associate($bureau);
        $port->save();
        $ports = Port::where('bureau_id', $theid)->orderBy('num')->get();
        $listips = ListIp::where('batiment_id', $batiment_id)
                        ->where('bureau_id', $theid)->get();
        return view('bureau.layout',['bureau'=>$bureau,'ports'=>$ports,'batiment_id'=>$batiment_id,'listips'=>$listips]);
    }
}

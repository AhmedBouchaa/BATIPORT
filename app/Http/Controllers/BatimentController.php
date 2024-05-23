<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Batiment;
use App\Models\Commutateur;
use App\Models\User;
use App\Models\Etage;
use App\Models\ListIp;
use Illuminate\Http\Request;
class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $batiments = Batiment::where('user_id', $user->id)->get();
        return view('dashboard',['batiments'=>$batiments]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('batiment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
        [
            'name' => 'required',
            'descr' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'type_reseaux'=>'required|in:A,B,C',
            'adresse_reseau' =>
            [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // Validation conditionnelle basée sur le type_reseaux
                    if ($request->input('type_reseaux') == 'A') {
                        if (!preg_match('/^\d{1,3}\.0\.0\.0$/', $value)) {
                            $fail(__('Le champ :attribute doit correspondre au modèle pour le type A.'));
                        }
                    }
                    elseif ($request->input('type_reseaux') == 'B') {
                        if (!preg_match('/^\d{1,3}\.\d{1,3}\.0\.0$/', $value)) {
                            $fail(__('Le champ :attribute doit correspondre au modèle pour le type B.'));
                        }
                    }
                    elseif ($request->input('type_reseaux') == 'C') {
                        if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.0$/', $value)) {
                            $fail(__('Le champ :attribute doit correspondre au modèle pour le type C.'));
                        }
                    }
                    $typeReseaux = $request->input('type_reseaux');
                    $isUnique = !Batiment::where('type_reseaux', $typeReseaux)
                    ->where('adresse_reseau', $value)
                    ->exists();
                    if (!$isUnique) {
                        $fail(__('L\'adresse réseau :attribute doit être unique pour le type de réseau spécifié (cette adresse est reservée).'));
                    }
                },
            ],
        ]);
        if ($user = Auth::user()) {
            $input = $request->all();
            if ($image = $request->file('image')) {
                $destinationPath = 'images/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = $profileImage;
            }

            $batiment = new Batiment($input);
            $batiment->user_id = $user->id;
            $batiment->nbetage=0;
            $batiment->nbcommut=0;
            $user->batiments()->save($batiment);

            $this->ajouterAdressesListIP($batiment->id,$request->input('type_reseaux'), $input['adresse_reseau']);
            return redirect()->route('batiment.show',$batiment->id);
        }
        else
        {
            return redirect()->route('login');
        }
    }
    
    private function ajouterAdressesListIP($theid,$typeReseaux, $adresseReseau)
    {
        if ($typeReseaux == 'A') {
            for ($i = 0; $i <= 10; $i++) {
                for ($j = 0; $j <= 255; $j++) {
                    for ($k = 0; $k <= 255; $k++) {
                        if(!($i==0 && $j==0 && $k==0))
                        {
                            $adresse = "";
                            for($l=0;$l<strlen($adresseReseau)-5;$l++)
                            {
                                $adresse .= $adresseReseau[$l];
                            }
                            $adresse .= "$i.$j.$k";
                            ListIP::create(['adresseIP' => $adresse,'batiment_id'=>$theid,'bureau_id'=>0,'port_id'=>0,'type_reseaux'=>$typeReseaux]);
                        }
                    }
                }
            }
        }
        elseif ($typeReseaux == 'B') {
            for ($i = 0; $i <= 255; $i++) {
                for ($j = 0; $j <= 255; $j++) {
                    if(!($i==0 && $j==0))
                    {
                        $adresse = "";
                        for($k=0;$k<strlen($adresseReseau)-3;$k++)
                        {
                            $adresse .= $adresseReseau[$k];
                        }
                    $adresse.= "$i.$j";
                    ListIP::create(['adresseIP' => $adresse,'batiment_id'=>$theid,'bureau_id'=>0,'port_id'=>0,'type_reseaux'=>$typeReseaux]);
                    }
                }
            }
        }
        elseif ($typeReseaux == 'C') {
            for ($i = 1; $i <=255; $i++) {
                $adresse = "";
                for($l=0;$l<strlen($adresseReseau)-1;$l++)
                {
                    $adresse .= $adresseReseau[$l];
                }
                $adresse .= "$i";
                ListIP::create(['adresseIP' => $adresse,'batiment_id'=>$theid,'bureau_id'=>0,'port_id'=>0,'type_reseaux'=>$typeReseaux]);
            }
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Batiment $batiment,$theid)
    {
        $batiment=Batiment::find($theid);
        $etages = Etage::where('batiment_id', $theid)->orderByDesc('num')->get();
        $commutateurs=Commutateur::where('batiment_id', $theid)->orderByDesc('num')->get();
        return view('batiment.layout',['etages'=>$etages,"batiment"=>$batiment,"commutateurs"=>$commutateurs]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Batiment $batiment)
    {
        return view('batiment.edit',['batiment'=>$batiment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Batiment $batiment)
    {
        $request->validate([
            'name'=>'required',
            'descr'=>'required',
        ]);
        $input=$request->all();
        if($image=$request->file('image'))
        {
            $destinationPath='images/';
            $profileImage=date('YmdHis').".".$image->getClientOriginalExtension();
            $image->move($destinationPath,$profileImage);
            $input['image']="$profileImage";
        }else{
            unset($input['image']);
        }
        $batiment->update($input);
        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Batiment $batiment)
    {
        $batiment->delete();
        return redirect()->route('dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Eglise;
use App\Models\User;
use App\Models\Pays;
use App\Models\Messe;
use App\Models\Repertoire;

class EgliseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
              $tableau = [
                    'liste' => 'Liste Des Eglises',
                    'table' => 'Eglises'
                    ];
            if(renvoiRoleUser(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first(); 
              $eglises = Eglise::latest()->paginate('10');
              //dd($eglises);
              $ad = "ad";
              return view('eglise.index',compact('eglises','loggedUserInfo','ad','tableau'));
            }elseif(renvoiRoleUserP(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first(); 
              $eglises = User::find(Auth::user()->id)->eglise()->get();
              //dd($eglises);
              return view('eglise.index',compact('eglises','loggedUserInfo','tableau'));

            }
        
       
    }
    
      public function generate_cs(){
        $c1="rep";
        $c2=rand(1,99999);
        $c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3=range('a','z');
        shuffle($c3);
        $c3=strtoupper($c3[0]);
        $c = $c1.$c2.$c3;
        return $c;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            $tableau = [
                    'liste' => 'Créer Eglises',
                    'table' => 'Eglises'
                    ];
            if(renvoiRoleUser(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first();
              $pays = Pays::all();
              return view('eglise.create',compact('loggedUserInfo','pays','tableau'));
            }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            if(renvoiRoleUser(Auth::user()->id)){
                if($request->pays =="Veuillez Selectionner"){
                    return back()->with('errorchamps','Echec!!!Veuillez selectionner le champ pays');
                    }
                $request->validate([

                    'nom' => 'required|min:4',
                    'diocese' => 'required|min:4',
                    'quartier' => 'required|min:4',
                    'ville' => 'required|min:4',
                    'pays' => 'required',
                    'email' => 'required|email|unique:users',
                    'adresse' => 'required|min:4'

                ]);

                DB::beginTransaction();
                try {
                    $eglise = new Eglise;
           
                    $eglise->idpays = $request->pays;
                    $eglise->iduser = Auth::user()->id;
                    $eglise->nom = $request->nom;
                    $eglise->diocese = $request->diocese;
                    $eglise->quartier = $request->quartier;
                    $eglise->ville = $request->ville;
                    $eglise->adresse = $request->adresse;
                    $eglise->email = $request->email;
                    $eglise->statut = 1;
                    $eglise->comptebancaire =1;
                    $eglise->montantmesse = 1;
                    $query = $eglise->save();
                    $insertedId = $eglise->id; 
                    DB::insert('insert into eglise_pays (eglise_id, pays_id) values (?, ?)', [$insertedId, $request->pays]);
                    if(renvoiNumberDossierTotal()){
                    $numero = $this->generate_cs();
                    $repertoire = new Repertoire;
                    $repertoire->nom = "carnet de baptême";
                    $repertoire->iduser =Auth::user()->id; 
                    $repertoire->ideglise  = $insertedId;
                    $repertoire->uuid = $numero;
                    $repertoire->description = "Dossier contenant les carnets de baptême";
                    $repertoire->type = "carnet de baptême";
                    $repertoire->save();  
                    }
                    
                    DB::commit();
                    return redirect()->route('eglise.index')->with('success','Your registration has been done successfully'); 
                } catch (\Throwable $th) {
                    DB::rollback();
                    throw $th;
                }
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
            $tableau = [
                    'liste' => 'Voir Eglises',
                    'table' => 'Eglises'
                    ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first();
              $url = $_SERVER['REQUEST_URI'];
              $id = substr($url,11);
              //dd($id);
             $eglise = Eglise::find($id);
             //dd($eglise);
             return view('eglise.show',compact('loggedUserInfo','eglise','tableau'));
              
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        
            $tableau = [
                    'liste' => 'Modifier Des Eglises',
                    'table' => 'Eglises'
                    ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first();
              $url = $_SERVER['REQUEST_URI'];
              $id = substr($url,12);
              //dd($id);
              $pays = Pays::all();
              //$paysinfo = Eglise::find($id)->pays()->get();
             // $paysinfo = DB::SELECT('');
            //   $paysId = $paysinfo[0]->id;
              //dd($paysinfo);
              $eglise = Eglise::find($id);
              $paysId = $eglise['idpays'];
              //dd($eglise);
              return view('eglise.edit',compact('loggedUserInfo','eglise','pays','paysId','tableau'));
              
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      
           
                if($request->pays =="Veuillez Selectionner"){
                    return back()->with('errorchamps','Echec!!!Veuillez selectionner le champ pays');
                    }
                $request->validate([

                    'nom' => 'required|min:4',
                    'diocese' => 'required|min:4',
                    'quartier' => 'required|min:4',
                    'ville' => 'required|min:4',
                    'pays' => 'required',
                    'email' => 'required|email',
                    'adresse' => 'required|min:4'

                ]);

                DB::beginTransaction();
                try {
                        
                    $url = $_SERVER['REQUEST_URI'];
                    $id = substr($url,14);
                    $eglise = Eglise::find($id);
                    $eglise->idpays = $request->pays;
                    $eglise->iduser = Auth::user()->id;
                    $eglise->nom = $request->nom;
                    $eglise->diocese = $request->diocese;
                    $eglise->quartier = $request->quartier;
                    $eglise->ville = $request->ville;
                    $eglise->adresse = $request->adresse;
                    $eglise->email = $request->email;
                    $eglise->statut = 1;
                    $eglise->comptebancaire =1;
                    $eglise->montantmesse = 1;
                    $eglise->save();
                    $insertedId = $eglise->id;

                    DB::table('eglise_pays')
                    ->where('eglise_id', $id)
                    ->update(['pays_id' => $request->pays]);
                    DB::commit();
                    return redirect()->route('eglise.index')->with('success','L\'église '); 

                } catch (\Throwable $th) {
                    DB::rollback();
                    throw $th;
                }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        
            if(renvoiRoleUser(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,14);
                DB::beginTransaction();
                try {

                    foreach (DB::table('eglise_messe')->where('eglise_id', $id)->cursor() as $eglisemesses) {
                        /*echo '<pre>';
                        print_r($eglisemesses);
                        echo  '</pre>';*/
                        DB::table('messes')->delete($eglisemesses->id);
                    }
                                   
                    DB::table('eglise_pays')
                    ->chunkById(100, function($eglisespays){
                        foreach ($eglisespays as  $value) {
                           DB::table('eglise_pays')
                                ->where('eglise_id',substr($_SERVER['REQUEST_URI'],14))
                                ->delete($value->id);

                            /*echo '<pre>';
                            print_r($value);
                            echo  '</pre>';*/
                            
                        }
                   
                    });
                                    
                    DB::table('eglise_messe')
                    ->chunkById(100, function($eglisesmesses){
                        foreach ($eglisesmesses as  $value) {
                            DB::table('eglise_messe')
                            ->where('eglise_id',substr($_SERVER['REQUEST_URI'],14))
                            ->delete($value->id);
                           
                            /*echo '<pre>';
                            print_r($value);
                            echo  '</pre>';*/
                        }

                    });
                       
                    $userss =  User::where('ideglise',substr($_SERVER['REQUEST_URI'],14))
                        ->chunkById(100, function ($userss) {
                    foreach ($userss as $user) {
                        /*echo '<pre>';
                        print_r($user);
                        echo  '</pre>';*/
                        DB::table('users')
                            ->where('id', $user->id)
                            ->delete($user->id);
                    
                    }
                    });
             
                    $eglise = Eglise::find($id);
                    $eglise->delete();
                    return redirect()->route('eglise.index')->with('succesdanger','La suppression a été faite avec succès');
                 DB::commit();
              } catch (\Throwable $th) {
                  DB::rollback();
                  throw $th;
              } 
            }
        
        
    }
}

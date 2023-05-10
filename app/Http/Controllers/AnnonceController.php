<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Annonce;
use App\Models\User;
use App\Models\Eglise;
use App\Models\Pays;

class AnnonceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
         $tableau = [
            'liste' => 'Annonces',
            'table' => 'Liste Des Annonces'
            ];
        $today = Carbon::now();
        $expDate = Carbon::now()->subDays(7);
        if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
           $annonces = Annonce::where('dateexpiration','>',$today)->simplePaginate(25); 

        }elseif (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {     

            $eglise = User::find(Auth::user()->id)->eglise()->first();
            $annonces = DB::table('eglises')
                       ->join('annonces','eglises.id','=','annonces.ideglise')
                       ->where('eglises.id',$eglise->id)
                       ->where('dateexpiration','>',$today)
                       ->select('annonces.*')
                       ->simplePaginate(25);
        }
                
        $loggedUserInfo = User::where('id',Auth::user()->id)->first();
        return view('annonce.index',compact('annonces','loggedUserInfo','tableau'));
  
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {     
    
             $eglises = [];       
             $tableau = [
            'liste' => 'Annonces',
            'table' => 'Créer Annonces'
            ];
            if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                $eglises = Eglise::where('nom', '<>', 'Administrateur')->get();  
              }
            if(renvoiRoleUser(Auth::user()->id)){
                $loggedUserInfo = User::where('id',Auth::user()->id)->first();
                return view('annonce.create',compact('loggedUserInfo','tableau','eglises'));
            }elseif(renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {
                $loggedUserInfo = User::where('id',Auth::user()->id)->first();
                return view('annonce.create',compact('loggedUserInfo','tableau','eglises'));
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
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)){
                DB::beginTransaction();
                try {
                        //dd($request->input());
                        $request->validate([
                            'titre' => 'required|min:4',
                            'libelle' => 'required|min:4'
                        ]);
                   
                        $eglise = User::find(Auth::user()->id)->eglise()->first();
                        $annonce = new Annonce;
                        $annonce->iduser = Auth::user()->id;
                        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                            $annonce->ideglise =  $request->eglise;
                          }else{
                            $annonce->ideglise = $eglise->id;
                          }
                        
                        $annonce->titre = $request->titre;
                        $annonce->libelle = $request->libelle;
                        $annonce->dateexpiration = date('Y-m-d H:i:s', strtotime('+7 days'));
                        $annonce->statut = 1;
                        $annonce->save();
                        DB::commit();
                        return redirect()->route('annonce.index')->with('success','Your registration has been done successfully'); 

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
            'liste' => 'Annonces',
            'table' => 'Voir Annonce'
            ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,13);
                $loggedUserInfo = User::where('id',Auth::user()->id)->first();
                $annonce = Annonce::where('id',$id)->first();
                return view('annonce.show',compact('annonce','loggedUserInfo','tableau'));
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
            $eglises = []; 
             $tableau = [
            'liste' => 'Annonces',
            'table' => 'Modifier Annonce'
            ];
            if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                $eglises = Eglise::where('nom', '<>', 'Administrateur')->get();  
              }
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,13);
                $loggedUserInfo = User::where('id',Auth::user()->id)->first();
                $annonce = Annonce::where('id',$id)->first();
                return view('annonce.edit',compact('annonce','loggedUserInfo','tableau','eglises'));
            }
        
    }

    public function consultAnnonce(){
     
             $tableau = [
            'liste' => 'Annonces',
            'table' => 'Consulter Annonces'
            ];
        $loggedUserInfo = User::where('id',Auth::user()->id)->first();
        $pays = Pays::all();
        return view('annonce.annonceconsult',compact('pays','loggedUserInfo','tableau'));   
        
      
    }
    public function consultAnnonceExpiree(){
    
             $tableau = [
            'titre1' => 'Annonces',
            'titre2' => 'Consulter Annonces Exprées'
            ];
        $loggedUserInfo = User::where('id',Auth::user()->id)->first();
        $pays = Pays::all();
        return view('annonce.annonceconsultexpiree',compact('pays','loggedUserInfo','tableau'));   
        
      
    }

    public function fetch(Request $request){
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $query = DB::table('eglise_pays')
                 ->join('pays','eglise_pays.pays_id','pays.id')
                 ->join('eglises','eglise_pays.eglise_id','eglises.id')
                 ->where('pays.id',$value)
                 ->select('eglises.*')
                 ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($query as $row){
            $output .= '<option value="'.$row->id.'">'.$row->nom.'-'.$row->quartier.'</option>';
        }
        echo $output;
    }

    public function afficherAnnonce(Request $request){
       //dd($request->input());
     
            $tableau = [
            'liste' => 'Annonces',
            'table' => 'Liste Des Annonces'
            ];
       $loggedUserInfo = User::where('id',Auth::user()->id)->first();
       $today = Carbon::now();
       $expDate = Carbon::now()->subDays(7);
       $annonces = Eglise::find($request->eglise)->annonces()->where('dateexpiration','>',$today)->latest()->simplePaginate(10);
       //dd($annonces);
       return view('annonce.afficheannonce',compact('annonces','loggedUserInfo','tableau'));
       
 
    }

    public function afficherAnnonceExprirees(Request $request){
        //dd($request->input());
        
             $tableau = [
            'liste' => 'Annonces',
            'table' => 'Liste Des Annonces'
            ];
        $loggedUserInfo = User::where('id',Auth::user()->id)->first();
        $today = Carbon::now();
        $expDate = Carbon::now()->subDays(7);
        $annonces = Eglise::find($request->eglise)->annonces()->where('dateexpiration','<',$today)->latest()->simplePaginate(10);
        //dd($annonces);
        return view('annonce.afficheannonce',compact('annonces','loggedUserInfo','tableau'));
        
  
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
       
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,15);
                DB::beginTransaction();
                try {
                    $request->validate([
                       'titre' => 'required|min:4',
                       'libelle' => 'required|min:4'
                    ]);
                    $eglise = User::find(Auth::user()->id)->eglise()->first();
                    //dd($eglise);
                    $annonce = Annonce::find($id);
                    $annonce->iduser = Auth::user()->id;
                    $annonce->ideglise = $eglise->id; 
                    $annonce->titre = $request->titre;
                    $annonce->libelle = $request->libelle;
                    $annonce->statut = 1;
                    $annonce->save();
                DB::commit();
                return redirect()->route('annonce.index')->with('success','Your modification has been done successfully');      
                } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
                }
               
              
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)){

               DB::beginTransaction();
               try {
                   $annonce = Annonce::find($id);
                   $annonce->delete();
                   DB::commit();
                   return redirect()->route('annonce.index')->with('succesdanger','La suppression a été faite avec succès');
               } catch (\Throwable $th) {
                   DB::rollback();
                   throw $th;
               }
            }
        
    }
}

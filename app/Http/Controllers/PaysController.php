<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Pays;
use App\Models\User;


class PaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

             $tableau = [
                    'liste' => 'Liste Des Pays',
                    'table' => 'Pays'
                    ];
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
                $loggedUserInfo = User::where('id',Auth::user()->id)->first(); 
                $pays = Pays::latest()->paginate('10');
                //dd($pays);
                return view('pays.index',compact('pays','loggedUserInfo','tableau'));
             
            }
           
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            $tableau = [
                    'liste' => 'Créer Pays',
                    'table' => 'Pays'
                    ];
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                return view('pays.create',compact('loggedUserInfo','tableau'));
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

            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
               $request->validate([
                   'nom' => 'required',
                   'capitale' => 'required',
                   'indicatif' => 'required|unique:pays'
               ]);
               DB::beginTransaction();

               try {

                   Pays::create([
                   'nom' => $request->nom,
                   'capitale' => $request->capitale,
                   'indicatif' => $request->indicatif,
                   'plusieurmessededuction' => $request->reductionmax,
                   'deuxmessededuction' => $request->reductionmin,
                   'iduser' => Auth::user()->id,
                   'statut' =>1
                   ]);
                   DB::commit();
                   return back()->with('success','Le pays a été créé avec succès!!!');

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
                    'liste' => 'Voir Pays',
                    'table' => 'Pays'
                    ];
                    
            
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,9);
                $pays = Pays::find($id);
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                return view('pays.show',compact('pays','loggedUserInfo','tableau'));
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
                    'liste' => 'Modifier Pays',
                    'table' => 'Pays'
                    ];
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise() ){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,10);
                //dd($id);
                $pays = Pays::find($id);
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                return view('pays.edit',compact('pays','loggedUserInfo','tableau'));
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

            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,12);
                $request->validate([
                    'nom' => 'required',
                    'capitale' => 'required',
                    'indicatif' => 'required'
                ]);
                DB::beginTransaction();
                try {
                    $pays = Pays::find($id);
                    $pays->nom = $request->nom;
                    $pays->capitale = $request->capitale;
                    $pays->indicatif = $request->indicatif;
                    $pays->plusieurmessededuction = $request->reductionmax;
                    $pays->deuxmessededuction = $request->reductionmin;
                    $pays->iduser = Auth::user()->id;
                    $pays->statut = 1;
                    $pays->save();
                    DB::commit();
                    return redirect()->route('pays.index')->with('success','Le pays a été modifié avec succès');
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
  
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,12);

            }
        
    }
}

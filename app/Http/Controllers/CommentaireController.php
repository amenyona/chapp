<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;
use Illuminate\Http\Request;
use App\Models\User;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
             $tab = [
            'titre1' => 'Liste Des Commentaires',
            'titre2' => 'Commentaires'
            ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $commentaires = Commentaire::where('idEglise','=',renvoiEgliseId(Auth::user()->id))->latest()->simplePaginate(25);
                //dd($commentaires);
                return view('commentaire.index',compact('loggedUserInfo','commentaires','tab'));
            }
            
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        
              $tab = [
            'titre1' => 'Voir Commentaires',
            'titre2' => 'Commentaires'
            ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id)){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first();
              $url = $_SERVER['REQUEST_URI'];
              $id = substr($url,17 );
              //dd($id);
              $comment = Commentaire::where('uuid',$id)->first();
              $commentaire = Commentaire::find($comment['id']);
            // dd($commentaire);
             return view('commentaire.show',compact('loggedUserInfo','commentaire','tab'));
              
            }
        
    }
    
     public function mescommentaires()
    {
        
             $tab = [
            'titre1' => 'Liste Des Commentaires',
            'titre2' => 'Commentaires'
            ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id)){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $commentaires = Commentaire::where('iduser','=',Auth::user()->id)->latest()->simplePaginate(25);
                //dd($commentaires);
                return view('commentaire.commentaire',compact('loggedUserInfo','commentaires','tab'));
            }
            
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        
            if(renvoiRoleUser(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,19);
                //dd($id);
                DB::beginTransaction();
                try {             
                    $commentaire = Commentaire::find($id);
                    $commentaire->delete();
                    return redirect()->route('commenatire.index')->with('succesdanger','La suppression a été faite avec succès');
                 DB::commit();
              } catch (\Throwable $th) {
                  DB::rollback();
                  throw $th;
              } 
            }
        
        
    }
}

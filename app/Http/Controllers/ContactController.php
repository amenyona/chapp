<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pays;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $tab = [
            'titre1' => 'Liste Des Avis',
            'titre2' => 'Avis'
            ];
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            if(renvoiRoleUser(Auth::user()->id)){
                $contacts = Contact::latest()->simplePaginate(25);
                //dd($Contacts);
                }else if(renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $contacts = Contact::where('idEglise','=',renvoiEgliseId(Auth::user()->id))->latest()->simplePaginate(25);
                }
                return view('contact.index',compact('loggedUserInfo','contacts','tab'));
            

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
            $tab = [
            'titre1' => 'Envoyer Avis',
            'titre2' => 'Avis'
            ];
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                 $pays = Pays::all();
                //dd($Contacts);
                return view('contact.create',compact('loggedUserInfo','tab','pays'));
            }
            
        
    }
    
    public function generate_cs(){
        $c1="contact";
        $c2=rand(1,99999);
        $c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3=range('a','z');
        shuffle($c3);
        $c3=strtoupper($c3[0]);
        $c = $c1.$c2.$c3;
        return $c;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
             if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
            if($request->pays =="Veuillez Selectionner" || $request->eglise =="Veuillez Selectionner"){
          return back()->with('errorchamps','Echec!!!Veuillez selectionner les champs pays, eglise ou sexe');
        }
        $request->validate([
                'sujet' => 'required|min:10',
                'pays' => 'required',
                'eglise' => 'required'
                ]);
        DB::beginTransaction();
        try{
         $numero = $this->generate_cs();           
         $contact = new Contact;
         $contact->iduser = Auth::user()->id;
         $contact->sujet = $request->sujet;
         $contact->uuid = $numero;
         $contact->idEglise = $request->eglise;
         $contact->statut = 'contacté';
         $query = $contact->save();
         if($query){
            return back()->with('success','Votre message a été bien envoyé!Merci!');
        }else{
            return back()->with('error','Erreur d\'envoi de message!Revérifier vos données');
        } 
         DB::commit();
            }catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
          
         }
  
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $Contact)
    {
        
              $tab = [
            'titre1' => 'Voir Avis',
            'titre2' => 'Avis'
            ];
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
              $loggedUserInfo = User::where('id',Auth::user()->id)->first();
              $url = $_SERVER['REQUEST_URI'];
              $id = substr($url,13);
              //dd($id);
              $contact = Contact::where('uuid',$id)->first();
              //$Contact = Contact::find($comment['id']);
              //dd($contact);
             return view('contact.show',compact('loggedUserInfo','contact','tab'));
              
            }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $Contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $Contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $Contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $Contact)
    {
      
            if(renvoiRoleUser(Auth::user()->id)){
                $url = $_SERVER['REQUEST_URI'];
                $id = substr($url,15);
                //dd($id);
                $dbid = Contact::where('uuid',$id)->first();
                //dd($dbid);
                DB::beginTransaction();
                try {             
                    $Contact = Contact::find($dbid['id']);
                    $Contact->delete();
                    return redirect()->route('contact.index')->with('succesdanger','La suppression a été faite avec succès');
                 DB::commit();
              } catch (\Throwable $th) {
                  DB::rollback();
                  throw $th;
              } 
            }
        
        
    }
}

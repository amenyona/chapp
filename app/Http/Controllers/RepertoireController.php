<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Repertoire;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Eglise;
use App\Models\CarnetDeBapteme;
use App\Models\AutreDocument;

class RepertoireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tableau = [
            'liste' => 'La Liste',
            'table' => 'Articles'
        ];
      
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $repertoires = Eglise::find(renvoiEgliseId(Auth::user()->id))->repertoires()->simplePaginate(25);
                return view('repertoire.index',compact('loggedUserInfo','tableau','repertoires'));
            }
            
        
        
    }

    public function listeFiles(){

                        
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,17);
            $ideglise = renvoiEgliseId(Auth::user()->id);
            $repertoire = Repertoire::where('uuid',$uuid)->first();

            if($repertoire->type=="carnet_de_bapteme"){
                $carnets = Repertoire::find($repertoire->id)->carnetDeBaptemes()->where('ideglise','=',$ideglise)->simplePaginate(25);
                //dd($carnets);
                return view('repertoire.listecarnetbapteme',compact('repertoire','loggedUserInfo','carnets'));
            }else{
                $documents = Repertoire::find($repertoire->id)->autreDocuments()->where('egliseId','=',$ideglise)->simplePaginate(25);
                //AutreDocument
                return view('repertoire.listeautredocument',compact('repertoire','loggedUserInfo','documents'));
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
    
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                return view('repertoire.create',compact('loggedUserInfo'));
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
            //dd($request->input());
            
            $request->validate([
                'nom' => 'required|min:4|unique:repertoires',
                'description' => 'required|min:4|unique:repertoires'
            ]);
            $numero = $this->generate_cs();
            $repertoire = new Repertoire;
            $repertoire->nom = $request->nom;
            $repertoire->iduser =Auth::user()->id; 
            $repertoire->ideglise  = renvoiEgliseId(Auth::user()->id);
            $repertoire->uuid = $numero;
            $repertoire->description = $request->description;
            $repertoire->type = $request->nom;
            $query = $repertoire->save();
            if($query){
               return back()->with('success','Your registration has been done successfully'); 
            }
        }
          
    }

    public function generate_cscar(){
        $c1="car";
        $c2=rand(1,99999);
        $c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3=range('a','z');
        shuffle($c3);
        $c3=strtoupper($c3[0]);
        $c = $c1.$c2.$c3;
        return $c;
    }


    public function createcarnet()
    {
     
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $url = $_SERVER['REQUEST_URI'];
                $uuid = substr($url,24);
                $repertoire = Repertoire::where('uuid',$uuid)->first();
                //dd($uuid);
                $egliseUsers = Eglise::find(renvoiEgliseId(Auth::user()->id))->users->where('statutcarnet','!=','carnet_disponible');
                //dd($egliseUsers);
                return view('carnet.create',compact('loggedUserInfo','egliseUsers','repertoire'));
            }
            
        
    }
    

    public function storecarnet(Request $request)
    {
       
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
  
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                if($request->utilisateurs =="Veuillez Selectionner"){
                    return back()->with('errorchamps','Echec!!!Veuillez selectionner le champ utilisateurs');
                    }
                $image = $request->file('image');
                $numero = $this->generate_cscar();
                
                $request->validate([
                    'contenu' => 'required|min:8',
                    'image' => "required|max:7048"
                    ]);
                $my_image = rand().'.'.$image->getClientOriginalExtension();
                $image->move($_SERVER['DOCUMENT_ROOT'].'/upload',$my_image);
                                   
                $carnet = new CarnetDeBapteme;
                $carnet->user_id = $request->utilisateurs;
                $carnet->ideglise = renvoiEgliseId($request->utilisateurs); 
                $carnet->idrepertoire = $request->idrep;
                $carnet->uuid = $numero;
                $carnet->iduserCreator = Auth::user()->id;
                $carnet->description = $request->contenu;
                $carnet->imageCarnet = $my_image;
                $carnet->save();
                $user = User::find($request->utilisateurs);
                $user->statutcarnet = "carnet_disponible";
                $user->save();
                return back()->with('success','le carnet de baptême a été créé avec succès');                                       
            }
            
        
    }

    

    public function showcarnet(CarnetDeBapteme $carnet){
                        
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,22); 
            //dd($uuid);
            $carnet = CarnetDeBapteme::where('uuid',$uuid)->first();
            //dd($carnet);
            
            return view('repertoire.showcarnet',compact('loggedUserInfo','carnet')); 
            

    }

    public function editcarnet(CarnetDeBapteme $carnet){

                        
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,22); 
            $carnet = CarnetDeBapteme::where('uuid',$uuid)->first();           
            $repertoire = Repertoire::where('uuid',implode(',',$carnet->repertoire()->get()->pluck('uuid')->toArray()))->first();
            $egliseUsers = User::where('id',$carnet->user_id)->first();
            //dd($egliseUsers);
            if($repertoire->type=="carnet_de_bapteme"){
                return view('repertoire.editcarnet',compact('loggedUserInfo','repertoire','egliseUsers','carnet'));
            } 
                      
        

    }

    public function updateCarnet(Request $request, CarnetDeBapteme $carnetDeBapteme)
    {      
            
        if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
        if($request->utilisateurs =="Veuillez Selectionner"){
                return back()->with('errorchamps','Echec!!!Veuillez selectionner le champ utilisateurs');
                }

        $my_image = $request->my_image;
        $image = $request->file('image');
        //var_dump($request->input());
        //dd($my_image);
        if($image!=""){
            
            $request->validate([
                'contenu' => 'required|min:8',
                'image' => "required|max:7048"
                ]);
            $my_image = rand().'.'.$image->getClientOriginalExtension();
            //dd($my_image);
            $image->move($_SERVER['DOCUMENT_ROOT'].'/upload',$my_image);            
        }else{
            $request->validate([
                'contenu' => 'required|min:8'
                ]);
               
           }

           //dd($request->input());
           
            $carnet = CarnetDeBapteme::find($request->idcarnet);
            $carnet->user_id = $request->utilisateurs;
            $carnet->ideglise = renvoiEgliseId($request->utilisateurs); 
            $carnet->idrepertoire = $request->idrep;
            $carnet->iduserCreator = Auth::user()->id;
            $carnet->description = $request->contenu;
            $carnet->imageCarnet = $my_image;
            $carnet->save();
            $user = User::find($request->utilisateurs);
            $user->statutcarnet = "carnet_disponible";
            $user->save();
            return back()->with('success','Le carnet de baptême a été créé avec succès');    
            }
        
                                             
    }


    public function destroyCarnet(CarnetDeBapteme $carnetDeBapteme)
    {
        
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $url = $_SERVER['REQUEST_URI'];
                $uuid = substr($url,18);
                //dd($uuid);
                $carnet = CarnetDeBapteme::where('uuid',$uuid)->first();
                $carnet = CarnetDeBapteme::find($carnet->id);
                //dd($carnet);                
                $user = User::find(implode(',',$carnet->user()->get()->pluck('id')->toArray()));
                //dd($user);
                $user->statutcarnet = "carnet_non_disponible";
                $user->save(); 
                $carnet->delete();
                return redirect()->route('repertoire.index')->with('succesdanger','La suppression a été faite avec succès');
              
            }
        
    }

    public function generate_csdoc(){
        $c1="doc";
        $c2=rand(1,99999);
        $c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3=range('a','z');
        shuffle($c3);
        $c3=strtoupper($c3[0]);
        $c = $c1.$c2.$c3;
        return $c;
    }

    public function createdoc()
    {
        
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $url = $_SERVER['REQUEST_URI'];
                $uuid = substr($url,21);
                //dd($uuid);
                $repertoire = Repertoire::where('uuid',$uuid)->first();
                
                return view('repertoire.createdoc',compact('loggedUserInfo','repertoire'));
            }
            
        
    }

    public function storedoc(Request $request)
    {
        
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
  
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
 
                $image = $request->file('image');
                $numero = $this->generate_csdoc();
                
                $request->validate([
                    'contenu' => 'required|min:8',
                    'image' => "required|mimetypes:application/pdf|max:10000"
                    ]);
                $my_image = rand().'.'.$image->getClientOriginalExtension();
                $image->move($_SERVER['DOCUMENT_ROOT'].'/upload',$my_image);
                                   
                $document = new AutreDocument;
                $document->userId = Auth::user()->id;
                $document->egliseId = renvoiEgliseId(Auth::user()->id); 
                $document->repertoireId = $request->idrep;
                $document->uuid = $numero;
                $document->titre = $request->titre;
                $document->description = $request->contenu;
                $document->imageDoc = $my_image;
                $document->save();
                return back()->with('success','le carnet de baptême a été créé avec succès');                                       
            }
            
        
    }

    public function showdoc(AutreDocument $document){
                     
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,19); 
            //dd($uuid);
            $document = AutreDocument::where('uuid',$uuid)->first();
            //dd($document);
            
            return view('repertoire.showdoc',compact('loggedUserInfo','document')); 
  

    }

    public function editdoc(AutreDocument $document){
                    
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,19); 
            //dd($uuid);
            $document = AutreDocument::where('uuid',$uuid)->first();           
            $repertoire = Repertoire::where('uuid',implode(',',$document->repertoire()->get()->pluck('uuid')->toArray()))->first();
            
            if($repertoire->type!="carnet_de_bapteme"){
                return view('repertoire.editdoc',compact('loggedUserInfo','repertoire','document'));
            } 

    }

    public function updateDoc(Request $request, AutreDocument $document)
    {
          
        if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
        
        $my_image = $request->my_image;
        $image = $request->file('image');
        //var_dump($request->input());
        //dd($my_image);
        if($image!=""){
            
            $request->validate([
                'contenu' => 'required|min:8',
                'image' => "required|mimetypes:application/pdf|max:10000"
                ]);
            $my_image = rand().'.'.$image->getClientOriginalExtension();
            //dd($my_image);
            $image->move($_SERVER['DOCUMENT_ROOT'].'/upload',$my_image);           
        }else{
            $request->validate([
                'contenu' => 'required|min:8'
                ]);
               
           }

           //dd($request->input());
           
            $document = AutreDocument::find($request->iddocument);
            $document->userId = Auth::user()->id;
            $document->egliseId = renvoiEgliseId(Auth::user()->id); 
            $document->repertoireId = $request->idrep;
            $document->titre = $request->titre;
            $document->description = $request->contenu;
            $document->imageDoc = $my_image;
            $document->save();            
            return back()->with('success','Le document a été modifié avec succès');    
            }
                                       
    }

    public function destroyDoc(AutreDocument $document)
    {
        
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $url = $_SERVER['REQUEST_URI'];
                $uuid = substr($url,21);
                //dd($uuid);
                $docu = AutreDocument::where('uuid',$uuid)->first();
                $document = AutreDocument::find($docu->id);
                $document->delete();
                return redirect()->route('repertoire.index')->with('succesdanger','La suppression a été faite avec succès');
              
            }
        
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repertoire  $repertoire
     * @return \Illuminate\Http\Response
     */
    public function show(Repertoire $repertoire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repertoire  $repertoire
     * @return \Illuminate\Http\Response
     */
    public function edit(Repertoire $repertoire)
    {
                
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $uuid = substr($url,16); 
            //dd($uuid);
            //$document = AutreDocument::where('uuid',$uuid)->first();           
            $repertoire = Repertoire::where('uuid',$uuid)->first();
             //dd($repertoire);    
            return view('repertoire.edit',compact('loggedUserInfo','repertoire'));  
                      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repertoire  $repertoire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repertoire $repertoire)
    {

            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $url = $_SERVER['REQUEST_URI'];
                $uuid = substr($url,18);
                //dd($uuid);                      
                $request->validate([
                    'nom' => 'required|min:4|unique:repertoires,id,'.$request->idrepertoire,
                    'description' => 'required|min:4|unique:repertoires,id,'.$request->idrepertoire
                ]);
                
                $repertoire = Repertoire::find($request->idrepertoire);
                $repertoire->iduser =Auth::user()->id; 
                $repertoire->ideglise  = renvoiEgliseId(Auth::user()->id);
                $repertoire->description = $request->description;
                if($request->idrepertoire==1){
                     $repertoire->nom = "carnet de baptême";
                     $repertoire->type = "carnet_de_bapteme"; 
                }else{
                    $repertoire->nom = $request->nom;
                    $repertoire->type = $request->nom; 
                }
              
                $query = $repertoire->save();
                if($query){
                   return back()->with('success','Your registration has been done successfully'); 
                }
                }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repertoire  $repertoire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repertoire $repertoire)
    {
        //
    }
}

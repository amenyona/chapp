<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\CarnetDeBapteme;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Eglise;

class CarnetDeBaptemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "index";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(session()->has('LoggedUser')){
            if(renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id)|| renvoiRoleUserS(Auth::user()->id) ){
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $egliseUsers = Eglise::find(renvoiEgliseId(Auth::user()->id))->users;
                //dd($egliseUsers);
                return view('carnet.create',compact('loggedUserInfo','egliseUsers'));
            }
            
        }
    }

    public function generate_cs(){
        $c1="car";
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
  
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $image = $request->file('image');
                $numero = $this->generate_cs();
                
                $request->validate([
                    'contenu' => 'required|min:8',
                    'image' => "required|max:7048"
                    ]);
                $my_image = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('upload'),$my_image);
                                   
                $carnet = new CarnetDeBapteme;
                $carnet->user_id = $request->utilisateurs;
                $carnet->ideglise = renvoiEgliseId($request->utilisateurs); 
                $carnet->uuid = $numero;
                $carnet->iduserCreator = Auth::user()->id;
                $carnet->description = $request->contenu;
                $carnet->imageCarnet = $my_image;
                $carnet->save();
                return back()->with('success','Votre article a été créé avec succès');                                       
            }
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarnetDeBapteme  $carnetDeBapteme
     * @return \Illuminate\Http\Response
     */
    public function show(CarnetDeBapteme $carnetDeBapteme)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarnetDeBapteme  $carnetDeBapteme
     * @return \Illuminate\Http\Response
     */
    public function edit(CarnetDeBapteme $carnetDeBapteme)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarnetDeBapteme  $carnetDeBapteme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarnetDeBapteme $carnetDeBapteme)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarnetDeBapteme  $carnetDeBapteme
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarnetDeBapteme $carnetDeBapteme)
    {
        //
    }
}

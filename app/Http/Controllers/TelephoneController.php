<?php

namespace App\Http\Controllers;

use App\Models\Telephone;
use App\Models\User;
use App\Models\Eglise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tableau = [
            'liste' => 'Liste Des Téléphones',
            'table' => 'Téléphones'
        ];

        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            //$telephones = Eglise::find(Auth::user()->id)->telephones()->latest()->paginate('10');
            //dd($telephones);
            $telephones = Telephone::latest()->paginate('10');
            return view('telephone.index', compact('telephones', 'loggedUserInfo', 'tableau'));
        } elseif (renvoiRoleUserP(Auth::user()->id) || renvoiRoleUser(Auth::user()->id)) {
            $loggedUserInfo = User::where('id', Auth::user()->id)->first();
            /*if(!verfifIfEgliseHasPhoneNumber()){
                $telephones = Telephone::where('ideglise', '=', renvoiEgliseId(Auth::user()->id))->latest()->paginate('10');
                //dd('ok');
            }else{
                //dd('okok');
               $telephones = Eglise::find(renvoiEgliseId(Auth::user()->id))->telephones()->latest()->paginate('10'); 
            }*/
            $telephones = Eglise::find(renvoiEgliseId(Auth::user()->id))->telephones()->latest()->paginate('10'); 
          
            return view('telephone.index', compact('telephones', 'loggedUserInfo', 'tableau'));
        } else {
            return redirect()->route(('auth.dashboard'));
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
            'liste' => 'Liste Des Téléphones',
            'table' => 'Téléphones'
        ];
        $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
        $ideglise = renvoiEgliseId(Auth::user()->id);
        //dd($ideglise);
        return view('telephone.create', compact('tableau', 'loggedUserInfo','ideglise'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->input());
        $date_now = date('Y-m-d');
        $libelle = $request->item_libelle;
        $numero = $request->item_numero;
        $ideglise = $request->ideglise;

        //dd($image);
        for ($i = 0; $i < count($numero); $i++) {

            $dataSave = [
                'ideglise' => $ideglise,
                'iduser' => Auth::user()->id,
                'numero' => $numero[$i],
                'libelle' => $libelle[$i],               
            ];

            //DB::table('documents')->insert($dataSave);
            DB::table('telephones')->insertGetId($dataSave);
                         
        }

        return back()->with('success', 'Votre enregistrement a été fait avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Telephone  $telephone
     * @return \Illuminate\Http\Response
     */
    public function show(Telephone $telephone)
    {
        $tableau = [
            'liste' => 'Voir Eglises',
            'table' => 'Eglises'
            ];
            
           
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url,17); 
            $telephone = Telephone::where('id',$id)->first();
            //dd($telephone);
              return view('telephone.show',compact('loggedUserInfo','telephone','tableau')); 
            /*}else{
                return redirect()->route('auth.dashboard');


            }*/
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Telephone  $telephone
     * @return \Illuminate\Http\Response
     */
    public function edit(Telephone $telephone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Telephone  $telephone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Telephone $telephone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Telephone  $telephone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Telephone $telephone)
    {
        //
    }
}

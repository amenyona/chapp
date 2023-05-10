<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StatistiqueController extends Controller
{
    public function index(){
        $loggedUserInfo = User::where('id',Auth::user()->id)->first();
        $data = DB::table('users')
                ->select(
                        DB::raw('sexe as genre'),
                        DB::raw('count(*) as nombre'))
                ->groupBy('sexe',) 
                ->get();

        $datas = DB::table('users')
                ->join('eglises','users.ideglise','=','eglises.id')
                ->select(
                        DB::raw('DATE(users.created_at) as date'),
                        DB::raw('users.sexe as genre'),
                        DB::raw('count(*) as nombre'))
                ->groupBy('date','sexe') 
                ->where('eglises.id',renvoiEgliseId(Auth::user()->id))
                ->get();
                return view('admin.dashboard',compact('data','datas'));
        dd($datas);
                
        $array[] = ['Genre','Nombre'];
        foreach($data as $key => $value){
            $array[++$key] = [$value->genre, $value->nombre];
        }
        $genre = $array[0][0];
        $nombreTotal = $array[0][1];
        $femme = $array[1][0];
        $nombreFemme = $array[1][1];
        $homme = $array[2][0];
        $nombreHomme = $array[2][1];
    }
}

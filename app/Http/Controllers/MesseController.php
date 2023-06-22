<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Messe;

class MesseController extends Controller
{
    public function index(){
        $tableau = [
            'liste' => 'Liste Des Eglises',
            'table' => 'Eglises'
            ];
            $loggedUserInfo = User::where('id',Auth::user()->id)->first(); 
        $messes = Messe::latest()->simplePaginate(25);
        return view('messe.index', compact('messes','tableau','loggedUserInfo'));
    }
}

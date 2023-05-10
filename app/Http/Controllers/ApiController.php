<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class ApiController extends Controller
{
    public function allUsers(){
        //$data = User::All();
        $data = User::all();

        //var_dump($data);
        return response()->json($data);
    }

    public function login(Request $request){
         $loginDetails = $request->only('email','password');
        if(Auth::attempt($loginDetails)){
            return response()->json(['message' => 'login successfuly','code' =>'200']);
        }else{
            return response()->json(['message' => 'login details wrong','code'=>'err']);
        }

    }
    
      public function generate_cs(){
        $c1="Jesus";
        $c2=rand(1,99999);
        $c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3=range('a','z');
        shuffle($c3);
        $c3=strtoupper($c3[0]);
        $c = $c1.$c2.$c3;
        return $c;
    }
    
     function create(Request $request){
     //dd($request->input());

        $request->validate([
            'name' => 'required|min:4',
            'firstname' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:8',
            'password' => 'required|min:8|max:12'
        ]);
        DB::beginTransaction();
        try{
        $user = new User;
        $user->ideglise = 10;
        $user->name = $request->input('name');
        $numero = $this->generate_cs();
        $user->uuid = $numero;
        $user->firstname = $request->input('firstname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->online = "non";
        $user->password = Hash::make($request->input('password'));
        $query = $user->save();
        $insertedId = $user->id; 
        DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [4, $insertedId]);
        /*Mail::to("late@pushtudio.com")->bcc("amenyona.late@gmail.com")
						->send(new MessageGoogle("premier test"));*/
        if($query){
             return response()->json(['message' => 'create successfuly']);
        }else{
            return response()->json(['message' => 'creation failed']);
        }

        DB::commit();
            }catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }
    }
}
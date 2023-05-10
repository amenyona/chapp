<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\User;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
            $tableau = [
            'liste' => 'Liste Des Roles',
            'table' => 'Rôles'
            ];
           
                if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){ 
                $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
                $roles = Role::latest()->paginate('10');
                 return view('role.index',compact('roles','loggedUserInfo','tableau'));   
                }else{
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
        if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
             $tableau = [
            'liste' => 'Créer  Roles',
            'table' => 'Rôles'
            ];
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
           return view('role.create',compact('loggedUserInfo','tableau')); 
        
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
            //dd($request->input());
          $request->validate([
            'name' => 'required|min:4|unique:roles',
            'description' => 'required|min:4'
        ]);
        DB::beginTransaction();
        try{
            $role = new Role;
            $role->name = $request->name;
            $role->description = $request->description;
            $query = $role->save();
            if($query){
               return back()->with('success','Your registration has been done successfully'); 
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
 
            $tableau = [
            'liste' => 'Voir Roles',
            'table' => 'Rôles'
            ];
            
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url,10); 
            $role = Role::where('id',$id)->first();
              return view('role.show',compact('loggedUserInfo','role','tableau')); 
            }else{
                return redirect()->route('auth.dashboard');


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
            'liste' => 'Modification Roles',
            'table' => 'Rôles'
            ];
  
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
            $loggedUserInfo = User::where('id','=',Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url,10); 
            $role = Role::where('id',$id)->first();
              return view('role.edit',compact('loggedUserInfo','role','tableau')); 
            }else{
                return redirect()->route('auth.dashboard');
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
   
            ///dd($request->input());
            if(renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()){
            $request->validate([
            'name' => 'required|min:4',
            'description' => 'required|min:4'
            ]);  
             $url = $_SERVER['REQUEST_URI'];
             $id = substr($url,12); 
             DB::beginTransaction();

            try {

                $role = Role::find($id);
                $role->name = $request->name;
                $role->description = $request->description;
                $role->save();
                return redirect()->route('roles.index')->with('success','Le rôle a été modifié avec succès');
                DB::commit();
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
        //dd($id);
            DB::beginTransaction();
                try {
                    $userss =  Role::find(substr($_SERVER['REQUEST_URI'],12))->users()
                        ->chunkById(100, function ($userss) {
                    foreach ($userss as $user) {
                        DB::table('users')
                            ->where('id', $user->id)
                            ->delete($user->id);
                    
                    }
                    });
             
                    DB::table('role_user')
                    ->chunkById(100, function ($roleusers) {
                        foreach ($roleusers as $roleuser) { 
                            DB::table('role_user')
                                ->where('role_id', substr($_SERVER['REQUEST_URI'],12))
                                ->delete($roleuser->id);
                             
                        }
                    });

                    $role = Role::find($id);
                    $role->delete();
                        
                 return redirect()->route('roles.index')->with('succesdanger','La suppression a été faite avec succès');
                DB::commit();
              } catch (\Throwable $th) {
                  DB::rollback();
                  throw $th;
              } 
        }
                     
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use App\Mail\MessageGoogle;
use App\Models\User;
use App\Models\Role;
use App\Models\Eglise;

class UserAuthController extends Controller
{

    function index()
    {
        $tableau = [
            'liste' => 'Liste Des Utilisateurs',
            'table' => 'Utilisateurs'
        ];
        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            $users = User::where('id', '<>', Auth::user()->id)->latest()->simplePaginate(10);
            return view('auth.listeutilisateurs', compact('users', 'loggedUserInfo', 'tableau'));
        }
        if (renvoiRoleUserP(Auth::user()->id) || renvoiRoleUser(Auth::user()->id) || renvoiRoleUserPretre(Auth::user()->id)) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            $users = User::where(
                [
                    ['id', '<>', Auth::user()->id],
                    ['ideglise', '=', renvoiEgliseId(Auth::user()->id)]
                ]
            )->latest()->simplePaginate(10);
            return view('auth.listeutilisateurs', compact('users', 'loggedUserInfo', 'tableau'));
        } else {
            return redirect()->route(('auth.dashboard'));
        }
    }



    function login()
    {
        return view('auth.login');
    }

    public function generate_cs()
    {
        $c1 = "Jesus";
        $c2 = rand(1, 99999);
        $c2 = str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3 = range('a', 'z');
        shuffle($c3);
        $c3 = strtoupper($c3[0]);
        $c = $c1 . $c2 . $c3;
        return $c;
    }

    function inscrire()
    {
        $egliseInfos = DB::table('eglise_pays')
            ->join('eglises', 'eglise_pays.eglise_id', '=', 'eglises.id')
            ->join('pays', 'eglise_pays.pays_id', '=', 'pays.id')
            ->select('eglises.id as idEglise', 'eglises.nom as eglisenom', 'eglises.quartier as eglisequartier', 'pays.nom as paysnom')
            ->where('eglises.nom', '<>', 'Administrateur')
            ->get();
        return view('auth.inscription', compact('egliseInfos'));
    }

    function registered()
    {

        $tableau = [
            'liste' => 'Créer Des Utilisateurs',
            'table' => 'Utilisateurs'
        ];

        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            $user = User::where('id', '=', Auth::user()->id)->first();
            $roles = Role::All();
            $eglises = Eglise::where('nom', '<>', 'Administrateur')->get();
            //dd($eglises);
            $loggedUserInfo = $user;
            //dd($data);
            return view('auth.register', compact('roles', 'eglises', 'loggedUserInfo', 'tableau'));
        } elseif (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserPretre(Auth::user()->id)) {
            $user = User::where('id', '=', Auth::user()->id)->first();
            $roleNom = ['admin', 'cure'];
            $roles = Role::whereNotIn('name', $roleNom)->get();
            $eglises = [];
            //dd($eglises);
            $loggedUserInfo = $user;
            //dd($data);
            return view('auth.register', compact('roles', 'eglises', 'loggedUserInfo', 'tableau'));
        } else {
            return redirect()->route('auth.dashboard');
        }
    }

    function create(Request $request)
    {
        //dd($request->input());

        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            if ($request->eglise == "Veuillez Selectionner") {
                return back()->with('errorchamps', 'Echec!!!Veuillez selectionner le champs eglise');
            }
        }
        if ($request->role == "Veuillez Selectionner" || $request->sexe == "Veuillez Selectionner") {
            return back()->with('errorchamps', 'Echec!!!Veuillez selectionner les champs role, ou sexe');
        }
        $request->validate([
            'role' => 'required',
            'lastname' => 'required|min:4',
            'firstname' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:8',
            'sexe' => 'required',
            'password' => 'required|min:8|max:12'
        ]);
        DB::beginTransaction();
        try {
            $user = new User;
            $numero = $this->generate_cs();
            $user->uuid = $numero;
            if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                $user->ideglise = $request->eglise;
            } else {
                $user->ideglise = renvoiEgliseId(Auth::user()->id);
            }
            $user->name = $request->lastname;
            $user->firstname = $request->firstname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->sexe = $request->sexe;
            $user->online = "oui";
            $user->password = Hash::make($request->password);
            $query = $user->save();
            $insertedId = $user->id;
            DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [$request->role, $insertedId]);
            /*Mail::to("late@pushtudio.com")->bcc("amenyona.late@gmail.com")
						->send(new MessageGoogle("premier test"));*/
            if ($query) {
                return back()->with('success', 'Votre enregistrement s\'est fait avec succes!!!');
            } else {
                return back()->with('error', 'Echec lors de l\'enregistrement. Veuillez refaire!!!');
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    function saveUser(Request $request)
    {
        if ($request->eglise == "Veuillez Selectionner") {
            return back()->with('errorchamps', 'Echec!!!Veuillez selectionner le champ eglise');
        }
        $request->validate([
            'eglise' => 'required',
            'lastname' => 'required|min:4',
            'firstname' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12',
            'new_confirm_password' => 'required_with:password|same:password|min:8|max:12'
        ]);
        //dd($request->all());
        DB::beginTransaction();
        try {
            $user = new User;
            $numero = $this->generate_cs();
            $user->uuid = $numero;
            $user->ideglise = $request->eglise;
            $user->name = $request->lastname;
            $user->firstname = $request->firstname;
            $user->email = $request->email;
            $user->online = "oui";
            $user->password = Hash::make($request->password);
            $query = $user->save();
            $insertedId = $user->id;
            DB::insert('insert into role_user (role_id, user_id) values (?, ?)', [4, $insertedId]);
            /*Mail::to("late@pushtudio.com")->bcc("amenyona.late@gmail.com")
						->send(new MessageGoogle("premier test"));*/
            if ($query) {
                return redirect()->route('auth.login')->with('success', 'Your registration has been successfully done');
            } else {
                return back()->with('error', 'ERROR!!!');
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }





    function dashboard()
    {

        $i = 0;
        $j = 0;
        $k = 0;
        //$user = User::where('id','=',session('LoggedUser'))->first();
        $tablo = array();
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $data = [
            'loggedUserInfo' => $user
        ];
        $loggedUserInfo = User::where('id', Auth::user()->id)->first();
        $hommenumbers = DB::table('users')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->select(
                'users.id',
                'users.ideglise',
                'users.uuid',
                'users.name',
                'users.firstname',
                'users.email',
                'users.phone',
                'users.sexe',
                'users.created_at'
            )
            ->where('eglises.id', renvoiEgliseId(Auth::user()->id))
            ->where('users.sexe', '=', 'masculin')
            ->get();
        $femmenumbers = DB::table('users')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->select(
                'users.id',
                'users.ideglise',
                'users.uuid',
                'users.name',
                'users.firstname',
                'users.email',
                'users.phone',
                'users.sexe',
                'users.created_at'
            )
            ->where('eglises.id', renvoiEgliseId(Auth::user()->id))
            ->where('users.sexe', '=', 'feminin')
            ->get();
        //dd($hommenumbers);

        foreach ($hommenumbers as $hommes) {
            foreach ($femmenumbers as $femmes) {
                if (dateReturn($hommes->created_at) == dateReturn($femmes->created_at)) {
                    $j++;
                }
            }
        }

        //dd($j);
        $datas = DB::table('users')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->select(
                DB::raw('DATE(users.created_at) as dat'),
                DB::raw('users.sexe as genre'),
                DB::raw('count(*) as nombre')
            )
            ->groupBy('dat', 'sexe')
            ->where('eglises.id', renvoiEgliseId(Auth::user()->id))
            ->get();
        /* dd($datas);
                foreach($datas as $key=>$value){
                    //var_dump($value->dat);
                    foreach($value as $va => $data){
                        if($value->dat=$data){
                          $i++;
                        }
                       
                    }
                }*/
        /*'****'.var_dump($i);
                */


        return view('admin.dashboard', compact('loggedUserInfo', 'datas'));
    }


    function voir()
    {
        return view('auth.show');
    }

    function show()
    {

        $tab = [
            'titre1' => 'Voir Utilisateurs',
            'titre2' => 'Utilisateurs'
        ];
        //$user = User::where('id','=',session('LoggedUser'))->first();
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();
        $loggedUserInfo = $user;
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 6);
        //dd($id);
        $dbid = User::where('uuid', $id)->first();
        //dd($dbid['id']);
        $userInfo = DB::table('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->where('users.uuid', $id)
            ->select('eglises.*', 'roles.name as nom_role', 'roles.id as role_id', 'roles.description as description', 'users.*')
            ->get();

        //dd($userInfo);
        //dd($user);
        if (renvoiRoleUser(Auth::user()->id) || verifEgliseAppartenace($id, Auth::user()->id)) {
            return view('auth.show', compact('loggedUserInfo', 'user', 'userInfo', 'tab'));
        } else {
            return redirect()->route('auth.dashboard');
        }
    }

    public function edit()
    {

        $tab = [
            'titre1' => 'Modifier Utilisateurs',
            'titre2' => 'Utilisateurs'
        ];
        //$user = User::where('id','=',session('LoggedUser'))->first();
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        $loggedUserInfo = $user;
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 6);
        $dbid = User::where('uuid', $id)->first();
        //dd($dbid);
        $role = User::find($dbid['id'])->roles()->get();
        $roleid = $role[0]['id'];
        //dd($roleid);
        //dd(session('LoggedUser'));
        $eglise = User::find($dbid['id'])->eglise()->get();
        $egliseid = $eglise[0]['id'];
        //dd($egliseid);
        $user = DB::table('users')
            ->where('id', $dbid['id'])
            ->first();
        $roles = Role::All();
        $eglises = Eglise::All();
        if (renvoiRoleUser(Auth::user()->id) || verifEgliseAppartenace($id, Auth::user()->id)) {
            return view('auth.edit', compact('loggedUserInfo', 'user', 'roles', 'eglises', 'roleid', 'egliseid', 'tab'));
        } else {
            return redirect()->route('auth.dashboard');
        }
    }

    public function update(Request $request)
    {

        if ($request->role == "Veuillez Selectionner" || $request->eglise == "Veuillez Selectionner" || $request->sexe == "Veuillez Selectionner") {
            return back()->with('errorchamps', 'Echec!!!Veuillez selectionner les champs role, eglise ou sexe');
        }
        $my_image = $request->my_image;
        $image = $request->file('image');
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 10);
        if ($image != "") {
            $request->validate([
                'role' => 'required',
                'eglise' => 'required',
                'lastname' => 'required|min:4',
                'firstname' => 'required|min:4',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|min:8',
                'sexe' => 'required',
                'password' => 'required|min:8|max:12',
                'new_confirm_password' => 'required|same:password',
                "image" => "required|image|max:7048"

            ]);
            $my_image = rand() . '.' . $image->getClientOriginalExtension();
            //$image->move(public_path('upload'),$my_image);
            $image->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $my_image);
        } else {

            $request->validate([
                'role' => 'required',
                'eglise' => 'required',
                'lastname' => 'required|min:4',
                'firstname' => 'required|min:4',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'required|min:8',
                'sexe' => 'required',
                'password' => 'required|min:8|max:12',
                'new_confirm_password' => 'required|same:password'

            ]);
        }

        //dd($url);
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->ideglise = $request->eglise;
            $user->name = $request->lastname;
            $user->firstname = $request->firstname;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->birthdate = $request->date_input;
            $user->sexe = $request->sexe;
            $user->online = "oui";
            $user->password = Hash::make($request->password);
            $user->image = $my_image;
            $query = $user->save();
            DB::table('role_user')
                ->where('user_id', $id)
                ->update(['role_id' => $request->role]);
            if ($query) {
                if (isset($request->editprofile)) {
                    return redirect()->route('auth.dashboard')->with('success', 'La modification de votre profile a été faite avec succès!');
                } else {
                    return redirect()->route('auth.listeusers')->with('success', 'La modification a été faite avec succès!');
                }
            }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', $e);
            throw $e;
        }
    }

    function profile()
    {

        $tableau = [
            'liste' => 'Profile Utilisateur',
            'table' => 'Utilisateurs'
        ];
        //$user = User::where('id','=',session('LoggedUser'))->first();
        $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->first();

        $loggedUserInfo = $user;
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 9);
        $dbid = User::where('uuid', $id)->first();
        $userInfo = DB::table('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->where('users.id', $dbid['id'])
            ->select('eglises.*', 'roles.name as nom_role', 'roles.id as role_id', 'roles.description as description', 'users.*')
            ->get();
        $role = User::find($dbid['id'])->roles()->get();
        $roleid = $role[0]['id'];
        $eglise = User::find($dbid['id'])->eglise()->get();
        $egliseid = $eglise[0]['id'];
        $userInfor = DB::table('role_user')
            ->join('users', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->join('eglises', 'users.ideglise', '=', 'eglises.id')
            ->where('eglises.id', $egliseid)
            ->where('roles.name', '=', 'cure')
            ->select('eglises.*', 'roles.name as nom_role', 'roles.id as role_id', 'roles.description as description', 'users.*')
            ->first();
        //dd($egliseid);
        //dd($userInfor);
        $user = DB::table('users')
            ->where('id', $dbid['id'])
            ->first();
        $roles = array(
            'id' => $role[0]['id'],
            'name' => $role[0]['name']
        );
        //dd($roles['id']);
        $eglises = array(
            'id' => $eglise[0]['id'],
            'nom' => $eglise[0]['nom']
        );

        if (Auth::user()->id == $dbid['id']) {
            return view('auth.profile', compact('loggedUserInfo', 'userInfo', 'roles', 'eglises', 'roleid', 'egliseid', 'user', 'userInfor', 'tableau'));
        } else {
            return redirect()->route('dashboard')->with('errorDanger', 'Pourquoi cette tentative???');
        }
    }

    public function fetchUsers(Request $request)
    {
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');
        $query = User::all();
        $output = "";

        foreach ($query as $row) {
            $output .= $row->name . '-' . $row->firstname;
        }
        echo $output;
    }

    public function destroy($id)
    {
        if (renvoiRoleUser(Auth::user()->id)) {
            DB::beginTransaction();
            try {
                $user = User::find($id);
                $user->delete();
                foreach (DB::table('role_user')->where('user_id', $id)->cursor() as $roleuser) {
                    DB::table('role_user')->delete($roleuser->id);
                }
                return redirect()->route('auth.listeusers')->with('succesdanger', 'La suppression a été faite avec succès');
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->with('error', $e);
                throw $e;
            }
        }
    }
}

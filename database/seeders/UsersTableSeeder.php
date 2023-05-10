<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();
        $admin = User::create([
            'uuid' => 'dflldfdf',
            'ideglise' => 1,
            'name' => 'LATE',
            'firstname' => 'Edem',
            'birthdate' =>'09/09/1989',
            'phone' => '45123256',
            'image' =>NULL,
            'sexe' =>'masculin',
            'online' =>'oui',
            'email' => 'late@late.com',
            'password' => Hash::make('password')
        ]);

        $pretre = User::create([
            'uuid' => 'dfdgdfdf',
            'ideglise' => 1,
            'name' => 'ABALO',
            'firstname' => 'Afi',
            'birthdate' =>'09/09/1999',
            'phone' => '877787878',
            'image' => NULL,
            'sexe' => 'feminin',
            'online' =>'non',
            'email' => 'abalo@abalo.com',
            'password' => Hash::make('password')
        ]);

        $pretrecure = User::create([
            'uuid' => 'erzrzz',
            'ideglise' => 2,
            'name' => 'ATTIOGBE',
            'firstname' => 'Simplice',
            'birthdate' =>'09/09/1999',
            'phone' => '969696969',
            'image' => NULL,
            'sexe' => 'masculin',
            'online' =>'non',
            'email' => 'attiogbe@attiogbe.com',
            'password' => Hash::make('password')
        ]);

        $pretrcure = User::create([
            'uuid' => 'otyuty',
            'ideglise' => 3,
            'name' => 'TELOU',
            'firstname' => 'Dominique',
            'birthdate' =>'09/09/1999',
            'phone' => '9099009909',
            'image' => NULL,
            'sexe' => 'feminin',
            'online' => 'non',
            'email' => 'telou@telou.com',
            'password' => Hash::make('password')
        ]);
        
        $secretaire = User::create([
            'uuid' => 'dsfsdfsd',
            'ideglise' => 3,
            'name' => 'AKAKPO',
            'firstname' => 'Augustine',
            'birthdate' =>'09/09/1989',
            'phone' => '23524163',
            'image' => NULL,
            'sexe' => 'feminin',
            'online' => 'non',
            'email' => 'akakpo@akakpo.com',
            'password' => Hash::make('password')
        ]);

        $adminRole = Role::where('name','admin')->first();
        $cureRole = Role::where('name','cure')->first();
        $secretaireRole = Role::where('name','secretaire')->first();

        $admin->roles()->attach($adminRole);
        $pretre->roles()->attach($cureRole);
        $pretrecure->roles()->attach($cureRole);
        $pretrcure->roles()->attach($cureRole);
        $secretaire->roles()->attach($secretaireRole);
    }
}

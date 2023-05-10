<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'name'=>'admin',
            'description' =>'Compte administrateur'
        ]);

        Role::create([
            'name'=>'cure',
            'description' =>'Compte cure'
        ]);
        
        Role::create([
            'name' => 'pretre',
            'description' => 'compte pretre'
        ]);

        Role::create([
            'name' => 'secretaire',
            'description' => 'compte secretaire'
        ]);

        Role::create([
            'name' => 'utilisateur',
            'description' => 'compte utilisateur'
        ]);

    }
}

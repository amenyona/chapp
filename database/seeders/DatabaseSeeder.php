<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TelephonesTableSeeder::class);
        $this->call(HeuresTableSeeder::class);
        $this->call(EglisesTableSeeder::class);
        $this->call(AnnoncesTableSeeder::class);
        $this->call(PayssTableSeeder::class);    
    }
}

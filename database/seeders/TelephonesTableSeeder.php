<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Telephone;

class TelephonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Telephone::truncate();

        Telephone::create([
            'ideglise' => 1,
            'iduser' => 1,
            'numero' => '98631452',
            'libelle' => 'Flooz'
        ]);

        Telephone::create([
            'ideglise' => 2,
            'iduser' => 1,
            'numero' => '75569210',
            'libelle' => 'Orange Money'
        ]);

        Telephone::create([
            'ideglise' => 3,
            'iduser' => 1,
            'numero' => '55569210',
            'libelle' => 'Orange Money'
        ]);
    }
}

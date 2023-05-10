<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Heure;

class HeuresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Heure::truncate();

        Heure::create([
            'ideglise' => 1,
            'iduser' => 1,
            'heure' => '06h30'

        ]);

        Heure::create([
            'ideglise' => 2,
            'iduser' => 1,
            'heure' => '08h30'
        ]);

        Heure::create([
            'ideglise' => 3,
            'iduser' => 1,
            'heure' => '18h00'
        ]);
    }
}

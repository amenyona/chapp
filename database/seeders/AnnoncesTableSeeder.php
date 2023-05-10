<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Annonce;

class AnnoncesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Annonce::truncate();

        Annonce::create([
            'iduser' => 1,
            'ideglise' => 1,
            'libelle' => 'Fête de Don Bosco',
            'dateexpiration' => '2021-10-27 10:46:08',
            'titre' => 'Titre1',
            'statut' => 1
        ]);

        Annonce::create([
            'iduser' => 1,
            'ideglise' => 2,
            'libelle' => 'Mariage Collectif',
            'dateexpiration' => '2021-10-30 10:46:08',
            'titre' => 'Titre2',
            'statut' => 1
        ]);

        Annonce::create([
            'iduser' => 1,
            'ideglise' => 3,
            'libelle' => 'Marche de carême',
            'dateexpiration' => '2021-10-27 10:46:08',
            'titre' => 'Titre3',
            'statut' => 1
        ]);
        

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Eglise;

class EglisesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eglise::truncate();

        Eglise::create([
            'idpays' => 1,
            'iduser' => 1,
            'nom' => 'Administrateur',
            'diocese' => 'Administrateur',
            'quartier' => 'Administrateur',
            'ville' => 'Administrateur',
            'adresse'=> 'Administrateur',
            'email' => 'administrateur@administrateur.com',
            'statut' => 1,
            'comptebancaire' =>'45678597222',
            'montantmesse' =>'3000'

        ]);

        Eglise::create([
            'idpays' => 2,
            'iduser' => 1,
            'nom' => 'Paroisse Saint Gabriel',
            'diocese' => 'Ouagadougou',
            'quartier' => 'Thanguin',
            'ville' => 'Ouagadougou',
            'adresse'=> 'Secteur 2',
            'email' => 'saintgabriel@saintgabriel.com',
            'statut' => 1,
            'comptebancaire' =>'3333333333',
            'montantmesse' =>'2000'

        ]);

        Eglise::create([
            'idpays' => 3,
            'iduser' => 1,
            'nom' => 'Paroisse Don Bosco',
            'diocese' => 'Abidjan',
            'quartier' => 'Kokodji',
            'ville' => 'Ouagadougou',
            'adresse'=> 'Secteur 1',
            'email' => 'donbosco@donbosco.com',
            'statut' => 1,
            'comptebancaire' =>'12222222',
            'montantmesse' =>'3000'

        ]);
        
        Eglise::create([
            'idpays' => 1,
            'iduser' => 1,
            'nom' => 'Paroisse Maria Auxiliadora de Gbenyedzi',
            'diocese' => 'Lomé',
            'quartier' => 'Gbenyedzi',
            'ville' => 'Lomé',
            'adresse'=> 'Secteur 3',
            'email' => 'gbenyedzi@gbenyedzi.com',
            'statut' => 1,
            'comptebancaire' =>'456897222',
            'montantmesse' =>'3000'

        ]);
    }
}

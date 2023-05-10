<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Pays;
use App\Models\Eglise;

class PayssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pays::truncate();
        DB::table('eglise_pays')->truncate();

        $paysun = Pays::create([
            'nom' => 'Togo',
            'capitale' => 'Lomé',
            'statut' =>1,
            'indicatif' =>'+228',
            'plusieurmessededuction' => 2,
            'deuxmessededuction' => 1,
            'iduser' =>1
        ]);

        $paysdeux = Pays::create([
            'nom' => 'Burkina Faso',
            'capitale' => 'Ouagadougou',
            'statut' =>1,
            'indicatif' =>'+226',
            'plusieurmessededuction' => 2,
            'deuxmessededuction' => 1,
            'iduser' =>1

        ]);

        $paytrois = Pays::create([
            'nom' => 'Côte d\'Ivoire',
            'capitale' => 'Abidjan',
            'statut' =>1,
            'indicatif' =>'+225',
            'plusieurmessededuction' => 2,
            'deuxmessededuction' => 1,
            'iduser' =>1

        ]);

        $paysunEglise = Eglise::where('nom','=','Paroisse Maria Auxiliadora de Gbenyedzi')->first();
        $paysdeuxEglise = Eglise::where('nom','=','Paroisse Saint Gabriel')->first();
        $paytroisEglise = Eglise::where('nom','=','Paroisse Don Bosco')->first();

        $paysun->eglises()->attach($paysunEglise);
        $paysdeux->eglises()->attach($paysdeuxEglise);
        $paytrois->eglises()->attach($paytroisEglise);
   
    }
}

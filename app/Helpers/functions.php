<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Eglise;
use App\Models\Commentaire;
use App\Models\Article;
use App\Models\AutreDocument;
use App\Models\CarnetDeBapteme;
use App\Models\Annonce;
use App\Models\Contact;
use App\Models\Pays;
use Carbon\Carbon;


function renvoiRoleUser($id)
{
    //dd(Auth::user()->id);
    $roleUser = User::find(Auth::user()->id)->roles()->get();
    $resu = User::first()->isAdmin($roleUser[0]['name']);
    return $resu;
}

function renvoiRoleUserP($id)
{
    $roleUser = User::find(Auth::user()->id)->roles()->get();
    $resu = User::first()->isCure($roleUser[0]['name']);
    //dd($resu);
    return $resu;
}

function renvoiRoleUserPretre($id)
{
    $roleUser = User::find(Auth::user()->id)->roles()->get();
    $resu = User::first()->isPretre($roleUser[0]['name']);
    //dd($resu);
    return $resu;
}


function renvoiRoleUserS($id)
{
    $roleUser = User::find(Auth::user()->id)->roles()->get();
    $resu = User::first()->isSecretaire($roleUser[0]['name']);
    return $resu;
}

function renvoiRoleUserSimple($id)
{
    $roleUser = User::find(Auth::user()->id)->roles()->get();
    $resu = User::first()->isUtilisateur($roleUser[0]['name']);
    return $resu;
}

function couperMots($texte, $nb)
{
    if (strlen($texte) >= $nb) {
        $texte  = trim(substr($texte, 0, $nb));
        $texte .= '...';
    }
    return $texte;
}

function verifEgliseAppartenace($uuid, $iduser)
{
    $egliseId = User::where('uuid', '=', $uuid)->first();
    $egliseIdUser = User::where('id', '=', $iduser)->first();
    if ($egliseId['ideglise'] == $egliseIdUser['ideglise']) {
        return true;
    } else {
        return false;
    }
}

function renvoiEgliseId($iduser)
{
    $egliseIdUser = User::where('id', '=', Auth::user()->id)->first();
    return $egliseIdUser['ideglise'];
}

function dateReturn($date)
{
    $time = strtotime($date);
    $newforma = date("d-m-Y", $time);
    return  $newforma;
}

function renvoiEgliseInfo($iduser)
{
    $egliseIdUser = User::where('id', '=', $iduser)->first();
    $egliseInfo = Eglise::where('id', $egliseIdUser['ideglise'])->firstOrFail();
    $paysInfos = Pays::where('id', $egliseInfo->idpays)->firstOrFail();
     $egliseInfos = DB::table('eglise_pays')
        ->join('eglises', 'eglise_pays.eglise_id', '=', 'eglises.id')
        ->join('pays', 'eglise_pays.pays_id', '=', 'pays.id')
        ->where('eglises.id', $egliseIdUser['ideglise'])
        ->select('pays.*')
        ->first();
//dd($egliseInfos->nom);
    // return $egliseInfo->eglisenom . '/' . $egliseInfo->eglisequartier . '/' . $egliseInfo->paysnom;
    return $egliseInfo->nom. '/' . $egliseInfo->quartier;
} 

function renvoiPaysInfo($idEglise){
    $egliseInfo = Eglise::where('id', $idEglise)->firstOrFail();
    $paysInfo = Pays::where('id', $egliseInfo->idpays)->firstOrFail();
    return $paysInfo->nom;
}


function renvoiAdminEglise()
{
    $egliseIdUser = User::where('id', Auth::user()->id)->first();
    $egliseInfo = DB::table('eglises')->where('eglises.id', $egliseIdUser->ideglise)->get();
    //dd($egliseInfo[0]->nom);
    if ($egliseInfo[0]->nom == "ADMINISTRATEUR") {
        return true;
    } else {
        return false;
    }
}

function renvoiEglise($ideglise)
{
    $egliseInfo = DB::table('eglise_pays')
        ->join('eglises', 'eglise_pays.eglise_id', '=', 'eglises.id')
        ->join('pays', 'eglise_pays.pays_id', '=', 'pays.id')
        ->where('eglises.id', $ideglise)
        ->select('eglises.nom as eglisenom', 'eglises.quartier as eglisequartier', 'pays.nom as paysnom')
        ->first();

    return $egliseInfo->eglisenom . '-' . $egliseInfo->eglisequartier . '-' . $egliseInfo->paysnom;
}

function renvoiIdEgliseForArticle($idArticle)
{
    $egliseIdUser = User::where('id', '=', Auth::user()->id)->first();
    $articleCount = DB::table('eglises')
        ->join('articles', 'eglises.id', '=', 'articles.idEglise')
        ->where([
            ['articles.id', $idArticle],
            ['articles.idEglise', $egliseIdUser['ideglise']]
        ])->get()->count();
    if ($articleCount > 0) {
        return true;
    } else {
        return false;
    }
}

function renvoiUserName($id)
{
    $resu = User::where('id', $id)->first();
    return $resu['name'] . ' ' . $resu['firstname'];
}

function renvoiUserPhone($id)
{
    $resu = User::where('id', $id)->first();
    return $resu['phone'];
}

function renvoiUserEmail($id)
{
    $resu = User::where('id', $id)->first();
    return $resu['email'];
}

function renvoiCommentUserId($id)
{
    $commentaireInfo = Commentaire::where('id', '=', $id)->first();
    $userInfo = User::where('id', '=', $commentaireInfo['iduser'])->first();
    return $userInfo['image'];
}

function renvoiArticleTitre($id)
{
    $article = Article::where('id', '=', $id)->first();
    $resu = $article->titre;
    return $resu;
}


function renvoiNumbers($id)
{
    $commentaires = Commentaire::where('articleId', '=', $id)->get();
    $nbrComments = $commentaires->count();
    return $nbrComments;
}

function renvoiActualitesNumbers($iduser)
{
    $actualites = Article::where('idEglise', '=', renvoiEgliseId($iduser))->get();
    $nbrArticles = $actualites->count();
    return $nbrArticles;
}

function renvoiCommentaireNumbers($iduser)
{
    $commentairess = Commentaire::where('idEglise', '=', renvoiEgliseId($iduser))->get();
    $nbrCommentss = $commentairess->count();
    return $nbrCommentss;
}

function renvoiMesCommentaireNumbers($iduser)
{
    $commentairess = Commentaire::where('iduser', '=', $iduser)->get();
    $nbrCommentss = $commentairess->count();
    return $nbrCommentss;
}

function renvoiUsers($iduser)
{
    $users = User::where('idEglise', '=', renvoiEgliseId($iduser))->get();
    $nbrUsers = $users->count();
    return $nbrUsers;
}

function renvoiContactNumbers()
{
    $contactss = Contact::all();
    $nbrContact = $contactss->count();
    return $nbrContact;
}

function renvoieCarnetDeBapteme($arg)
{
    $docx = 0;
    $repertoirec = DB::table('repertoires')
        ->join('carnet_de_baptemes', 'repertoires.id', '=', 'carnet_de_baptemes.idrepertoire')
        ->join('eglises', 'repertoires.ideglise', '=', 'eglises.id')
        ->get();
    foreach ($repertoirec as $item) {
        if ($arg == $item->type) {
            $docx = DB::table('carnet_de_baptemes')->count();
        }
    }

    $repertoires = DB::table('repertoires')
        ->join('autre_documents', 'repertoires.id', '=', 'autre_documents.repertoireId')
        ->join('eglises', 'repertoires.ideglise', '=', 'eglises.id')
        ->select('repertoires.*')
        ->get();
    //dd($femmenumbers);
    foreach ($repertoires as $item) {
        if ($arg == $item->type) {
            $docx = DB::table('autre_documents')->where('autre_documents.repertoireId', '=', $item->id)->count();
        }
    }
    return $docx;
}

function renvoieDocumentTotal()
{
    $carnets = Eglise::find(renvoiEgliseId(Auth::user()->id))->carnets()->count();
    $docx = Eglise::find(renvoiEgliseId(Auth::user()->id))->repertoires()->count();
    return $carnets + $docx;
}

function renvoiDossierTotal()
{
    $repertoires  = Eglise::find(renvoiEgliseId(Auth::user()->id))->repertoires()->count();
    return $repertoires;
}

function renvoiNumberDossierTotal()
{
    $repertoires  = Eglise::find(renvoiEgliseId(Auth::user()->id))->repertoires()->count();
    //dd($repertoires);
    if ($repertoires > 0) {
        return true;
    } else {
        return false;
    }
}

function verifIfAnnonceIsValid($idannoce)
{
    $today = Carbon::now();
    $annonces = Annonce::where([
        ['dateexpiration', '>', $today],
        ['id', $idannoce]
    ])->get()->count();
    if ($annonces > 0) {
        return true;
    } else {
        return false;
    }
}



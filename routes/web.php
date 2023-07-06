<?php

use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CommentaireController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EgliseController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\RepertoireController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\MesseController;
use App\Http\Controllers\TelephoneController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/tableau-de-bord', function () {
    return view('dashboard');
})->middleware(['auth'])->name('tableau-de-bord');

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->name('auth.logout');
    Route::get('creer-utilisateur', [UserAuthController::class, 'registered'])->name('auth.register');
    Route::get('liste-utilisateurs', [UserAuthController::class, 'index'])->name('auth.listeusers');
    Route::post('create', [UserAuthController::class, 'create'])->name('auth.create');
    Route::post('check', [UserAuthController::class, 'check'])->name('auth.check');
    Route::get('voir', [UserAuthController::class, 'voir'])->name('voir');
    Route::get('tableau-de-bord', [UserAuthController::class, 'dashboard'])->name('auth.dashboard');
    // Route::get('logout',[UserAuthController::class,'logout'])->name('auth.logout');
    Route::get('show', [UserAuthController::class, 'show'])->name('auth.show');
    Route::get('profile', [UserAuthController::class, 'profile'])->name('auth.profile');
    Route::get('edit', [UserAuthController::class, 'edit'])->name('auth.edit');
    Route::post('saveUser', [UserAuthController::class, 'saveUser'])->name('auth.saveUser');
    Route::get('delete/{id}', [UserAuthController::class, 'destroy'])->name('auth.delete');
    Route::put('modifier', [UserAuthController::class, 'update'])->name('auth.update');
    Route::get('liste-des-rôles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('rolecreate', [RoleController::class, 'create'])->name('roles.create');
    Route::post('rolestore', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roleshow', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roleedit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roleupdate', [RoleController::class, 'update'])->name('roles.update');
    Route::get('deleterole/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('liste-des-pays', [PaysController::class, 'index'])->name('pays.index');
    Route::get('payscreate', [PaysController::class, 'create'])->name('pays.create');
    Route::post('paystore', [PaysController::class, 'store'])->name('pays.store');
    Route::get('payshow', [PaysController::class, 'show'])->name('pays.show');
    Route::get('paysedit', [PaysController::class, 'edit'])->name('pays.edit');
    Route::put('paysupdate', [PaysController::class, 'update'])->name('pays.update');
    Route::get('liste-des-eglises', [EgliseController::class, 'index'])->name('eglise.index');
    Route::get('eglisecreate', [EgliseController::class, 'create'])->name('eglise.create');
    Route::post('eglisestore', [EgliseController::class, 'store'])->name('eglise.store');
    Route::get('eglisehow', [EgliseController::class, 'show'])->name('eglise.show');
    Route::get('egliseedit', [EgliseController::class, 'edit'])->name('eglise.edit');
    Route::put('egliseupdate', [EgliseController::class, 'update'])->name('eglise.update');
    Route::get('eglisedelete/{id}', [EgliseController::class, 'destroy'])->name('eglise.delete');
    Route::get('liste-des-annonces', [AnnonceController::class, 'index'])->name('annonce.index');
    Route::get('annonce-creation', [AnnonceController::class, 'create'])->name('annonce.create');
    Route::post('annoncestore', [AnnonceController::class, 'store'])->name('annonce.store');
    Route::get('annonce-detail', [AnnonceController::class, 'show'])->name('annonce.show');
    Route::get('annonceedit', [AnnonceController::class, 'edit'])->name('annonce.edit');
    Route::put('annonceupdate', [AnnonceController::class, 'update'])->name('annonce.update');
    Route::get('annoncedelete/{id}', [AnnonceController::class, 'destroy'])->name('annonce.delete');
    Route::get('consult', [AnnonceController::class, 'consultAnnonce'])->name('anonce.consultAnnonce');
    Route::get('annonces-expirees', [AnnonceController::class, 'consultAnnonceExpiree'])->name('anonce.consultAnnonceExpiree');
    Route::post('fetch', [AnnonceController::class, 'fetch'])->name('annonce.fetch');
    Route::post('consultation-annonces-actives', [AnnonceController::class, 'afficherAnnonce'])->name('annonce.afficherAnnonce');
    Route::post('consultation-annonces-expirees', [AnnonceController::class, 'afficherAnnonceExprirees'])->name('annonce.afficherAnnonceExprirees');
    Route::get('statistique', [StatistiqueController::class, 'index'])->name('statisque.index');
    //Route::get('chat',[MessageController::class,'index'])->name('chat.index');
    Route::get('liste-des-articles', [ArticleController::class, 'index'])->name('article.index');
    Route::get('articlecreate', [ArticleController::class, 'create'])->name('article.create');
    Route::post('articlestore', [ArticleController::class, 'store'])->name('article.store');
    Route::get('articleedit', [ArticleController::class, 'edit'])->name('article.edit');
    Route::put('articleupdate', [ArticleController::class, 'update'])->name('article.update');
    Route::get('articledelete/{id}', [ArticleController::class, 'destroy'])->name('article.delete');
    Route::get('blog', [ArticleController::class, 'listArticle'])->name('article.listArticle');
    Route::get('blog-detail', [ArticleController::class, 'show'])->name('article.show');
    Route::post('saveCommentaire', [ArticleController::class, 'saveCommentaire'])->name('article.saveCommentaire');
    Route::get('liste-des-commentaires', [CommentaireController::class, 'index'])->name('commentaire.index');
    Route::get('liste-de-mes-commentaires', [CommentaireController::class, 'mescommentaires'])->name('commentaire.mescommentaires');
    Route::get('commentaire-detail', [CommentaireController::class, 'show'])->name('commentaire.show');
    Route::get('commentairedelete/{id}', [CommentaireController::class, 'destroy'])->name('commentaire.delete');
    Route::get('contactliste', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contactcreate', [ContactController::class, 'create'])->name('contact.create');
    Route::post('contactstore', [ContactController::class, 'store'])->name('contact.store');
    Route::get('contactshow', [ContactController::class, 'show'])->name('contact.show');
    Route::get('contactdelete/{id}', [ContactController::class, 'destroy'])->name('contact.delete');
    Route::get('repertoireliste', [RepertoireController::class, 'index'])->name('repertoire.index');
    Route::get('repertoirecreate', [RepertoireController::class, 'create'])->name('repertoire.create');
    Route::post('repertoirestore', [RepertoireController::class, 'store'])->name('repertoire.store');
    Route::get('repertoirefiles', [RepertoireController::class, 'listeFiles'])->name('repertoire.listeFiles');
    Route::get('repertoirecreatecarnet', [RepertoireController::class, 'createcarnet'])->name('repertoire.createcarnet');
    Route::post('repertoirestorecarnet', [RepertoireController::class, 'storecarnet'])->name('repertoire.storecarnet');
    Route::get('repertoireshowcarnet', [RepertoireController::class, 'showcarnet'])->name('repertoire.showcarnet');
    Route::get('repertoireeditcarnet', [RepertoireController::class, 'editcarnet'])->name('repertoire.editcarnet');
    Route::put('repertoireupdatecarnet', [RepertoireController::class, 'updateCarnet'])->name('repertoire.updateCarnet');
    Route::get('repertoiredelete/{id}', [RepertoireController::class, 'destroyCarnet'])->name('repertoire.delete');
    Route::get('repertoirecreatedoc', [RepertoireController::class, 'createdoc'])->name('repertoire.createdoc');
    Route::post('repertoirestoredocu', [RepertoireController::class, 'storedoc'])->name('repertoire.storedoc');
    Route::get('repertoireshowdoc', [RepertoireController::class, 'showdoc'])->name('repertoire.showdoc');
    Route::get('repertoireeditdoc', [RepertoireController::class, 'editdoc'])->name('repertoire.editdoc');
    Route::put('repertoireupdateDoc', [RepertoireController::class, 'updateDoc'])->name('repertoire.updateDoc');
    Route::get('repertoiredeleteDoc/{id}', [RepertoireController::class, 'destroyDoc'])->name('repertoire.destroyDoc');
    Route::get('repertoireedit', [RepertoireController::class, 'edit'])->name('repertoire.edit');
    Route::put('repertoireupdate', [RepertoireController::class, 'update'])->name('repertoire.update');
    Route::get('messe-liste', [MesseController::class, 'index'])->name('messe.index');
    Route::get('telephones-liste', [TelephoneController::class, 'index'])->name('telephone.index');
    Route::get('telephones-create', [TelephoneController::class, 'create'])->name('telephone.create');
    Route::post('telephones-store', [TelephoneController::class, 'store'])->name('telephone.store');
    Route::get('telephones-show', [TelephoneController::class, 'show'])->name('telephone.show');
 
});
Route::get('inscription', [UserAuthController::class, 'inscrire'])->name('auth.inscrire');
Route::get('mon-espace-de-travail', [UserAuthController::class, 'acceder'])->name('auth.acceder');
Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('auth.back');
require __DIR__ . '/auth.php';

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categorie;
use App\Models\Commentaire;
use App\Models\Eglise;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = [];
        $tableau = [
            'liste' => 'La Liste des articles',
            'table' => 'Articles'
        ];

        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {           
            $articles = Article::latest()->orderBy('titre', 'asc')->simplePaginate(25); 
            //dd($articles); 
          }else if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {            
            $articles = Article::latest()->where([
                ['statut', '!=', 'suspendu'],
                ['idEglise', renvoiEgliseId(Auth::user()->id)]
            ])->orderBy('titre', 'asc')->simplePaginate(25);
            //dd($categories);       
        }
        //dd($articles); 
        $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
        return view('article.index', compact('loggedUserInfo', 'articles', 'tableau'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eglises = [];
        $tableau = [
            'liste' => 'Créer Articles',
            'table' => 'Articles'
        ];
        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
          $eglises = Eglise::where('nom', '<>', 'Administrateur')->get();  
        }
        if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();            
            return view('article.create', compact('loggedUserInfo', 'tableau', 'eglises'));
        }
    }

    public function generate_cs()
    {
        $c1 = "art";
        $c2 = rand(1, 99999);
        $c2 = str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3 = range('a', 'z');
        shuffle($c3);
        $c3 = strtoupper($c3[0]);
        $c = $c1 . $c2 . $c3;
        return $c;
    }
    public function generate_css()
    {
        $c1 = "comm";
        $c2 = rand(1, 99999);
        $c2 = str_pad($c2, 5, '0', STR_PAD_LEFT);
        $c3 = range('a', 'z');
        shuffle($c3);
        $c3 = strtoupper($c3[0]);
        $c = $c1 . $c2 . $c3;
        return $c;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            if ($request->eglise == "Veuillez Selectionner") {
                return back()->with('errorchamps', 'Echec!!!Veuillez selectionner le champs eglise');
            }
        }

        if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {

            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            $image = $request->file('image');
            $numero = $this->generate_cs();
            if ($image != "") {
                $request->validate([
                    'titre' => 'required|min:4',
                    'contenu' => 'required|min:8',
                    'image' => "required|image|max:7048"
                ]);
                $my_image = rand() . '.' . $image->getClientOriginalExtension();
                //$image->move(public_path('upload'),$my_image);
                $image->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $my_image);
            } else {
                $request->validate([
                    'titre' => 'required|min:4',
                    'contenu' => 'required|min:8'
                ]);
                $my_image = "";
            }

            $article = new Article;
            $article->iduser = Auth::user()->id;
            if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                $article->ideglise = $request->eglise;
            } else {
                $article->idEglise = renvoiEgliseId(Auth::user()->id);
            }
            $article->uuid = $numero;
            $article->titre = $request->titre;
            $article->contenu = $request->contenu;
            $article->image = $my_image;
            $article->statut = "publie";
            $article->save();
            return back()->with('success', 'Votre article a été créé avec succès');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {


        $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
        $url = $_SERVER['REQUEST_URI'];
        $id = substr($url, 13);
        $tableau = [
            'liste' => 'Voir Articles',
            'table' => 'Articles'
        ];
        //dd($id);
        $article = Article::where('uuid', $id)->first();
        $dbid = Article::where('uuid', $id)->first();
        //dd($article);
        $commentaires = DB::table('articles')
            ->join('commentaires', 'articles.id', '=', 'commentaires.articleId')
            ->where('commentaires.articleId', $dbid['id'])
            ->select('commentaires.*')
            ->get();
        //dd($commentaires);
        return view('article.show', compact('loggedUserInfo', 'article', 'commentaires', 'tableau'));
    }

    public function saveCommentaire(Request $request)
    {

        $request->validate([
            'idarticle' => 'required',
            'contenu' => 'required'
        ]);
        $numero = $this->generate_css();
        $commentaire = new Commentaire;
        $commentaire->articleId = $request->idarticle;
        $commentaire->iduser = Auth::user()->id;
        $commentaire->idEglise = renvoiEgliseId(Auth::user()->id);
        $commentaire->uuid = $numero;
        $commentaire->contenu = $request->contenu;
        $commentaire->save();
        return back()->with('success', 'Votre commentaire a été envoyé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $eglises = [];
        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            $eglises = Eglise::where('nom', '<>', 'Administrateur')->get();  
          }
        $tableau = [
            'liste' => 'Modifier Articles',
            'table' => 'Articles'
        ];
        if ((renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) || renvoiRoleUserS(Auth::user()->id)) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url, 13);
            //dd($id);
            $article = Article::where('uuid', $id)->first();
            return view('article.edit', compact('loggedUserInfo', 'article', 'tableau','eglises'));
        } else {
            return redirect()->route('auth.dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
            if ($request->eglise == "Veuillez Selectionner") {
                return back()->with('errorchamps', 'Echec!!!Veuillez selectionner le champs eglise');
            }
        }

        if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {

            $my_image = $request->my_image;
            $image = $request->file('image');
            //var_dump($request->input());
            //dd($my_image);
            if ($image != "") {
                $request->validate([
                    'titre' => 'required|min:4',
                    'contenu' => 'required|min:8',
                    'image' => "required|image|max:7048"
                ]);
                $my_image = rand() . '.' . $image->getClientOriginalExtension();
                //$image->move(public_path('upload'),$my_image);
                $image->move($_SERVER['DOCUMENT_ROOT'] . '/upload', $my_image);
            } else {
                $request->validate([
                    'titre' => 'required|min:4',
                    'contenu' => 'required|min:8'
                ]);
            }
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url, 15);

            $article = Article::find($id);
            $article->iduser = Auth::user()->id;
            if (renvoiRoleUser(Auth::user()->id) && renvoiAdminEglise()) {
                $article->ideglise = $request->eglise;
            }
            $article->titre = $request->titre;
            $article->contenu = $request->contenu;
            $article->image = $my_image;
            $article->statut = "publie-modifie";
            $article->save();
            return redirect()->route('article.index')->with('success', 'Cet article a été modifié avec succès');
        }
    }

    public function listArticle()
    {

        $nouveaux = array();
        $i = 0;
        $tableau = [
            'liste' => 'La Liste Des Actualités',
            'table' => 'Articles'
        ];
        $articlenouveaux = Article::orderBy('titre', 'asc')->get();
        foreach ($articlenouveaux as $arti) {
            if ($i < 2) {
                $nouveaux[] = $arti;
                $i++;
            } else {
                break;
            }
        }

        if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id) || renvoiRoleUserSimple(Auth::user()->id)) {
            $loggedUserInfo = User::where('id', '=', Auth::user()->id)->first();
            $articles = Article::latest()->where('statut', '!=', 'suspendu')->orderBy('titre', 'asc')->simplePaginate(25);
            //dd($categories);
            return view('article.liste', compact('loggedUserInfo', 'articles', 'tableau', 'nouveaux'));
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {

        if (renvoiRoleUser(Auth::user()->id) || renvoiRoleUserP(Auth::user()->id) || renvoiRoleUserS(Auth::user()->id)) {
            $url = $_SERVER['REQUEST_URI'];
            $id = substr($url, 15);
            //dd($id);
            DB::beginTransaction();
            try {
                $article = Article::find($id);
                $article->delete();
                return redirect()->route('article.index')->with('succesdanger', 'La suppression a été faite avec succès');
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                throw $th;
            }
        }
    }
}

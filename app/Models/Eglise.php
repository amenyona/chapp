<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Telehone;
use App\Models\Heure;
use App\Models\Annonce;
use App\Models\Article;
use App\Models\Commentaire;

class Eglise extends Model
{
    use HasFactory;
    protected $fillable = ['idpays','iduser','nom','diocese','quartier','ville',
    'adresse','email','statut','comptebancaire','montantmesse'];

    /**
     * Get all of the users for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'ideglise', 'id');
    }
    
    /**
     * The messes that belong to the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function messes()
    {
        return $this->belongsToMany('App\Models\Messe');
    }

    /**
     * Get all of the telephones for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telephones()
    {
        return $this->hasMany(Telephone::class, 'ideglise', 'id');
    }

    /**
     * The pays that belong to the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pays()
    {
        return $this->belongsToMany('App\Models\Pays');
    }

    /**
     * Get all of the heures for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heures()
    {
        return $this->hasMany(Heure::class, 'ideglise', 'id');
    }

    /**
     * Get all of the annonces for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'ideglise', 'id');
    }
    
    
    /**
     * Get all of the comments for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carnets()
    {
        return $this->hasMany(CarnetDeBapteme::class, 'ideglise', 'id');
    }

    /**
     * Get all of the comments for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repertoires()
    {
        return $this->hasMany(Repertoire::class, 'ideglise', 'id');
    }

    /**
     * Get all of the autreDocuments for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function autreDocuments()
    {
        return $this->hasMany(AutreDocument::class, 'egliseId', 'id');
    }
    /**
     * Get all of the autreDocuments for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'idEglise', 'id');
    }
    /**
     * Get all of the autreDocuments for the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'idEglise', 'id');
    }
}

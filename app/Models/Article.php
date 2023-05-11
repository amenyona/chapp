<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Eglise;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['iduser','idEglise','uuid','titre','contenu','image','statut','nom','quartier'];

     /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    /**
     * Get all of the commentaire for the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'articleId', 'id');
    }

       /**
     * Get the user that owns the Article
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'idEglise', 'id');
    }
}

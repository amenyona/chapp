<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;
use App\Models\Eglise;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = ['userId','idEglise','articleId','contenu','nom','prenom','email','statut'];

    /**
     * Get the Article that owns the Commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Article::class, 'articleId', 'id');
    }

    /**
     * Get the Article that owns the Commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }
    /**
     * Get the Article that owns the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'idEglise', 'id');
    }


}

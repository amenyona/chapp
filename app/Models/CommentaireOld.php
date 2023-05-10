<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Article;
use App\Models\User;
class Commentaire extends Model
{
    use HasFactory;
    protected $fillable = ['userId','articleId','contenu','nom','prenom','email','statut'];

    /**
     * Get the Article that owns the Commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function article()
    {
        return $this->belongsTo(Commentaire::class, 'articleId', 'id');
    }

    /**
     * Get the Article that owns the Commentaire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(Commentaire::class, 'iduser', 'id');
    }


}

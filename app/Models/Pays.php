<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Eglise;

class Pays extends Model
{
    use HasFactory;
    protected $fillable = ['nom','capitale','statut','indicatif','plusieurmessededuction','deuxmessededuction','iduser'];

    /**
     * Get the user that owns the Pays
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    /**
     * The eglises that belong to the Pays
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eglises()
    {
        return $this->belongsToMany('App\Models\Eglise');
    }

    
}

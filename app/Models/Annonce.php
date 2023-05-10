<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eglise;
use App\Models\User;

class Annonce extends Model
{
    use HasFactory;
    protected $fillable = ['iduser','ideglise','libelle','dateexpiration','titre','statut'];

    /**
     * Get the eglise that owns the Annonce
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'ideglise', 'id');
    }

    /**
     * Get the user that owns the Annonce
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }
    
}

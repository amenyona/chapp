<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eglise;
use App\Models\Messe;

class Heure extends Model
{
    use HasFactory;
    protected $fillable = ['ideglise','iduser','heure'];

    /**
     * Get the eglise that owns the Heure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'ideglise', 'id');
    }

    /**
     * Get all of the messes for the Heure
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messes()
    {
        return $this->hasMany(Messe::class, 'idheure', 'id');
    }

    /**
     * Get the user that owns the Heure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

}

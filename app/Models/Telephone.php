<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eglise;

class Telephone extends Model
{
    use HasFactory;

    protected $fillable = ['ideglise','iduser','numero','libelle'];

    /**
     * Get the eglise that owns the Telephone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'ideglise', 'id');
    }

    /**
     * Get the user that owns the Telephone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }


}

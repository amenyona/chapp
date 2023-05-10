<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Eglise;
use App\Models\CarnetDeBapteme;
use App\Models\AutreDocument;

class Repertoire extends Model
{
    use HasFactory;

    protected $fillable = ['iduser','ideglise','nom','description','type'];

    /**
     * Get the user that owns the Repertoire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

    /**
     * Get the user that owns the Repertoire
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'ideglise', 'id');
    }

    /**
     * Get all of the comments for the Repertoire
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carnetDeBaptemes()
    {
        return $this->hasMany(CarnetDeBapteme::class, 'idrepertoire', 'id');
    }

    /**
     * Get all of the autreDocuments for the Repertoire
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function autreDocuments()
    {
        return $this->hasMany(AutreDocument::class, 'repertoireId', 'id');
    }
}

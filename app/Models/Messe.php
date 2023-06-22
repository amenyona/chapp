<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MesseIntension;
use App\Models\Heure;

class Messe extends Model
{
    use HasFactory;
    protected $fillable = ['uuid','idheure','idTelephone','intention_id','user_id','messedateenvoi','messedateenvoi',
                           'messefrequence','messedate','messedebut','messefin','messeargent','messestatut',
                           'email','prix','quartier','ville','telephone','adresse','nom','image','nombremesse','datetraitement',
                           'sexe','etat'
                          ];
    /**
     * Get the eglise that owns the Heure
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function intention()
    {
        return $this->belongsTo(MesseIntension::class, 'user_id', 'id');
    }

     /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

     /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function heure()
    {
        return $this->belongsTo(Heure::class, 'idheure', 'id');
    }

     /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function telephone()
    {
        return $this->belongsTo(Heure::class, 'idTelephone', 'id');
    }

    /**
     * The messes that belong to the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function eglises()
    {
        return $this->belongsToMany('App\Models\Eglise');
    }

    /**
     * The messes that belong to the Eglise
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
    
}

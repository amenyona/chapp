<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Eglise;
use App\Models\Repertoire;

class CarnetDeBapteme extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','ideglise','idrepertoire','uuid','iduserCreator','imageCarnet','description'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function eglise(){
        return $this->belongsTo(Eglise::class,'ideglise','id');
    }

    /**
     * Get the user that owns the CarnetDeBapteme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repertoire()
    {
        return $this->belongsTo(Repertoire::class, 'idrepertoire', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Eglise;
use App\Models\Repertoire;

class AutreDocument extends Model
{
    use HasFactory;

    protected $fillable = ['userId','egliseId','repertoireId','uuid','titre','imageDoc','description'];

    public function user(){
        return $this->belongsTo(User::class,'userId','id');
    }

    public function eglise(){
        return $this->belongsTo(Eglise::class,'egliseId','id');
    }

    /**
     * Get the user that owns the CarnetDeBapteme
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repertoire()
    {
        return $this->belongsTo(Repertoire::class, 'repertoireId', 'id');
    }
}

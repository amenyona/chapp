<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pays;
use App\Models\Eglise;
use App\Models\Telephone;
use App\Model\Annonce;
use App\Models\Heure;
use App\Models\Article;
use App\Models\Commentaire;
use App\Models\CarnetDeBapteme;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ideglise',
        'name',
        'firstname',
        'phone',
        'image',
        'email',
        'sexe',
        'online',
        'birthdate',
        'password',
        'statutcarnet',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function isAdmin($admin)
    {
        $res =  $this->roles()->where('name', $admin)->first();
        if (!empty($res)) {
            if ($res['name'] == "admin") {
                return true;
            } else {
                return false;
            }
        }
    }

    public function isCure($cure)
    {

        if ($cure == "cure") {
            return true;
        } else {
            return false;
        }
    }

    public function isPretre($pretre)
    {
        if ($pretre == "pretre") {
            return true;
        } else {
            return false;
        }
    }

    public function isSecretaire($secre)
    {
        if ($secre == "secretaire") {
            return true;
        } else {
            return false;
        }
    }

    public function isUtilisateur($secre)
    {
        if ($secre == "utilisateur") {
            return true;
        } else {
            return false;
        }
    }



    /**
     * Get all of the pays for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pays()
    {
        return $this->hasMany(Pays::class, 'idpays', 'id');
    }

    /**
     * Get the eglise that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function eglise()
    {
        return $this->belongsTo(Eglise::class, 'ideglise', 'id');
    }

    /**
     * Get all of the telephones for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function telephones()
    {
        return $this->hasMany(Telephone::class, 'iduser', 'id');
    }

    /**
     * Get all of the annonces for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annonces()
    {
        return $this->hasMany(Annonce::class, 'iduser', 'id');
    }

    /**
     * Get all of the heures for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function heures()
    {
        return $this->hasMany(Heure::class, 'iduser', 'id');
    }

    /**
     * Get all of the Articles for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany(Article::class, 'iduser', 'id');
    }

    /**
     * Get all of the Articles for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'iduser', 'id');
    }

    public function carnet()
    {
        return $this->hasOne(CarnetDeBapteme::class, 'user_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function repertoires()
    {
        return $this->hasMany(Repertoire::class, 'iduser', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function autreDocuments()
    {
        return $this->hasMany(AutreDocument::class, 'userId', 'id');
    }
}

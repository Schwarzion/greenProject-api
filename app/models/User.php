<?php

namespace App\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'alias', 'level', 'address', 'city', 'postalCode', 'userStatus', 'sexe', 'phone', 'birthday', 'exp', 'temporaryPassword', 'temporaryPasswordValid',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'temporaryPassword',
    ];

    protected $table = 'user';

    public $timestamps = false; //not registering columns created_at + modified_at

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function quest()
    {
        return $this->belongsToMany('App\models\Quest', 'userQuest', 'userId', 'questId');
    }

    /**
     * @return BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('App\models\Role', 'roleUser', 'userId', 'roleId');
    }

    /**
     * @param $requestedRole
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function hasRole($requestedRole)
    {
        return $this->role()->find($requestedRole);
    }
}
<?php


namespace App\models;


use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Role extends Model
{
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $table = 'role';

    public $timestamps = false; //not registering columns created_at + modified_at



}
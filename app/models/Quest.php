<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Quest extends Model
{
    use Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'name', 'desc', 'expAmount', 'minLevel', 'timeForQuest', 'endDate', 'questStatus'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected $table = 'quest';

    public $timestamps = false; //not registering columns created_at + modified_at
}

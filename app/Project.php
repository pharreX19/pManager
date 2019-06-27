<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{

     protected $fillable = [
         'name',
         'description',
         'days',
         'hours',
         'company_id',
         'user_id'

     ];

    public function company(){
        return $this->belongsTo(Company::class);
    }


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function comments(){
        return $this->morphMany('App\Comment','commentable')->orderBy('id', 'desc');;
    }

}

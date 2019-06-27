<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Task extends Model
{
    protected $fillable = [
        'name',
        'duration',
        'project_id',
        'user_id',
        'company_id'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function project(){
        return $this->belongsTo(Task::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable')->orderBy('id', 'desc');;
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_assigned_id',
        'created_at',

    ];

    public function user(){

        return $this->belongsTo('App\Models\Project');
    }

    public function taks(){
        return $this->hasMany('App\Models\Task');
    }
}
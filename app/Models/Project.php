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

    public function scopeName($query, $name)
    {
        if($name)
        
         return $query->where('name','LIKE',"%$name%");
    }
    public function scopeDate($query, $date)
    {
        if($date)
        
         return $query->where('created_at','LIKE',"%$date%");
    }

    public function scopeStatus($query, $status)
    {
        if($status)
        
         return $query->where('status','LIKE',"%$status%");
    }
}
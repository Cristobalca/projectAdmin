<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\CAPermission\Traits\UserTrait;
use App\Models\Project;
use App\CAPermission\Models\Role;

class User extends Authenticatable
{
    use HasFactory, Notifiable , UserTrait;

    
    
    protected $fillable = [
        'name',
        'email',
        'password',
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
    // hashea los password no encriptar en los seeder 
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function roles()
    {

        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    // public function scopeName($query, $name)
    // {
    //     if($name)
        
    //      return $query->where('name','LIKE',"%$name%");
    // }
    // public function scopeRole($query, $role)
    // {
    //     if($role)
        
    //      return $query->where('name','LIKE',"%$role%");
    // }
    // public function scope($query, $name)
    // {
    //     if($name)
        
    //      return $query->where('name','LIKE',"%$name%");
    // }
}

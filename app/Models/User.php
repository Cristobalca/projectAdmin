<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\CAPermission\Traits\UserTrait;
use App\Models\Project;

class User extends Authenticatable
{
    use HasFactory, Notifiable , UserTrait;

    /**
     * Usertrait es una clase abastracta que ayuda a reutilizar el codigo 
     * y separar la funcionalidades del resto de clases 
     * con la ventaja de que solo se importa y tiene acceso a todas sus funciones
     */
    
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
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function projects(){
        return $this->hasMany(Project::class);
    }

    public function roles()
    {

        return $this->belongsToMany('App\CAPermission\Models\Role')->withTimestamps();
    }
}

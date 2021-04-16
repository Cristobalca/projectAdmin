<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    
    protected $fillable = [
        'name',
        'description',
        'project_id',
        'user_created_id',
        'user_assigned_id',
        'is_complete'

        
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}

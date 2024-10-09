<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'id',
        'project',
        'priority',
        'title',
        'description'
    ];
    protected $append = [
        'created',
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }

    public function getCreatedAttribute(){
        return $this->created_at->diffForHumans();
    }
}

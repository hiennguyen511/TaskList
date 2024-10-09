<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $table = 'projects';
    public $timestamps = false;
    protected $fillname = [
        'id',
        'name',
    ];
    public function tasks(){
        return $this->hasMany(Task::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'color',
        'user_id'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}

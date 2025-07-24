<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Category.php
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description'];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

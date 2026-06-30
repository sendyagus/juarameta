<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// app/Models/Category.php
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'description', 'type'];

    public function scopeLanding($query)
    {
        return $query->where('type', 'landing');
    }

    public function scopeProduct($query)
    {
        return $query->where('type', 'product');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}

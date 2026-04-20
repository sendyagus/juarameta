<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'author',
        'is_hot',
        'is_product',
        'image',
        'model_path',
        'spatial_link',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'content', 'category_id', 'user_id', 'slug', 'published_at', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    protected function getPublishedAtAttribute($value)
    {
        return date("Y/m/d", strtotime($value));
    }
}

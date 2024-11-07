<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory,Sluggable;
    protected $guarded = [];

    public function posts()
    {
     return $this->hasMany(Post::class , 'category_id');
    }
    public function limitedPosts()
    {
        return $this->hasMany(Post::class)->limit(4);
    }
    public function scopeActive($query)
    {
        return $query->whereStatus(1);
    }
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' =>'name',
            ]
        ];
    }

    public function status()
    {
        return $this->status == 1 ?'Active':'Not Active';
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $guarded = [];

    public function path()
    {
        return "/posts/{$this->id}";
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeDescending($query)
    {
        return $query->orderBy('sort_order', 'desc');
    }

    public function storagePath()
    {
        return "storage/{$this->image_path}";
    }

    public function deleteImage()
    {
        if(is_file($this->storagePath())) unlink($this->storagePath());
    }
}

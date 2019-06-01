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

    public function storagePath()
    {
        return "storage/{$this->image_path}";
    }

    public function deleteImage()
    {
        if(is_file($this->storagePath())) unlink($this->storagePath());
    }
}

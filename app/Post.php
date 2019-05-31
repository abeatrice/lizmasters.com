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
}

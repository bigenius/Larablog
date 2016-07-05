<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $hidden = ['id','author_email','post_id','approved'];

    public $hash;
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function hash()
    {
        $this->hash = md5($this->author_email);
    }

}

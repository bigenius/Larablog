<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Post extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::updating(function(Post $post) {
            $post->body = clean($post->body);
        });
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
}

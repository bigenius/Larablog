<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;

class Post extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'method' => function ($string, $separator) {
                    logger($string);
                    $a = strtolower(preg_replace('/[^a-z]+/i', $separator, $string));
                    logger($a);
                    return Carbon::now()->year. '/' . Carbon::now()->month . '/'. $a;
                },
            ]
        ];
    }

    
    protected $guarded = [];

    protected static function boot()
    {

        parent::boot();

        // Clean the article body from any nasty html tags
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

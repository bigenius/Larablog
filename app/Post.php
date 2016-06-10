<?php

namespace App;

use GuzzleHttp\Tests\Psr7\Str;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;


class Post extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'unique' => true,
                'method' => function ($string, $separator) {

                    //$a = strtolower(preg_replace('/[^a-z]+/i', $separator, $string));
                    $a = \Illuminate\Support\Str::slug($string, $separator);
                    return Carbon::now()->year. '/' . Carbon::now()->month . '/'. $a;
                },
            ]
        ];
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        return $query->where('slug', $slug);
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

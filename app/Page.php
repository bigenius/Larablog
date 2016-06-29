<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use Sluggable;
    use SoftDeletes;

    protected $guarded = [];

    protected static function boot()
    {

        parent::boot();

        // Clean the article body from any nasty html tags
        static::updating(function(Page $page) {
            $page->body = clean($page->body);
        });

    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }
}

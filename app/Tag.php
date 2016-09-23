<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use Sluggable;

    public function posts() {
        return $this->belongsToMany('App\Post');
    }

    /**
     * Returns ar array with the id's for the tags specified in the input array
     * If the tag doesn't exist, it will be created.
     *
     * @param array $tagnames
     * @return mixed
     */
    static function getTagId($tagnames)
    {
        $returnarray = array();
        foreach( $tagnames as $tag) {

            $tag = trim($tag);
            if($tag) {
                $t = false;
                $thetag = Tag::where('title', $tag);
                $num = $thetag->count();
                if ($num < 1) {
                    $t = new Tag;
                    $t->title = $tag;
                    if (!Tag::validate($t->toArray())) {
                        return $t->title;
                    }
                    $t->save();
                    $returnarray[] = $t->id;
                } else {
                    $returnarray[] = $thetag->first()->id;
                }
            }
        }
        return $returnarray;
    }

    public static $rules = array(
        'title'=>'required|unique:tags|min:2'
    );

    static function validate($tag)
    {
        $validator = Validator::make($tag, Tag::$rules);
        if( $validator->passes() ){
            return true;
        }
        return false;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}

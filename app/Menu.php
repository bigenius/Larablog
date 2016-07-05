<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Menu extends Model
{
    public function pages() {
        return $this->belongsToMany('App\Page');
    }

    public function weightedPages() {
        return $this->belongsToMany('App\Page')->withPivot('weight')->orderBy('pivot_weight');
    }
}

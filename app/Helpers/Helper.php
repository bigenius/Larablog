<?php
/**
 * Created by PhpStorm.
 * User: Daniel Bigenius
 * Date: 2016-05-27
 * Time: 11:18
 */

namespace App\Helpers;

use App\Menu;

class Helper
{

    public static function appendComma($ar,$item) {
        return  ($item != $ar->last() ? ',':'');
    }

    public static function getMenu($name) {
        return Menu::where('title',$name)->first()->pages;
    }
}
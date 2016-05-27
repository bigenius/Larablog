<?php
/**
 * Created by PhpStorm.
 * User: Daniel Bigenius
 * Date: 2016-05-27
 * Time: 11:18
 */

namespace App\Helpers;


class Helper
{

    public static function appendComma($ar,$item) {
        return  ($item != $ar->last() ? ',':'');
    }
}
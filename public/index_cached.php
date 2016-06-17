<?php
/**
 * Created by PhpStorm.
 * User: tempdabig
 * Date: 17/06/16
 * Time: 12:17
 */

$debug = 1;			// set to 1 if you wish to see execution time and cache actions
$display_powered_by_redis = 0;  // set to 1 if you want to display a powered by redis message with execution time, see below

$start = microtime();   // start timing page exec


// init predis
$single_server = array(
    'host'     => '127.0.0.1',
    'port'     => 6379,
);

include("predis.php");
$redis = new Predis\Client($single_server);

// init vars
$domain = $_SERVER['HTTP_HOST'];
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$url = str_replace('?r=y', '', $url);
$url = str_replace('?c=y', '', $url);
$dkey = md5($domain);
$ukey = md5($url);

if (substr($_SERVER['REQUEST_URI'], -4) == '?n=y') {
    $html = file_get_contents('http://dnu.local');
    $msg = 'no cache used';
}
else if ($redis->hexists($dkey, $ukey) ) {

    $html = $redis->hget($dkey, $ukey);
    $cached = 1;
    $msg = 'this is a cache hit';

} else {

    $html = file_get_contents('http://dnu.local');
    $redis->hset($dkey, $ukey, $html);
    $msg = 'cache is set';
}


if (substr($_SERVER['REQUEST_URI'], -4) == '?r=y') {
    $html = file_get_contents('http://dnu.local');
    $redis->hdel($dkey, $ukey);
    $msg = 'cache of page deleted';

// delete entire cache, works only if logged in
} else if (substr($_SERVER['REQUEST_URI'], -4) == '?c=y') {
    $html = file_get_contents('http://dnu.local');
    if ($redis->exists($dkey)) {
        $redis->del($dkey);
        $msg = 'domain cache flushed';
    } else {
        $msg = 'no cache to flush';
    }

} else if (substr($_SERVER['REQUEST_URI'], -4) == '?r=y') {
    $html = file_get_contents('http://dnu.local');
    $redis->hdel($dkey, $ukey);
    $msg = 'cache of page deleted';

// delete entire cache, works only if logged in
} /*else if (substr($_SERVER['REQUEST_URI'], -4) == '?n=y') {
    $html = file_get_contents('http://dnu.local');
        $msg = 'no cache used';
}
*/
echo $html;

$end = microtime(); // get end execution time

// show messages if debug is enabled
if ($debug) {
    echo $msg.': ';
    echo t_exec($start, $end);
}


// time diff
function t_exec($start, $end) {
    $t = (getmicrotime($end) - getmicrotime($start));
    return round($t,5);
}

// get time
function getmicrotime($t) {
    list($usec, $sec) = explode(" ",$t);
    return ((float)$usec + (float)$sec);
}

<?php
/**
 * Created by PhpStorm.
 * User: baldonharris
 * Date: 08/10/2017
 * Time: 3:36 PM
 */

if (!function_exists('dd')) {
    function dd($arr, $die = true) {
        echo '<pre>';
        print_r($arr);
        echo '<pre>'; if ($die) { die(); }
    }
}
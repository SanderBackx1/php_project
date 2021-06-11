<?php
/**
 * Created by PhpStorm.
 * User: Sander
 * Date: 13/02/2020
 * Time: 15:07
 */

namespace App\Helpers;



class Json
{
    /**
     * Dump data as json (add ?json to URL)
     *
     * @param mixed $data string, array, associative array object
     * @param bool $onlyInDebugMode runs only in debug mode: default = true
     * @version 1.0
     */
    public function dump($data = null, $onlyInDebugMode = true)
    {
        $show = ($onlyInDebugMode === true && env('APP_DEBUG') === false) ? false : true;
        if (array_key_exists('json', app('request')->query()) && $show) {
            header('Content-Type: application/json');
            die(json_encode($data));
        }
    }
}

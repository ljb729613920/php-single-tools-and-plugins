<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 27/03/17
 * Time: 14:29
 */

namespace JFernando\PHPValidate\Utils;


class Messages
{

    protected $messages = [];

    public function __construct($path) {
        if(is_array($path)){
            $this->messages = $path;
        } else {
            $this->messages = include $path;
        }
    }

    public function get($key, $message = '')
    {
        return $this->messages[$key] ?? $message;
    }

}
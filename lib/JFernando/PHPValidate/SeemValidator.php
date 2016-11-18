<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:42
 */

namespace JFernando\PHPValidate;


use JFernando\PHPValidate\Validator;

class SeemValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return $content == $param;
    }
}
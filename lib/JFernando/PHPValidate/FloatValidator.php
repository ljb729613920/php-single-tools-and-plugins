<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:39
 */

namespace JFernando\PHPValidate;


class FloatValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return is_float($content);
    }
}
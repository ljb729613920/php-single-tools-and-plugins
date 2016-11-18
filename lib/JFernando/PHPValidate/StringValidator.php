<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:37
 */

namespace JFernando\PHPValidate;


class StringValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return is_string($content);
    }
}
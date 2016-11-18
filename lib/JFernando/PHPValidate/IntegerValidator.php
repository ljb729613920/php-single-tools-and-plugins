<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:36
 */

namespace JFernando\PHPValidate;


class IntegerValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return is_int($content);
    }
}
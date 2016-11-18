<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:41
 */

namespace JFernando\PHPValidate;


class EqualsValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return $content === $param;
    }
}
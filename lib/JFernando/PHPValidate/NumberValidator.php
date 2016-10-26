<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 12/10/16
 * Time: 13:27
 */

namespace JFernando\PHPValidate;

class NumberValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return !preg_match("/[^0-9]/", $content);
    }
}

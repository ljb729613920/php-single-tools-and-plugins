<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 20:59
 */

namespace JFernando\PHPValidate;

class MinValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        if (is_string($content)) {
            return strlen($content) >= (int) $param;
        }

        if (is_array($content)) {
            return count($content) >= (int) $param;
        }

        return $content >= $param;
    }
}

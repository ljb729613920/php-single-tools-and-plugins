<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:42
 */

namespace JFernando\PHPValidate;


class SizeValidator implements Validator
{

    public function isValid($content, $param = null) : bool
    {
        if($param === null){
            return true;
        }

        if (is_string($content)){
            return mb_strlen($content) === $param;
        }

        if (is_array($content)){
            return count($content) === $param;
        }

        return $content === $param;
    }
}
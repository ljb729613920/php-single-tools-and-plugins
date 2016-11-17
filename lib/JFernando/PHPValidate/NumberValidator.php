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

    public function isValid($content, $param = '') : bool
    {
        if($content === true || $content === false){
            return false;
        }

        if(is_int($content)){
            return true;
        }

        return preg_match("/\A\d+\z/", $content);
    }
}

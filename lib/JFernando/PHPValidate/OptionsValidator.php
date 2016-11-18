<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:18
 */

namespace JFernando\PHPValidate;


class OptionsValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        if(is_array($param)){
            if(in_array($content, $param)){
                return true;
            }
        }

        return false;
    }
}
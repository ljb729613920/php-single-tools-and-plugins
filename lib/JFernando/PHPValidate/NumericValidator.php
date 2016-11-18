<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:38
 */

namespace JFernando\PHPValidate;


class NumericValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        return is_numeric($content);
    }
}
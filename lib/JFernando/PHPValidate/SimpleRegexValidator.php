<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:28
 */

namespace JFernando\PHPValidate;


class SimpleRegexValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        $param = "/\A{$param}\z/";
        return (new RegexValidator())->isValid($content, $param);
    }
}
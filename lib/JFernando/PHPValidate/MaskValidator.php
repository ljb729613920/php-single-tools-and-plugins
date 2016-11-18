<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:44
 */

namespace JFernando\PHPValidate;


class MaskValidator implements Validator
{

    public function isValid($content, $param) : bool
    {
        $regex = $param;
        $regex = preg_replace("/a/", '[a-zA-z]', $regex);
        $regex = preg_replace("/9/", '\d', $regex);

        return (new SimpleRegexValidator())->isValid($content, $regex);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: JFernando
 * Date: 19/09/2016
 * Time: 23:35
 */

namespace JFernando\PHPValidate;

class DefaultValidator implements Validator
{
    public function isValid($content, $value = '') : bool
    {
        return !is_null($content);
    }
}

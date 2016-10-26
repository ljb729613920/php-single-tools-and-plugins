<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:18
 */

namespace JFernando\PHPValidate;

class NotNullValidator implements Validator
{

    public function isValid($content, $param = '') : bool
    {
        return $content !== null;
    }
}

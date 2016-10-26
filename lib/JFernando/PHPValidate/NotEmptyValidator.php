<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:20
 */

namespace JFernando\PHPValidate;

class NotEmptyValidator implements Validator
{

    public function isValid($content, $param = '') : bool
    {
        if ($content === null) {
            return false;
        }

        if (is_string($content)) {
            return $content !== '';
        }

        if (is_array($content)) {
            return count($content) > 0;
        }

        return $content > 0;
    }
}

<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 24/04/18
 * Time: 12:17
 */

namespace JFernando\PHPValidate;


class BooleanValidator implements Validator
{

    public function isValid( $content, $param ): bool
    {
        return is_bool($content);
    }
}
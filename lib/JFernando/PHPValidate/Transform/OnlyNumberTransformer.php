<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:49
 */

namespace JFernando\PHPValidate\Transform;


class OnlyNumberTransformer implements Transformer
{

    public function transform($value)
    {
        return preg_replace('/\D/', '', $value);
    }
}
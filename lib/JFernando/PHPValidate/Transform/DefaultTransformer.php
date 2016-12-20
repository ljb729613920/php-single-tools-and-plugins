<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:42
 */

namespace JFernando\PHPValidate\Transform;


class DefaultTransformer implements Transformer
{

    public function transform($value)
    {
        return $value;
    }
}
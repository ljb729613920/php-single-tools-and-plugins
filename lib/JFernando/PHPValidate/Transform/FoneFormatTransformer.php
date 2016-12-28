<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 28/12/16
 * Time: 15:14
 */

namespace JFernando\PHPValidate\Transform;


class FoneFormatTransformer implements Transformer
{

    public function transform( $value )
    {
        $value = preg_replace('/\D/', '', $value);
        return '(' . substr($value, 0, 2) . ') ' . substr($value, 2, strlen($value) - 6) . '-' . substr($value, strlen($value) - 4, 4);
    }
}
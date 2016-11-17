<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:36
 */

namespace JFernando\PHPValidate;


class CpfCnpjValidator implements Validator
{

    public function isValid($content, $param = '') : bool
    {
        return (new CpfValidator())->isValid($content, $param) || (new CnpjValidator())->isValid($content, $param);
    }
}
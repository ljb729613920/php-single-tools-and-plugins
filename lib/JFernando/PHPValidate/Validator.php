<?php
/**
 * Created by PhpStorm.
 * User: JFernando
 * Date: 19/09/2016
 * Time: 23:34
 */

namespace JFernando\PHPValidate;

interface Validator
{
    public function isValid($content, $param) : bool;
}

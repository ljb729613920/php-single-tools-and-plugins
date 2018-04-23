<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:51 PM
 */

namespace JFernando\PHPValidate\Schema;


class Schema extends PipeValidation
{

    public function __construct(array $validations)
    {
        parent::__construct($validations);
    }

    public static function params(array $data) {
        return new Params($data);
    }

}
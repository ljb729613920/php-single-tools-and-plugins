<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 2:22 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Validator;

abstract class Validation implements Validator
{

    protected $params;
    protected $required;
    protected $name = null;

    public function __construct(array $params)
    {
        $name = $params['name'] ?? null;

        if($name) {
            $this->name = $name;
        }

        $this->params = $params;
        $this->required = true;
    }

    public function required($required = true)
    {
        $this->required = $required;

        return $this;
    }

    public function validate($field, $value)
    {
        $params = $this->params;
        $code = $params['code'] ?? "field_${field}_invalid";
        $message = $params['message'] ?? "Field '${field}' invalid";
        $required = $params['required'] ?? $this->required;
        $param = $params['param'] ?? [];
        $others = $params;

        if(!$required && $value === null) {
            return false;
        }

        if ($this->isValid($value, $param)) {
            return false;
        }

        $errorArray = [
            'valid' => false,
            'field' => $field,
            'code' => $code,
            'message' => $message,
            'required' => $required,
            'param' => $param,
            'params' => $others,
            'value' => $value,
            'name' => $this->name
        ];

        return new Error($errorArray);
    }
}
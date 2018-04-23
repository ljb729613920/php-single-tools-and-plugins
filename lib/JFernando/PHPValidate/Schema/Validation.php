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

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function validate($field, $value)
    {
        $params = $this->params;
        $code = $params['code'] ?? "field_'${field}'_invalid";
        $message = $params['message'] ?? "Field '${field}' invalid";
        $required = $params['required'] ?? true;
        $param = $params['param'] ?? [];
        $others = $params['params'] ?? [];

        if ($this->isValid($value, $param)) {
            return false;
        }

        return [
            'valid' => false,
            'field' => $field,
            'code' => $code,
            'message' => $message,
            'required' => $required,
            'param' => $param,
            'params' => $others,
            'value' => $value
        ];
    }
}
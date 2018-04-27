<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 2:51 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Utils\Reflection;
use JFernando\PHPValidate\Validator;

class ValidationAdapter extends Validation
{

    protected $validator;

    public function __construct(array $params, Validator $validator)
    {
        $params['name'] = $params['name'] ?? (new Reflection($validator))->getShortName();
        parent::__construct($params);
        $this->validator = $validator;
    }

    public function isValid($content, $param): bool
    {
        return $this->validator->isValid($content, $param);
    }
}
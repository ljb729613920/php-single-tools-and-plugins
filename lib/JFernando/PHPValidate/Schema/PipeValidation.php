<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:51 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\NotNullValidator;
use JFernando\PHPValidate\Utils\ArrayUtil;
use JFernando\PHPValidate\Validator;

class PipeValidation extends Validation
{

    protected $validations;

    public function __construct(array $validations)
    {
        parent::__construct([]);
        $this->validations = $validations;
    }

    public function pipe($validation, $params = []) {
        if ($validation instanceof Validation) {
            $this->validations[] = $validation;
            return $this;
        }

        if($validation instanceof Validator) {
            $this->pipe(new ValidationAdapter($params, $validation));
            return $this;
        }

        if(is_callable($validation)) {
            $this->pipe(new FunctionValidation($validation, $params));
            return $this;
        }

        throw new \InvalidArgumentException('Invalid validation');
    }

    public function validate($field, $value)
    {
        $util = new ArrayUtil($this->validations);

        if($value === null && !$this->required) {
            return [];
        }

        return $util
            ->map(function($validator) use ($field, $value) {
                if ($validator instanceof Validation) {
                   return $validator->validate($field, $value );
                }

                throw new \InvalidArgumentException("Invalid validation for field ${field}");
            })
            ->filter(function($arr) {
                if(is_array($arr) && count($arr) > 0) {
                    return true;
                };

                return false;
            })
            ->toVector();
    }


    public function isValid($content, $param): bool
    {
        throw new \BadMethodCallException('not implemented');
    }
}
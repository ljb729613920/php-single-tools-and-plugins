<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:51 PM
 */

namespace JFernando\PHPValidate\Schema;


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
        if ($validation instanceof Validation || is_callable($validation)) {
            $this->validations[] = $validation;
            return;
        }

        if($validation instanceof Validator) {
            $this->pipe(new ValidationAdapter($params, $validation));
            return;
        }

        throw new \InvalidArgumentException('Invalid validation');
    }

    public function validate($field, $value)
    {
        $util = new ArrayUtil($this->validations);

        return $util
            ->map(function($validator) use ($field, $value) {
                if ($validator instanceof Validation) {
                   return $validator->validate($field, $value );
                } else if (is_callable($validator)) {
                    return $validator($field, $value);
                } else {
                    throw new \InvalidArgumentException("Invalid validation for field ${field}");
                }
            })
            ->filter(function($arr) {
                if(is_array($arr) && count($arr) > 0) {
                    return true;
                };

                return false;
            })
            ->toArray();
    }


    public function isValid($content, $param): bool
    {
        throw new \BadMethodCallException('not implemented');
    }
}
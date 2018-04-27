<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:54 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\MaxValidator;
use JFernando\PHPValidate\MinValidator;
use JFernando\PHPValidate\StringValidator;

class StringPipeValidator extends PipeValidation
{
    public function __construct( array $params )
    {
        $stringValidator = new ValidationAdapter($params, new StringValidator());
        parent::__construct( [$stringValidator]);
    }

    public function min(int $min, $params = [])
    {
        $params['name'] = $params['name'] ?? 'min';
        $params['param'] = $min;
        $minValidation = new MinValidator();
        return $this->pipe($minValidation, $params);
    }

    public function max(int $max, $params = [])
    {
        $params['name'] = $params['name'] ?? 'max';
        $params['param'] = $max;
        $minValidation = new MaxValidator();
        return $this->pipe($minValidation, $params);
    }
}
<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 23/04/18
 * Time: 16:51
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\IntegerValidator;
use JFernando\PHPValidate\MaxValidator;
use JFernando\PHPValidate\MinValidator;

class IntegerPipeValidation extends PipeValidation
{

    public function __construct( array $params )
    {
        $stringValidator = new ValidationAdapter($params, new IntegerValidator());
        parent::__construct( [$stringValidator]);
    }

    public function min(int $min, $params = [])
    {
        $params['param'] = $min;
        $minValidation = new MinValidator();
        return $this->pipe($minValidation, $params);
    }

    public function max(int $max, $params = [])
    {
        $params['param'] = $max;
        $minValidation = new MaxValidator();
        return $this->pipe($minValidation, $params);
    }

    public function isValid( $content, $param ): bool
    {
        throw new \BadMethodCallException('not implemented');
    }
}
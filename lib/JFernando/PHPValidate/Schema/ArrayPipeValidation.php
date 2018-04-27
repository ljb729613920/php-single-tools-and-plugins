<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 23/04/18
 * Time: 16:53
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\ArrayValidator;
use JFernando\PHPValidate\MaxValidator;
use JFernando\PHPValidate\MinValidator;

class ArrayPipeValidation extends PipeValidation
{

    public function __construct( array $params )
    {
        $validator = new ValidationAdapter($params, new ArrayValidator());
        parent::__construct( [$validator] );
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
        $maxValidation = new MaxValidator();
        return $this->pipe($maxValidation, $params);
    }

    public function schema(array $schema, $params = [] )
    {
        return $this->pipe(new ArraySchemaValidation($schema), $params);
    }

}
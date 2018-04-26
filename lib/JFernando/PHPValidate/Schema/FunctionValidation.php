<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 26/04/18
 * Time: 16:43
 */

namespace JFernando\PHPValidate\Schema;


class FunctionValidation extends Validation
{

    protected $function;

    public function __construct( \Closure $closure, array $params )
    {
        $this->function = $closure;
        parent::__construct( $params );
    }

    public function isValid( $content, $param ): bool
    {
        $function = $this->function;
        return $function($content, $param);
    }
}
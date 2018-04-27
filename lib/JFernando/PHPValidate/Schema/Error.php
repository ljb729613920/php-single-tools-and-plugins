<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 27/04/18
 * Time: 09:38
 */

namespace JFernando\PHPValidate\Schema;


class Error
{
    /** @var bool */
    protected $valid;
    /** @var string */
    protected $field;
    /** @var string */
    protected $code;
    /** @var string */
    protected $message;
    /** @var bool */
    protected $required;
    /** @var mixed */
    protected $param;
    /** @var array */
    protected $params;
    /** @var mixed */
    protected $value;
    /** @var string */
    protected $name;

    public function __construct( array $params )
    {
        $this->valid    = $params[ 'valid' ] ?? false;
        $this->field    = $params[ 'field' ] ?? null;
        $this->code     = $params[ 'code' ] ?? null;
        $this->message  = $params[ 'message' ] ?? null;
        $this->required = $params[ 'required' ] ?? false;
        $this->param    = $params[ 'param' ] ?? null;
        $this->params   = $params[ 'params' ] ?? [];
        $this->value    = $params[ 'value' ] ?? null;
        $this->name     = $params[ 'name' ] ?? null;
    }

    public function isValid()
    {
        return $this->valid;
    }

    public function getField()
    {
        return $this->field;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function isRequired()
    {
        return $this->required;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getName()
    {
        return $this->name;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: JFernando
 * Date: 27/09/2016
 * Time: 16:27
 */

namespace JFernando\PHPValidate\Exception;

class ValidatorError
{

    protected $code;
    protected $message;

    public function __construct($code, $message)
    {
        $this->code = $code;
        $this->message = $message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function __toString()
    {
        return '{"code" : "' . $this->getCode()  . '", "message" : "' . $this->getMessage() .'"}';
    }
}

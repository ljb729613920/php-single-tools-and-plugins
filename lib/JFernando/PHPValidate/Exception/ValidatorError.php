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
    protected $params;

    public function __construct($code, $message, $params = [])
    {
        $this->params = $params;
        $this->code = $code;

        if(count($params) > 0){
            foreach($params as $key => $val){
                $message = preg_replace("/#{" . $key ."}/", $key, $message);
            }
        }

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

    public function setParams($params){
        $this->params = $params;
        return $this;
    }

    public function getParams(){
        return $this->params;
    }

    public function addParam(array $param){
        $this->params[] = $param;
    }

    public function getParam(string $key, $default = null){
        return $this->params[$key] ?? $default;
    }

    public function __toString()
    {
        return '{"code" : "' . $this->getCode()  . '", "message" : "' . $this->getMessage() .'"}';
    }
}

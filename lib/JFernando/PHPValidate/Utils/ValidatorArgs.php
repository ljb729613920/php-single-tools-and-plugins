<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 03/04/17
 * Time: 09:30
 */

namespace JFernando\PHPValidate\Utils;


class ValidatorArgs
{

    private $args = [];

    public function getArgs(){
        return $this->args;
    }

    public function add($key, $val){
        $this->args[$key] = $val;
    }

    public function addAll(array $args){
        $this->args = array_merge($this->args, $args);
    }

    public function get($key){
        return $this->args[$key] ?? null;
    }

}
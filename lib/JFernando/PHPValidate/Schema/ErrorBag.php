<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 24/04/18
 * Time: 08:52
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Utils\ArrayUtil;

class ErrorBag
{

    protected $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function getErrorsOfField($field)
    {
        if (!$this->isValid()) {
            return $this->errors[$field] ?? [];
        }

        return [];
    }

    public function toArray() {
        return $this->errors;
    }

    public function flatten()
    {
        return $this->_flatten($this->errors, []);
    }

    private function _flatten($errors, array $result, $parentKey = null) {
        if($errors instanceof Error) {
            $name = $errors->getName();

            if($parentKey) {
                $name = "${parentKey}.${name}";
            }

            $result[$name] = $errors;

            return $result;
        }

        if(ArrayUtil::isAssociativeArray($errors)) {
            foreach ( $errors as $key => $error ) {
                $name = $key;

                if($parentKey) {
                    $name = "${parentKey}.${key}";
                }

                $result = $this->_flatten($error, $result, $name);
            }

            return $result;
        }

        foreach ( $errors as $error ) {
            $result = $this->_flatten($error, $result, $parentKey);
        }

        return $result;
    }

    public function isValid()
    {
        return count($this->errors) < 1;
    }

}
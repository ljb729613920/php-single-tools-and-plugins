<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 24/04/18
 * Time: 08:52
 */

namespace JFernando\PHPValidate\Schema;


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

    public function isValid()
    {
        return count($this->errors) < 1;
    }

}
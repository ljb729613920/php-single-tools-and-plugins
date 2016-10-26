<?php
/**
 * Created by PhpStorm.
 * User: JFernando
 * Date: 27/09/2016
 * Time: 17:53
 */

namespace JFernando\PHPValidate\Exception;

class ValidatorException extends \Exception
{
    protected $errors;

    public function __construct($errors)
    {
        parent::__construct($this->getErrorString($errors), 0);
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getErrorString($errors)
    {
        $str = '{"errors" : [';

        for ($i = 0; $i < sizeof($errors); $i++) {
            $str .= $errors[$i]->__toString();

            if ($i < (sizeof($errors) - 1)) {
                $str .= ", ";
            }
        }

        $str .= ']}';

        return $str;
    }
}

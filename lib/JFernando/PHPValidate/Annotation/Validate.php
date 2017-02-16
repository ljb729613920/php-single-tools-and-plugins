<?php

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\DefaultValidator;
use JFernando\PHPValidate\Exception\ValidatorError;

/**
 * @Annotation
 * @Target("PROPERTY")
 */
class Validate extends Annotation
{
    public $errors = ValidatorError::class;
    public $validator = DefaultValidator::class;
    public $message = 'Field #{field} of #{class} is not valid!';
    public $code = 'field_#{field}_of_#{class}_invalid';

    public $isClass = false;
    public $skipBlank = false;
    public $skipNull = false;
    public $skipEmpty = false;
    public $skipIf = false;
}

<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:24
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\IntegerValidator;

/**
 * Class Integer
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Integer extends Validate
{
    public $validator = IntegerValidator::class;
}
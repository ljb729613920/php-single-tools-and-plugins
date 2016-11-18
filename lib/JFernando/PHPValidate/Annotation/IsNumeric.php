<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:32
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\NumericValidator;

/**
 * Class IsNumeric
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class IsNumeric extends Validate
{
    public $validator = NumericValidator::class;
}
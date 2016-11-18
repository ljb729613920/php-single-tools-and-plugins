<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:30
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\FloatValidator;

/**
 * Class Float
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class IsFloat extends Validate
{
    public $validator = FloatValidator::class;
}
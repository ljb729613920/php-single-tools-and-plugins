<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:23
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\ArrayValidator;

/**
 * Class IsArray
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class IsArray extends Validate
{
    public $validator = ArrayValidator::class;
}
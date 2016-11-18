<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:35
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\SimpleRegexValidator;

/**
 * Class SimpleRegex
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class SimpleRegex extends Regex
{

    public $validator = SimpleRegexValidator::class;

}
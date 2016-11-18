<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:42
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\SizeValidator;

/**
 * Class Size
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Size extends Validate
{
    public $validator = SizeValidator::class;

    /**
     * @var int
     * @Required()
     */
    public $value;
}
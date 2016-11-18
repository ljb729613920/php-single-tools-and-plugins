<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:26
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\EqualsValidator;

/**
 * Class Equals
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Equals extends Validate
{

    public $validator = EqualsValidator::class;

    /**
     * @var string
     * @Required()
     */
    public $value;

}
<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:35
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\SeemValidator;

/**
 * Class Seem
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Seem extends Validate
{

    public $validator = SeemValidator::class;

    /**
     * @Required()
     */
    public $value;

}
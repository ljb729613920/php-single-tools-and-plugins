<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 13:33
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\MaskValidator;

/**
 * Class Mask
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Mask extends Validate
{
    public $validator = MaskValidator::class;

    /**
     * @var string
     * @Required()
     */
    public $value;
}
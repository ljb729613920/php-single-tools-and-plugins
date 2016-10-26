<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 12/10/16
 * Time: 13:42
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\NumberValidator;

/**
 * Class Number
 * @package ErpKernel\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Number extends Validate
{
    public $validator = NumberValidator::class;
}

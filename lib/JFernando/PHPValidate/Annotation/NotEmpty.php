<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:15
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\NotEmptyValidator;

/**
 * Class NotEmpty
 * @package ErpKernel\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class NotEmpty extends Validate
{
    public $validator = NotEmptyValidator::class;
}

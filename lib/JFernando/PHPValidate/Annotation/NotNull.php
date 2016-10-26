<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:16
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\NotNullValidator;

/**
 * Class NotNull
 * @package ErpKernel\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class NotNull extends Validate
{

    public $validator = NotNullValidator::class;
}

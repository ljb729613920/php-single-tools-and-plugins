<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:04
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\MaxValidator;

/**
 * Class Max
 * @package ErpKernel\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Max extends Validate
{
    public $validator = MaxValidator::class;
    public $param = INF;
}

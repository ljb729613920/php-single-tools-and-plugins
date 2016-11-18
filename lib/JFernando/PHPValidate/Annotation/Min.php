<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 20:57
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use JFernando\PHPValidate\MinValidator;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * Class Min
 * @package ErpKernel\Annotation
 *
 * @Annotation
 * @Target("PROPERTY")
 */
class Min extends Validate
{
    public $validator = MinValidator::class;

    /**
     * @var int
     * @Required()
     */
    public $value;
}

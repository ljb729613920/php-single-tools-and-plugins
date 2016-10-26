<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:25
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\CpfValidator;

/**
 * Class CPF
 * @package ErpApp\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class CPF extends Validate
{
    public $validator = CpfValidator::class;
}

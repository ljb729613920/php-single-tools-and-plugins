<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 17/11/16
 * Time: 16:38
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\CpfCnpjValidator;

/**
 * Class CPForCNPJ
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class CPForCNPJ extends Validate
{
    public $validator = CpfCnpjValidator::class;
}
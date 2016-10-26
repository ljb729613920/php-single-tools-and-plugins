<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 21:27
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\CnpjValidator;

/**
 * Class CNPJ
 * @package ErpApp\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class CNPJ extends Validate
{
    public $validator = CnpjValidator::class;
}

<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 11/10/16
 * Time: 20:50
 */

namespace JFernando\PHPValidate\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use JFernando\PHPValidate\Exception\ValidatorError;
use JFernando\PHPValidate\RegexValidator;

/**
 * Class Regex
 * @package ErpKernel\Annotation
 *
 * @Annotation
 * @Target("PROPERTY")
 */
class Regex extends Validate
{

    public $errors = ValidatorError::class;
    public $validator = RegexValidator::class;

    /**
     * @var string
     * @Required()
     */
    public $value;
}

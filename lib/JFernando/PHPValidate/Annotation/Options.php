<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 18/11/16
 * Time: 09:33
 */

namespace JFernando\PHPValidate\Annotation;


use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\OptionsValidator;

/**
 * Class Options
 * @package JFernando\PHPValidate\Annotation
 *
 * @Annotation()
 * @Target("PROPERTY")
 */
class Options extends Validate
{

    public $validator = OptionsValidator::class;

    /**
     * @var array
     * @Required()
     */
    public $value;

}
<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:39
 */

namespace JFernando\PHPValidate\Transform\Annotation;


use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\Transform\DefaultTransformer;

/**
 * Class Transform
 * @package JFernando\PHPValidate\Transform\Annotation
 *
 * @Target("PROPERTY")
 * @Annotation()
 */
class Transform extends Annotation
{

    public $transformer = DefaultTransformer::class;
    public $isClass = false;

}
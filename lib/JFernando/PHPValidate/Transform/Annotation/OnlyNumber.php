<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:48
 */

namespace JFernando\PHPValidate\Transform\Annotation;

use Doctrine\Common\Annotations\Annotation\Target;
use JFernando\PHPValidate\Transform\OnlyNumberTransformer;

/**
 * Class OnlyNumber
 * @package JFernando\PHPValidate\Transform\Annotation
 *
 * @Target("PROPERTY")
 * @Annotation()
 */
class OnlyNumber extends Transform
{
    public $transformer = OnlyNumberTransformer::class;
}
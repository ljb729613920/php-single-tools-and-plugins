<?php
/**
 * Created by CredisisTEAM.
 * User: jfernando
 * Date: 16/12/16
 * Time: 08:35
 */

namespace JFernando\PHPValidate\Annotation;
use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Annotations\Annotation\Target;


/**
 * Class Params
 *
 * @package JFernando\PHPValidate\Annotation
 *
 * @Target("PROPERTY")
 * @Annotation()
 */
class Params extends Annotation
{
    public $value = false;
}
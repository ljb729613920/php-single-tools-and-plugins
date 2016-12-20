<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 21/10/16
 * Time: 09:51
 */

namespace JFernando\PHPValidate\Utils;

use Doctrine\Common\Annotations\AnnotationReader;
use JFernando\PHPValidate\Transform\Annotation\Transform;

class Property extends \ReflectionProperty
{

    private $reader;

    public function __construct($class, $name)
    {
        parent::__construct($class, $name);
        $this->reader = new AnnotationReader();
    }

    public function getAnnotation($nome)
    {
        return $this->reader->getPropertyAnnotation($this, $nome);
    }

    public function getAnnotations()
    {
        return $this->reader->getPropertyAnnotations($this);
    }

    public function getAnnotationsChilds($superAnnotation){
        $returns = [];
        foreach ($this->getAnnotations() as $annotation){
            if($this->isValidAnnotation($annotation)){
                $returns[] = $annotation;
            }
        }

        return $returns;
    }

    private function isValidAnnotation($annotation)
    {
        $annotationClass = new Reflection($annotation);

        return ($annotationClass->getName() == Transform::class) || ($annotationClass->isSubclassOf(Transform::class));
    }

    public function getValue($object = null)
    {
        return (new Reflection($this->getDeclaringClass()))->getPropertyValue($object, $this);
    }

    public function setValue($object, $value = null)
    {
        (new Reflection($this->getDeclaringClass()))->setPropertyValue($object, $this, $value);
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 21/10/16
 * Time: 08:28
 */

namespace JFernando\PHPValidate\Utils;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Inflector\Inflector;

class Reflection extends \ReflectionClass
{
    private $byGet;
    private $reader;

    public function __construct($argument, $byGet = true)
    {
        parent::__construct($argument);
        $this->byGet = $byGet;
        $this->reader = new AnnotationReader();
    }

    public function setPropertyValue($entity, \ReflectionProperty $field, $value)
    {
        if ($this->byGet) {
            $methodName = 'set' . Inflector::classify($field->getName());
            $class = new \ReflectionClass($entity);

            /** @var \ReflectionMethod $method */
            $method = $class->getMethod($methodName);
            $method->invoke($entity, $value);

            return;
        }

        $field->setAccessible(true);
        $field->setValue($entity, $value);
    }

    public function getPropertyValue($entity, \ReflectionProperty $field)
    {
        if ($this->byGet) {
            $methodName = 'get' . Inflector::classify($field->getName());
            $class = new \ReflectionClass($entity);

            /** @var \ReflectionMethod $method */
            $method = $class->getMethod($methodName);

            return $method->invoke($entity);
        }

        $field->setAccessible(true);
        $field->getValue($entity);
    }

    public function getAnnotations()
    {
        return $this->reader->getClassAnnotations($this);
    }

    public function getAnnotation($name)
    {
        return $this->reader->getClassAnnotation($this, $name);
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

    private function isValidAnnotation(\ReflectionClass $annotationClass)
    {
        return ($annotationClass->getName() == Validate::class) || ($annotationClass->isSubclassOf(Validate::class));
    }


    /**
     * @param null $filter
     * @return Property[]
     */
    public function getProperties($filter = null)
    {
        $return = [];
        foreach (parent::getProperties() as $prop) {
            $return[] = new Property($this->getName(), $prop->getName());
        }

        return $return;
    }

    public function getProperty($name)
    {
        return new Property($this->getName(), $name);
    }
}

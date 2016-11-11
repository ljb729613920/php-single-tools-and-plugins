<?php
/**
 * Created by PhpStorm.
 * User: JFernando
 * Date: 27/09/2016
 * Time: 16:24
 */

namespace JFernando\PHPValidate;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Inflector\Inflector;
use JFernando\PHPValidate\Annotation\Validate;

class ValidatorVerifier
{
    protected $byGet;

    public function __construct(bool $byGet = true)
    {
        $this->byGet = $byGet;
    }

    public function validate($entity, $args = [])
    {
        $exceptions = [];

        $reflectedClass = new \ReflectionClass($entity);
        $reader = new AnnotationReader();

        foreach ($reflectedClass->getProperties() as $prop) {
            $annotations = $reader->getPropertyAnnotations($prop);

            foreach ($annotations as $annotation) {
                $annotationClass = new \ReflectionClass($annotation);

                if ($this->isValidAnnotation($annotationClass)) {
                    $validationErrors = $this->validateAnnotation($annotation, $prop, $reflectedClass, $entity, $args);
                    $exceptions = array_merge($exceptions, $validationErrors);
                }
            }
        }

        return $exceptions;
    }

    private function validateAnnotation($annotation, \ReflectionProperty $prop, $reflectedClass, $entity, $args)
    {
        $exceptions = [];
        if ($annotation != null) {
            $fieldValue = $this->getValueFrom($prop, $reflectedClass, $entity);

            if ($annotation->isClass) {
                if ($fieldValue === null) {
                    return [$this->getNotValidError($annotation, $prop, $reflectedClass, $args)];
                }
                return $this->validate($fieldValue);
            }

            /** @var Validator $validator */
            $validator = new $annotation->validator;
            $isValid = $validator->isValid($fieldValue, $annotation->param);

            if (!$isValid) {
                $exceptions[] = $this->getNotValidError($annotation, $prop, $reflectedClass, $args);
            }
        }

        return $exceptions;
    }

    private function getNotValidError($annotation, \ReflectionProperty $prop, \ReflectionClass $class, $args)
    {
        $annotationFields = $this->getAnnotationFields($annotation);
        $annotationFields['field'] = $prop->getName();
        $annotationFields['class'] = $class->getShortName();

        $annotationFields = array_merge($annotationFields, $args);

        $annotation->code = $this->formatString($annotation->code, $annotationFields);
        $annotation->message = $this->formatString($annotation->message, $annotationFields);

        return new $annotation->errors($annotation->code, $annotation->message, $args);
    }

    private function formatString(string $value, array $params) : string
    {
        foreach ($params as $key => $val) {
            $value = str_replace("#{{$key}}", strval($val), $value);
        }

        return $value;
    }

    private function getAnnotationFields($annotation) : array
    {
        $vars = [];
        $annotationClass = new \ReflectionClass($annotation);

        foreach ($annotationClass->getProperties() as $prop) {
            $vars[$prop->getName()] = $this->getValueFrom($prop, $annotationClass, $annotation);
        }

        return $vars;
    }


    private function getValueFrom(\ReflectionProperty $property, \ReflectionClass $class, $entity)
    {

        if ($property->isPublic()) {
            return $property->getValue($entity);
        }

        if ($this->byGet) {
            $name = $property->getName();
            $methodName = 'get' . Inflector::classify($name);

            $method = $class->getMethod($methodName);

            return $method->invoke($entity);
        }

        $property->setAccessible(true);

        return $property->getValue($entity);
    }

    private function isValidAnnotation(\ReflectionClass $annotationClass)
    {
        return ($annotationClass->getName() == Validate::class) || ($annotationClass->isSubclassOf(Validate::class));
    }
}

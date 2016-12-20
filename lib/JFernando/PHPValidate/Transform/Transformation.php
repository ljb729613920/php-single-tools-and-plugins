<?php
/**
 * Created by PhpStorm.
 * User: lunify
 * Date: 19/12/16
 * Time: 02:29
 */

namespace JFernando\PHPValidate\Transform;


use JFernando\PHPValidate\Transform\Annotation\Transform;
use JFernando\PHPValidate\Utils\Reflection;

class Transformation
{

    protected $byGet;

    public function __construct($byGet = true)
    {
        $this->byGet = $byGet;
    }

    public function transform($object){
        $reflected = new Reflection($object, $this->byGet);

        foreach ($reflected->getProperties() as $property){
            /** @var Transform $transformer */
            foreach ($property->getAnnotationsChilds(Transform::class) as $transform){
                /** @var Transformer $transformer */

                if($transform->isClass){
                    return get_class($property->getValue($object));
                }

                $transformer = new $transform->transformer;
                $property->setValue($object, $transformer->transform($property->getValue($object)));
            };
        }

    }

}
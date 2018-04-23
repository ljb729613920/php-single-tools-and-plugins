<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 2:00 PM
 */

namespace JFernando\PHPValidate\Utils;

class ArrayUtil
{

    protected $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function first()
    {
        if (count($this->array) > 0) {
            list($item) = $this->array;
            return $item;
        }

        return false;
    }

    public function second()
    {
        if (count($this->array) > 1) {
            list($reject, $item) = $this->array;
            return $item;
        }

        return false;
    }

    public function toArray()
    {
        return $this->array;
    }

    public function map(\Closure $function)
    {
        $lista = $this->array;
        $result = [];

        foreach ($lista as $key => $item) {
            $result[$key] = $function($item, $key);
        }

        return new ArrayUtil($result);
    }

    public static function isArray($ele)
    {
        return is_array($ele);
    }

    public static function isAssociativeArray($elem)
    {

        if (!self::isArray($elem)) {
            return false;
        }

        $keys = array_keys($elem);
        return array_keys($keys) !== $keys;
    }

    public function reduce(\Closure $function, $initial = null)
    {
        $lista = $this->array;
        return array_reduce($lista, $function, $initial);
    }

    public function merge(array $arr2) {
        return new ArrayUtil(array_merge($this->array, $arr2));
    }

    public function filter(\Closure $func) {
        return new ArrayUtil(array_filter($this->array, $func, ARRAY_FILTER_USE_BOTH));
    }

    public function copy() {
        $newer = [];

        foreach ( $this->array as $key => $item ) {
            $newer[$key] = $item;
        }

        return $newer;
    }

    public function sort(\Closure $func) {
        $arr = $this->copy();
        usort($arr, $func);

        return new ArrayUtil($arr);
    }

    public function concat(array $arr2)
    {
        return new ArrayUtil(array_merge($this->array, $arr2));
    }

    public function groupBy(\Closure $keyFunc, \Closure $valFunc = null)
    {
        $result = $this->reduce(function($acc, $val) use ($keyFunc, $valFunc) {
            $key = $keyFunc($val);

            if(array_key_exists($key, $acc)) {
                $acc[$key][] = $valFunc ? $valFunc($val) : $val;
            } else {
                $acc[$key] = [$valFunc ? $valFunc($val) : $val];
            }

            return $acc;
        });

        return new ArrayUtil($result);
    }
}
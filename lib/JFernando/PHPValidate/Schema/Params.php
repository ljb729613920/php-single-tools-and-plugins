<?php
/**
 * Created by PhpStorm.
 * User: jfernando
 * Date: 4/23/18
 * Time: 1:52 PM
 */

namespace JFernando\PHPValidate\Schema;


use JFernando\PHPValidate\Utils\ArrayUtil;

class Params
{

    protected $params;

    public function __construct(array $data)
    {
        $this->params = $data;
    }

    public function only(array $acceptable)
    {
        $util = new ArrayUtil($this->params);

        return $util
            ->filter(function($val, $key) use($acceptable) {
                return in_array($key, $acceptable);
            })
            ->toArray();
    }

}
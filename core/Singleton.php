<?php
/**
 * User: jiabin
 * Date: 2019/3/5
 * Time: 17:00
 */

namespace Core;

trait Singleton {
    private static $instance;

    static function getModel(...$args) {
        if (self::$instance === null) {
            self::$instance = new static(...$args);
        }

        return self::$instance;
    }
}
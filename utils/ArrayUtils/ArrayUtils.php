<?php
/**
 * User: jiabin
 * Date: 2019/3/5
 * Time: 16:22
 */
namespace Utils;

use Core\Singleton;

class ArrayUtils {

    use Singleton;

    /**
     * 去重、去空值、获取某列
     * @param array $arr
     * @param string $column
     * @return array
     */
    public function uniqueColumn(array $arr, string $column): array {
        if (empty($arr)){
            return [];
        }
        return array_unique(array_filter(array_column($arr, $column)));
    }
}
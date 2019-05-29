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
     * @param array $arr        目标数组
     * @param string $column    列字段
     * @param string $key       赋值索引数组key
     * @return array
     */
    public function uniqueColumn(array $arr, string $column, $key = null): array {
        if (empty($arr)){
            return [];
        }

        return array_unique(array_filter(array_column($arr, $column, $key)));
    }

    /**
     * 获取某列后拼装成字符串
     * @param array $arr        目标数组
     * @param string $column    列字段
     * @param string $separator 字符串分隔符
     * @return string
     */
    public function uniqueColumnString(array $arr, string $column, string $separator = ','): string {
        if (empty($arr)) {
            return '';
        }

        return implode($separator, $this->uniqueColumn($arr, $column, null));
    }

    /**
     * 对数组根据某一字段进行排序
     * @param $array        目标数组
     * @param $on           排序字段
     * @param string $order ASC正序|DESC倒序
     * @return array
     */
    public function arraySort($array, $on, $order = 'ASC'): array {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                            continue;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case 'ASC':
                    asort($sortable_array);
                    break;
                case 'DESC':
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[] = $array[$k];
            }
        }

        return $new_array;
    }
}
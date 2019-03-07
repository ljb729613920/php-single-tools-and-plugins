<?php
/**
 * User: jiabin
 * Date: 2019/2/26
 * Time: 17:40
 */

namespace Utils;

use Core\Singleton;

class DateUtils {

    use Singleton;

    /**
     * 获取到明天12点剩余时间
     * @return false|int
     */
    public function leftTimestamp(): int {
        return strtotime(date('Ymd')) + 86400 - time();
    }

    /**
     * 获取当前13位 毫秒级时间戳
     * @return float
     */
    public function millisecond(): float {
        list($microsecond, $time) = explode(' ', microtime());

        return (float)sprintf('%.0f', (floatval($microsecond) + floatval($time)) * 1000);
    }

    /**
     *  毫秒时间改为秒
     */
    public function mtimeFormat($mtime, $formatType = 1): string {
        if ($mtime <= 0 || !is_numeric($mtime)) {
            return '';
        }

        $data = null;
        switch ($formatType) {
            case 1: // 转换秒
                $data = floor($mtime / 1000);
                break;

            case 2:     // 转 date
                $data = date('Y-m-d', floor($mtime / 1000));
                break;

            case 3:     // 转 datetime
                $data = date('Y-m-d H:i:s', floor($mtime / 1000));
                break;

            case 4:     // 转 Y-m-d H:i
                $data = date('Y-m-d H:i', floor($mtime / 1000));
                break;
            default:
        }

        return $data;
    }

    /**
     * 输出时间差
     * @param int $currentTimestamp
     */
    public function recordTime(int $currentTimestamp) {
        echo sprintf('%.3f', ($this->millisecond() - $currentTimestamp) / 1000) . 's', '<hr>';
    }
}
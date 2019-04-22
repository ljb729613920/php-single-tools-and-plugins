<?php
/**
 * User: jiabin
 * Date: 2019/2/26
 * Time: 14:09
 */

namespace Utils;

use Core\Singleton;

class StringUtils {

    use Singleton;

    /**
     * 驼峰法/下划线命名（互转）
     * @param $data
     * @param array $filterKeyArr (不用转换的键值集）
     * @param int $type 1:master_id => masterId    2:masterId => master_id
     * @return array
     */
    public function translate($data, $type = 1, $filterKeyArr = array()): array {
        if ($type == 1) {
            $str = 'abcdefghijklmnopkrstuvwxyz';
            for ($i = 0; $i < 26; $i++) {
                $arr[] = '_' . $str[$i];
                $arr2[] = strtoupper($str[$i]);
            }
        } elseif ($type == 2) {
            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            for ($i = 0; $i < 26; $i++) {
                $arr[] = $str[$i];
                $arr2[] = '_' . strtolower($str[$i]);
            }
        }

        if (is_array($data)) {
            $tmpData = array();
            foreach ($data as $k => $v) {
                if (!in_array($k, $filterKeyArr)) {
                    $tmpKey = str_replace($arr, $arr2, $k);
                    if (is_array($v) && !empty($v)) {
                        $tmpData[$tmpKey] = self::translate($v, $type, $filterKeyArr);
                    } else {
                        $tmpData[$tmpKey] = $v;
                    }
                } else {
                    $tmpData[$k] = $v;
                }
            }
        } elseif (is_object($data)) {
            $tmpData = new \stdClass();
            $keys = get_object_vars($data);
            foreach ($keys as $key => $val) {
                $tmpKey = str_replace($arr, $arr2, $key);
                if (in_array($key, $filterKeyArr)) {
                    $tmpData->$key = $data->$key;
                    continue;
                }

                if (is_object($data->$key)) {
                    $tmpData->$tmpKey = self::translate($data->$key, $type, $filterKeyArr);
                } elseif (is_array($data->$key)) {
                    foreach ($data->$key as $k => $v) {
                        if (is_array($v) || is_object($v)) {
                            $tmpData->$tmpKey[$k] = self::translate($v, $type, $filterKeyArr);
                        } else {
                            $tmpData->$tmpKey[$k] = $v;
                        }
                    }
                } else {
                    $tmpData->$tmpKey = $data->$key;
                }
            }
        } else {
            $tmpData = $data;
        }

        return $tmpData;
    }

    /**
     * 名字屏蔽
     * @param string $name
     * @param int $length
     * @param string $replaceChar
     * @param int $type
     * @return string
     */
    public function shieldName($name, $type = 1, $length = 1, $replaceChar = '*'): string {
        switch ($type) {
            case 1: //替换模式成 王小二 -> 王师傅，不支持英文
                //判断是否包含中文字符
                if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $name)) {
                    $name = mb_substr($name, 0, $length, 'UTF-8') . $replaceChar;
                } else {
                    $name = 'xxx';
                }
                break;
            case 2://替换模式成 王小二 -> 王*二，支持英文
                //判断是否包含中文字符
                if (preg_match("/[\x{4e00}-\x{9fa5}]+/u", $name)) {
                    //按照中文字符计算长度
                    $len = mb_strlen($name, 'UTF-8');
                    if ($len >= 3) {
                        //三个字符或三个字符以上掐头取尾，中间用*代替
                        $name = mb_substr($name, 0, $length, 'UTF-8') . $replaceChar . mb_substr($name, -1, 1, 'UTF-8');
                    } elseif ($len == 2) {
                        //两个字符
                        $name = mb_substr($name, 0, $length, 'UTF-8') . $replaceChar;
                    }
                } else {
                    //按照英文字串计算长度
                    $len = strlen($name);
                    if ($len >= 3) {
                        //三个字符或三个字符以上掐头取尾，中间用*代替
                        $name = substr($name, 0, $length) . $replaceChar . substr($name, -1);
                    } elseif ($len == 2) {
                        //两个字符
                        $name = substr($name, 0, $length) . $replaceChar;
                    }
                }
                break;
            default:
        }

        return $name;
    }

    /**
     * https强制转换为http
     * @param $str
     * @return mixed
     */
    public function https2http($str): string {
        if (empty($str)) {
            return $str;
        }
        if (substr(trim($str), 0, 5) == 'http:') {
            return $str;
        } else {
            return str_ireplace('https:', 'http:', $str);
        }
    }

    /**
     * 获取客户端真实的ip
     * @return mixed
     */
    public function clientRealIp(): string {
        static $realip = null;
        if ($realip !== null) {
            return $realip;
        }
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($arr AS $ip) {
                    $ip = trim($ip);
                    if ($ip != 'unknown') {
                        $realip = $ip;
                        break;
                    }
                }
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            } else {
                if (isset($_SERVER['REMOTE_ADDR'])) {
                    $realip = $_SERVER['REMOTE_ADDR'];
                } else {
                    $realip = '0.0.0.0';
                }
            }
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $realip = getenv('HTTP_X_FORWARDED_FOR');
            } elseif (getenv('HTTP_CLIENT_IP')) {
                $realip = getenv('HTTP_CLIENT_IP');
            } else {
                $realip = getenv('REMOTE_ADDR');
            }
        }
        preg_match("/[\d\.]{7,15}/", $realip, $onlineip);
        $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';

        return $realip;

    }
}
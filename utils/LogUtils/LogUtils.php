<?php
/**
 * User: jiabin
 * Date: 2019/3/7
 * Time: 11:05
 */

namespace Utils;


use Core\Singleton;

class LogUtils {
    private $logLevel = ['error', 'info']; //日志等级 error：错误日志（默认），info：调试日志

    use Singleton;

    /**
     * 将日志写入文件
     * @param $error  错误信息
     * @param string $logLevel 日志等级 error：错误日志（默认），info：调试日志
     */
    public function writeLog($error, $logLevel = 'error') {
        if (!in_array($logLevel, explode(",", $this->logLevel))) {
            return;
        }
        $dirPath = Yii::app()->getRuntimePath() . '/logs/' . date('Ym');
        if (!is_dir($dirPath)) {
            @mkdir(iconv("UTF-8", "GBK", $dirPath), 0777, true);
        }
        $log = "\n" . print_r($error, true) . "";
        $traces = debug_backtrace();
        foreach ($traces as $trace) {
            if (isset($trace['file'], $trace['line']) && strpos($trace['file'], '/') !== 0) {
                $log .= "\nin " . $trace['file'] . ' (' . $trace['line'] . ')';
            }
        }
        $log .= "\n";
        $projectName = 'projectName';
        $data = array('dateTime' => date('Y/m/d H:i:s'), 'projectName' => $projectName, 'logType' => 'log', 'errorMsg' => $log,);
        file_put_contents($dirPath . '/' . $projectName . '_log_' . date('d') . '.txt', json_encode($data) . "\n", FILE_APPEND);
    }
}
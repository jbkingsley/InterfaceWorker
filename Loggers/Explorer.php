<?php
/**
 * Logger_Explorer 直接输出日记到控制台的日记类
 * 
 * - 测试环境下使用
 * 
 * @package     InterfaceWorker\Loggers
 * @author      kings
 */
namespace InterfaceWorker\Loggers;

use InterfaceWorker\Logger;

class LoggerToExplorer extends Logger {

	public function log($type, $msg, $data) {
        $msgArr = array();
        $msgArr[] = date('Y-m-d H:i:s', $_SERVER['REQUEST_TIME']);
        $msgArr[] = strtoupper($type);
        $msgArr[] = str_replace(PHP_EOL, '\n', $msg);
        if ($data !== NULL) {
            $msgArr[] = is_array($data) ? json_encode($data) : $data;
        }

        $content = implode('|', $msgArr) . PHP_EOL;

        echo "\n", $content, "\n";
	}
}

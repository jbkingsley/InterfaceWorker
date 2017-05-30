<?php
/**
 * api_request_formatter_callable 格式化回调类型
 *
 * @package     PhalApi\Request
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-11-07
 */
namespace InterfaceWorker\Request\Formatter;

use InterfaceWorker\Exceptions\ServerInternalException;
use InterfaceWorker\Request\Formatter;

class CallableType extends Base implements Formatter {

    /**
     * 对回调类型进行格式化
     *
     * @param mixed $value 变量值
     * @param array $rule array('callback' => '回调函数', 'params' => '第三个参数')
     * @return boolean/string 格式化后的变量
     *
     */
    public function parse($value, $rule) {
        if (!isset($rule['callback']) || !is_callable($rule['callback'])) {
            throw new ServerInternalException(
                "invalid callback for rule: {$rule['name']}"
            );
        }

        if (isset($rule['params'])) {
            return call_user_func($rule['callback'], $value, $rule, $rule['params']);
        } else {
            return call_user_func($rule['callback'], $value, $rule);
        }
    }
}

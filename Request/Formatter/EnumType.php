<?php
/**
 * api_request_formatter_eum 格式化枚举类型
 *
 * @package     PhalApi\Request
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-11-07
 */
namespace InterfaceWorker\Request\Formatter;

use InterfaceWorker\Exceptions\BadRequestException;
use InterfaceWorker\Request\Formatter;

class EnumType extends Base implements Formatter {

    /**
     * 检测枚举类型
     * @param string $value 变量值
     * @param array $rule array('name' => '', 'type' => 'enum', 'default' => '', 'range' => array(...))
     * @return 当不符合时返回$rule
     */
    public function parse($value, $rule) {
        $this->formatEnumRule($rule);

        $this->formatEnumValue($value, $rule);

        return $value;
    }

    /**
     * 检测枚举规则的合法性
     * @param array $rule array('name' => '', 'type' => 'enum', 'default' => '', 'range' => array(...))
     * @throws Exception
     */
    protected function formatEnumRule($rule) {
        if (!isset($rule['range'])) {
            throw new BadRequestException(
                "miss {$rule['name']}'s enum range");
        }

        if (empty($rule['range']) || !is_array($rule['range'])) {
            throw new BadRequestException(
                "{$rule['name']}'s enum range can not be empty");
        }
    }
}

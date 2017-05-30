<?php
/**
 * api_request_formatter_base 公共基类
 *
 * - 提供基本的公共功能，便于子类重用
 *
 * @package     PhalApi\Request
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-11-07
 */
namespace InterfaceWorker\Request\Formatter;

use InterfaceWorker\Exceptions\BadRequestException;

class Base {

    /**
     * 根据范围进行控制
     */
    protected function filterByRange($value, $rule) {
        $this->filterRangeMinLessThanOrEqualsMax($rule);

        $this->filterRangeCheckMin($value, $rule);

        $this->filterRangeCheckMax($value, $rule);

        return $value;
    }

    protected function filterRangeMinLessThanOrEqualsMax($rule) {
        if (isset($rule['min']) && isset($rule['max']) && $rule['min'] > $rule['max']) {
            throw new BadRequestException(
                "min should <= {$rule['max']}, but now {$rule['name']} min = {$rule['min']} and max = {$rule['max']}"
            );
        }
    }

    protected function filterRangeCheckMin($value, $rule) {
        if (isset($rule['min']) && $value < $rule['min']) {
            throw new BadRequestException(
                "{$rule['name']} should >= {$rule['min']}, but now {$rule['name']} = {$value}"
            );
        }
    }

    protected function filterRangeCheckMax($value, $rule) {
        if (isset($rule['max']) && $value > $rule['max']) {
            throw new BadRequestException(
                "{$rule['name']} should <= {$rule['max']}, but now {$rule['name']} = {$value}"
            );
        }
    }

    /**
     * 格式化枚举类型
     * @param string $value 变量值
     * @param array $rule array('name' => '', 'type' => 'enum', 'default' => '', 'range' => array(...))
     * @throws BadRequestException
     */
    protected function formatEnumValue($value, $rule) {
        if (!in_array($value, $rule['range'])) {
            throw new BadRequestException(
                "{$rule['name']} should be in {$rule['range']}, but now {$rule['name']} = {$value}"
            );
        }
    }
}

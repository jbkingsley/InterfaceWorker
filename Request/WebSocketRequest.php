<?php

/**
 * api_request_coap 参数生成类
 * - 负责根据提供的参数规则，进行参数创建工作，并返回错误信息
 * - 需要与参数规则配合使用
 * @package     PhalApi\Request
 * @author      kings 2014-10-02
 */

namespace InterfaceWorker\Request;

use InterfaceWorker\Request;

class WebSocketRequest extends Request{
    protected $_servers = array();

    /**
     * @param array $data 参数来源
     */
    public function __construct($data = NULL) {
        parent::__construct($data);
    }

}

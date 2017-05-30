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

class CoapRequest extends Request{
    protected $_servers = array();

    /**
     * @param array $data 参数来源，可以为：$_GET/$_POST/$_REQUEST/自定义
     */
    public function __construct($data = NULL) {
        parent::__construct($data);
        $this->_servers = $this->getAllServerData('CoAP');
    }

    /**
     * 初始化请求$_Server
     * @param string $prefix     _$Server-key值
     * @return array|false
     */
    public function getAllServerData($prefix=null) {
        if (function_exists('getallserverdata')) {
            return getallserverdata();
        }

        //getserverdata
        $servers = array();
        foreach ($_SERVER as $key => $value) {
            $pattern = '/^'.$prefix.'_/';
            if($prefix and preg_match($pattern, $key)){
                $servers[$key] = $value;
            }else{
                $servers[$key] = $value;
            }
        }
        return $servers;
    }

    /**
     * 获取请求$_SERVER参数
     *
     * @param string $key     $_SERVER-key值
     * @param mixed  $default 默认值
     *
     * @return string
     */
    public function getServer($key, $default = NULL) {
        return isset($this->_servers[$key]) ? $this->_servers[$key] : $default;
    }
}

<?php
/**
 * api_response_json JSON响应类
 *
 * @package     PhalApi\Response
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-02-09
 */
namespace InterfaceWorker\Response;

use InterfaceWorker\Response;

class JsonResponse extends Response {

    public function __construct() {
    	$this->addHeaders('Content-Type', 'application/json;charset=utf-8');
    }
    
    protected function formatResult($result) {
        return json_encode($result);
    }

    /** ------------------ 结果输出 ------------------ **/

    /**
     * 结果输出
     * @return mixed
     */
    public function output() {
        $this->handleHeaders($this->headers);

        $rs = $this->getResult();
        return $this->formatResult($rs);
    }

}

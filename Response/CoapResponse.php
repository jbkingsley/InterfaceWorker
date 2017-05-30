<?php
/**
 * api_response_jsonp JSON响应类
 *
 * @package     PhalApi\Response
 * @license     http://www.phalapi.net/license GPL 协议
 * @link        http://www.phalapi.net/
 * @author      dogstar <chanzonghuang@gmail.com> 2015-02-09
 */
namespace InterfaceWorker\Response;

use InterfaceWorker\Response;

class CoapResponse extends Response {

    const R_CREATED = '2.01';
    const R_DELETED = '2.02';
    const R_VALID   = '2.03';
    const R_CHANGED = '2.04';
    const R_CONTENT = '2.05';

    const R_FAILED  = '4.00';

    protected $callback = '';

    private $option = array();
    private $payload = array();

    /**
     * @param string $callback JS回调函数名
     */
    public function __construct() {

    }

    /**
     * 对回调函数进行跨站清除处理
     *
     * - 可使用白名单或者黑名单方式处理，由接口开发再实现
     */
    protected function clearXss($callback) {
        return $callback;
    }

    protected function formatResult($result) {
        return $result;
    }

    public function setPayload($payload) {
        $this->payload = $payload;
    }

    public function setOption($option) {
        $this->option = $option;
    }

    /**
     * @param array $option CoAP响应Option
     * @param array $payload CoAP响应负载
     * @return array
     */
    public function ST_OK() {
        $this->setData(array(
            'option' => $this->option,
            'payload' => $this->payload
        ));
    }

    /**
     * 【4.00】Bad Request 请求错误，服务器无法处理。类似于HTTP 400。
     * 【4.01】Unauthorized 没有范围权限。类似于HTTP 401。
     * 【4.02】Bad Option 请求中包含错误选项。
     * 【4.03】Forbidden 服务器拒绝请求。类似于HTTP 403。
     * 【4.04】Not Found 服务器找不到资源。类似于HTTP 404。
     * 【4.05】Method Not Allowed 非法请求方法。类似于HTTP 405。
     * 【4.06】Not Acceptable 请求选项和服务器生成内容选项不一致。类似于HTTP 406。
     * 【4.12】Precondition Failed 请求参数不足。类似于HTTP 412。
     * 【4.15】Unsuppor Conten-Type 请求中的媒体类型不被支持。类似于HTTP 415。
     * 【5.00】Internal Server Error 服务器内部错误。类似于HTTP 500。
     * 【5.01】Not Implemented 服务器无法支持请求内容。类似于HTTP 501。
     * 【5.02】Bad Gateway 服务器作为网关时，收到了一个错误的响应。类似于HTTP 502。
     * 【5.03】Service Unavailable 服务器过载或者维护停机。类似于HTTP 503。
     * 【5.04】Gateway Timeout 服务器作为网关时，执行请求时发生超时错误。类似于HTTP 504。
     * 【5.05】Proxying Not Supported 服务器不支持代理功能。
     * @param string $error_code 错误代码
     * @return Response
     */
    public function ST_ERROR($error_code) {
        $this->setError($error_code);
    }


    /** ------------------ 结果输出 ------------------ **/

    /**
     * 结果输出
     * @return mixed
     */
    public function output() {
        $rs = $this->getResult();
        return $this->formatResult($rs);
    }

}

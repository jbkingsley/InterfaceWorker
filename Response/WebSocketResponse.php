<?php
/**
 * websocket响应类
 */
namespace InterfaceWorker\Response;

class WebSocketResponse extends \InterfaceWorker\Response {

    private $messageId = 0;
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
        $message = $result['data'];
        if($result['st']!==200){
            $message['error']['error_code'] = $result['error_code'];
            $message['error']['error_message'] = $result['error_msg'];
        }

        return $message;
    }

    public function setPayload($payload) {
        $this->payload = $payload;
    }

    public function setMessageId($id) {
        $this->messageId = $id;
    }

    /**
     * string $type 类型
     * array $payload 负载
     * @return array
     */
    public function ST_OK() {
        return array(
            'messageId' => $this->messageId,
            'payload' => $this->payload
        );
    }

    /**
     * @param string $error_code 错误代码
     * @param string $error_msg 错误消息
     * @return array
     */
    public function ST_ERROR($error_code, $error_msg='') {
        $this->setSt(500);
        $this->setError($error_code);
        $this->setMessage($error_msg);
        return array(
            'messageId' => $this->messageId,
            'payload' => $this->payload,
        );
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

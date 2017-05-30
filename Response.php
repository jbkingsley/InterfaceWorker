<?php
/**
 * Response 响应类
 *
 * - 拥有各种结果返回状态 ，以及对返回结果 的格式化
 * - 其中：200成功，400非法请求，500服务器错误等
 *
 * @package     Response\Response
 * @author      dogstar <chanzonghuang@gmail.com> 2014-10-02
 */
namespace InterfaceWorker;

abstract class Response {

	/**
	 * @var string $st 返回状态码，其中：200成功，400非法请求，500服务器错误
	 */
    protected $st = '200';
    
    /**
     * @var array 待返回给客户端的数据
     */
    protected $data = array();

    /**
     * @var string $error_code 错误码
     */
    protected $error_code = '';

    /**
     * @var string $error_msg 错误消息
     */
    protected $error_msg = '';
    
    /**
     * @var array $headers 响应报文头部
     */
    protected $headers = array();

    /** ------------------ setter ------------------ **/

    /**
     * 设置返回状态码
     * @param string $st 返回状态码，其中：200成功，400非法请求，500服务器错误
     * @return Response
     */
    public function setSt($st) {
    	$this->st = $st;
    	return $this;
    }
    
    /**
     * 设置返回数据
     * @param array/string $data 待返回给客户端的数据，建议使用数组，方便扩展升级
     * @return Response
     */
    public function setData($data) {
    	$this->data = $data;
    	return $this;
    }
    
    /**
     * 设置错误信息
     * @param string $code 错误代码
     * @return Response
     */
    public function setError($code) {
    	$this->error_code = $code;
    	return $this;
    }

    /**
     * 设置错误信息
     * @param string $message 错误代码
     * @return Response
     */
    public function setMessage($message) {
        $this->error_msg = $message;
        return $this;
    }

    /**
     * 添加报文头部
     * @param string $key 名称
     * @param string $content 内容
     */
    public function addHeaders($key, $content) {
        $this->headers[$key] = $content;
    }

    /** ------------------ 结果输出 ------------------ **/

    /**
     * 结果输出
     * @return mixed
     */
    abstract public function output();

    /** ------------------ getter ------------------ **/

    public function getResult() {
        $rs = array(
            'st' => $this->st,
            'rs' => $this->data,
            'error_code' => $this->error_code,
            'error_msg' => $this->error_msg
        );

        return $rs;
    }

    /**
     * 获取头部
     *
     * @param string $key 头部的名称
     * @return string/array 对应的内容，不存在时返回NULL，$key为NULL时返回全部
     */
    public function getHeaders($key = NULL) {
        if ($key === NULL) {
            return $this->headers;
        }

        return isset($this->headers[$key]) ? $this->headers[$key] : NULL;
    }

    /** ------------------ 内部方法 ------------------ **/

    /**
     * 格式化需要输出返回的结果
     *
     * @param array $result 待返回的结果数据
     *
     * @see Response::getResult()
     */

    protected function handleHeaders($headers) {
        foreach ($headers as $key => $content) {
            @header($key . ': ' . $content);
        }
    }

    abstract protected function formatResult($result);
}

<?php
/**
 * InterfaceWorker 应用类
 *
 * - 实现远程服务的响应、调用等操作
 *
 * <br>使用示例：<br>
```
 * $api = new Interfaces();
 * $rs = $api->response();
 * $rs->output();
```
 *
 * @package     InterfaceWorker\Response
 */
namespace InterfaceWorker;

use InterfaceWorker\Exceptions;
use Exception;

class Interfaces {

    private $eventSpace;

    public function __construct() {

    }

    public function setCurrentClientId($clientId){
        Functions::DI()->currentClientId = $clientId;
    }

    public function setEventSpace($nameSpace){
        $this->eventSpace = $nameSpace;
    }

    /**
     * 响应操作
     *
     * 通过工厂方法创建合适的控制器，然后调用指定的方法，最后返回格式化的数据。
     *
     * @return mixed 根据配置的或者手动设置的返回格式，将结果返回
     *  其结果包含以下元素：
    ```
     *  array(
     *      'st'   => 200,	            //服务器响应状态
     *      'rs'  => array(),	        //正常并成功响应后，返回给客户端的数据
     *      'error_msg'   => '',		        //错误提示信息
     *  );
    ```@throws Exceptions
     * @throws Exception
     */
    public function response() {
        $rs = Functions::DI()->response;
        $service = Functions::DI()->request->get('service', 'Default.Index');

        try {
            // 接口响应
            $api = ApiFactory::generateService($this->eventSpace, $service);
            list($apiClassName, $action) = explode('.', $service);
            $data = call_user_func(array($api, $action));

            $rs->setData($data);
        } catch (Exceptions $ex) {
            // 框架或项目的异常
            $rs->setSt($ex->getCode());
            $rs->setError('-99');
            $rs->setMessage($ex->getMessage());
        } catch (Exception $ex) {
            // 不可控的异常
            //DI()->logger->error($service, strval($ex));
            throw $ex;
        }

        return $rs;
    }

}

<?php
/**
 * ApiFactory 创建控制器类 工厂方法
 *
 * 将创建与使用分离，简化客户调用，负责控制器复杂的创建过程
 *
```
 *      根据请求(?service=XXX.XXX)生成对应的接口服务，并进行初始化
 *      $api = ApiFactory::generateService();
```
 * @package     InterfaceWorker\Api
 */
namespace InterfaceWorker;

use InterfaceWorker\Exceptions\BadRequestException;
use InterfaceWorker\Exceptions\ServerInternalException;

class ApiFactory {

    /**
     * 创建服务器
     * 根据客户端提供的接口服务名称和需要调用的方法进行创建工作，如果创建失败，则抛出相应的自定义异常
     * string $_REQUEST['service'] 接口服务名称，格式：XXX.XXX
     * 创建过程主要如下：
     * - 1、 是否缺少控制器名称和需要调用的方法
     * - 2、 控制器文件是否存在，并且控制器是否存在
     * - 3、 方法是否可调用
     * - 4、 控制器是否初始化成功
     * @param $eventSpace;
     * @param boolean $isInitialize 是否在创建后进行初始化
     * @return Api 自定义的控制器
     *
     * @uses Api::init()
     * @throws BadRequestException 非法请求下返回400
     * @throws ServerInternalException
     */
    static function generateService($eventSpace, $isInitialize = TRUE) {
        $service = Functions::DI()->request->get('service', 'Default.Index');

        $serviceArr = explode('.', $service);

        if (count($serviceArr) < 2) {
            throw new BadRequestException(
                "service ({$service}) illegal"
            );
        }

        list ($apiClassName, $action) = $serviceArr;
        $apiClassName = $eventSpace . ucfirst($apiClassName);
        // $action = lcfirst($action);


        if (!class_exists($apiClassName)) {
            throw new BadRequestException(
                "no such service as {$service}"
            );
        }

        $api = new $apiClassName();

        if (!is_subclass_of($api, 'InterfaceWorker\Api')) {
            throw new ServerInternalException(
                "{$apiClassName} should be subclass of Api"
            );
        }

        if (!method_exists($api, $action) || !is_callable(array($api, $action))) {
            throw new BadRequestException(
                "no such service as {$service}"
            );
        }

        if ($isInitialize) {
            $api->init();
        }

        return $api;
    }

}

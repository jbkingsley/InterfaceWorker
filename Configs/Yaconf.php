<?php
/**
 * PhalApi_Config_Yaconf Yaconf扩展配置类
 *
 * - 通过Yaconf扩展快速获取配置
 *
 * 使用示例：
```
 * <code>
 * $config = new PhalApi_Config_Yaconf();
 *
 * var_dump($config->get('foo')); //相当于var_dump(Yaconf::get("foo"));
 *
 * var_dump($config->has('foo')); //相当于var_dump(Yaconf::has("foo"));
 * </code>
```
 *
 * @package     InterfaceWorker\Configs
 * @author      kings
 */
namespace InterfaceWorker\Configs;

use Yaconf;
use InterfaceWorker\Config;

class ConfigByYaconf implements Config {

    public function get($key, $default = NULL) {
        return Yaconf::get($key, $default);
    }

    public function has($key) {
        return Yaconf::has($key);
    }
}

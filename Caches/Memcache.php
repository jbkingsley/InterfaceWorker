<?php
/**
 * Memecahce MC缓存
 *
 * - 使用序列化对需要存储的值进行转换，以提高速度
 * - 默认不使用zlib对值压缩
 * - 请尽量使用Memcached扩展
 *
 * @package     InterfaceWorker\Caches
 * @author      Kings
 */
namespace InterfaceWorker\Caches;

use InterfaceWorker\Cache;

class Memcache implements Cache {

    protected $memcache = null;

    protected $prefix;
    protected $object;

    /**
     * @param string $config['host'] Memcache域名
     * @param int $config['port'] Memcache端口
     * @param string $config['prefix'] Memcache key prefix
     */
    public function __construct($config) {
        $this->memcache = $this->createMemcache();
        $this->memcache->addServer($config['host'], $config['port']);
        $this->prefix = isset($config['prefix']) ? $config['prefix'] : '';
        $this->object = isset($config['object']) ? $config['object'] : '';
    }

    public function set($key, $value, $expire = 600) {
        if(class_exists($this->object)){
            $value = new $this->object($value);
        }
        $this->memcache->set($this->formatKey($key), $value, 0, $expire);
    }

    public function get($key) {
        $value = $this->memcache->get($this->formatKey($key));
        if(class_exists($this->object)){
            return ($value !== FALSE and $value instanceof $this->object) ? call_user_func(array($this->object, 'getValue'), $value) : NULL;
        }
        return $value !== FALSE ? $value : NULL;
    }

    public function delete($key) {
        return $this->memcache->delete($this->formatKey($key));
    }

    /**
     * 获取MC实例，以便提供桩入口
	 * @return Memcache
     */
    protected function createMemcache() {
        return new \Memcache();
    }

    protected function formatKey($key) {
        return $this->prefix . $key;
    }
}

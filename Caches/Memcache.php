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
use SlightPHP\Cache_MemcacheObject;

class Memcache implements Cache {

    protected $memcache = null;

    protected $prefix;

    /**
     * @param string $config['host'] Memcache域名
     * @param int $config['port'] Memcache端口
     * @param string $config['prefix'] Memcache key prefix
     */
    public function __construct($config) {
        $this->memcache = $this->createMemcache();
        $this->memcache->addServer($config['host'], $config['port']);
        $this->prefix = isset($config['prefix']) ? $config['prefix'] : '';
    }

    public function set($key, $value, $expire = 600) {
        $this->memcache->set($this->formatKey($key), new Cache_MemcacheObject($value), 0, $expire);
    }

    public function get($key) {
        $value = $this->memcache->get($this->formatKey($key)); var_dump($value);
        return $value !== FALSE and $value instanceof Cache_MemcacheObject ? $value->v : NULL;
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

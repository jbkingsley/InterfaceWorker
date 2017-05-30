<?php
/**
 * Cache 缓存接口
 *
 * @package     InterfaceWorker\Cache
 * @author      Kings
 */
namespace InterfaceWorker;

interface Cache {

	/**
	 * 设置缓存
	 * 
	 * @param string $key 缓存key
	 * @param mixed $value 缓存的内容
	 * @param int $expire 缓存有效时间，单位秒，非时间戳
	 */
    public function set($key, $value, $expire = 600);

    /**
     * 读取缓存
     * 
     * @param string $key 缓存key
     * @return mixed 失败情况下返回NULL
     */
    public function get($key);

    /**
     * 删除缓存
     * 
     * @param string $key
     */
    public function delete($key);
}

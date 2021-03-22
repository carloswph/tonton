<?php

namespace TonTon;

trait Cacheton {

	/**
     * @var reference to multiton array of instances
     */
    private static $instances = [];

    /**
     * @var expiring time for caching
     */
    protected static $expires = 3600;

    /**
     * @var expiring time for caching
     */
    protected $driver;
    
    /**
     * Creates a new instance of a multiton class flagged with a key.
     *
     * @param $key the key which the instance should be stored/retrieved
     *
     * @return self
     */
    final public static function instance($key, $expire = null)
    {


        $cache = new \Memcached();
        $cache->addServer("localhost", 11211);

        if(!array_key_exists($key, self::$instances)) {

            $isCached = $cache->get($key);
            if(!$isCached) {

                if(!is_null($expire)) {
                    self::$instances[$key] = new self;
                    $cache->set($key, self::$instances[$key], $expire);
                } else {
                    self::$instances[$key] = new self;
                    $cache->set($key, self::$instances[$key], self::$expires);
                }         

            } else {
                self::$instances[$key] = new $isCached;
                echo 'Cached';
            }
        }
        
        return self::$instances[$key];
    }

    /**
     * Prevents cloning the multiton instances.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Prevents unserializing the multiton instances.
     *
     * @return void
     */
    public function __wakeup() {}
}
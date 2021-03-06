<?php

namespace TonTon;

trait Multiton {

	/**
     * @var reference to multiton array of instances
     */
    private static $instances = [];
    
    /**
     * Creates a new instance of a multiton class flagged with a key.
     *
     * @param $key the key which the instance should be stored/retrieved
     *
     * @return self
     */
    final public static function instance($key)
    {
        if(!array_key_exists($key, self::$instances)) {
            
            self::$instances[$key] = new self;   
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
    private function __wakeup() {}
}
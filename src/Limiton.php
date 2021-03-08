<?php

namespace TonTon;

trait Limiton {

	/**
     * @var reference to limiton array of instances
     */
    private static $instances = [];

    /**
     * @var limit of concurrent instances of the class
     */
    public static $limit = 2;
    
    /**
     * Creates a new instance of a limiton class flagged with a key.
     *
     * @param $key the key which the instance should be stored/retrieved
     *
     * @return self
     */
    final public static function instance($key)
    {
        if(!array_key_exists($key, self::$instances)) {

            if(count(self::$instances) < self::$limit) {
                self::$instances[$key] = new self;
            }
              
        }
        
        return self::$instances[$key];
    }

    /**
     * Sets the maximum number of instances the class allows
     *
     * @param $number int number of instances allowed
     * @return void
     */
    public function setLimit(int $number) {

        self::$limit = $number;
    }

    /**
     * Prevents cloning the multiton instances.
     *
     * @return void
     */
    public function __clone() {}

    /**
     * Prevents unserializing the multiton instances.
     *
     * @return void
     */
    public function __wakeup() {}
}
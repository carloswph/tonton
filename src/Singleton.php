<?php

namespace TonTon;

trait Singleton {

	/**
     * @var reference to singleton instance
     */
    private static $instance;
    
    /**
     * Creates a new instance of a singleton class (via late static binding),
     * accepting a variable-length argument list.
     *
     * @return self
     */
    final public static function instance()
    {
        if(!self::$instance) {
            
            self::$instance = new self;    
        }
        
        return self::$instance;
    }

    /**
     * Prevents calling the class using the new keyword, if the __construct is protected.
     *
     * @return void
     */
    private function __construct() {}

    /**
     * Prevents cloning the singleton instance.
     *
     * @return void
     */
    final private function __clone() {}

    /**
     * Prevents unserializing the singleton instance.
     *
     * @return void
     */
    final private function __wakeup() {}
}
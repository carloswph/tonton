<?php

namespace TonTon;

trait Selecton {

	/**
     * @var reference to singleton instance
     */
    private static $instance;
    
    /**
     * Creates a new instance of a singleton class if the
     * requirements are fulfilled
     *
     * @return self
     */
    final public static function instance(array $constraints)
    {

        $extensions = get_loaded_extensions();
        $classes = get_declared_classes();

        if($constraints['extensions']) {

            $commonExt = array_intersect($extensions, $constraints['extensions']);
            $missingExt = array_diff($constraints['extensions'], $commonExt);

            if(!empty($missingExt)) {
                throw new \Exception('Missing extensions: ' . implode(', ', $missingExt));                
            }

        }

        if($constraints['classes']) {

            $loadedClasses = array_intersect($classes, $constraints['classes']);
            $missingClasses = array_diff($constraints['classes'], $loadedClasses);

            if(!empty($missingClasses)) {
                throw new \Exception('Missing classes: ' . implode(', ', $missingClasses));                
            }

        }

        if(!self::$instance) {
            
            self::$instance = new self;  

        }
        
        return self::$instance;
    }

    /**
     * Prevents cloning the singleton instance.
     *
     * @return void
     */
    private function __clone() {}

    /**
     * Prevents unserializing the singleton instance.
     *
     * @return void
     */
    public function __wakeup() {}
}
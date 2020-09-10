<?php 
/**
 * 
 * call config
 */
require_once 'config/config.php';

/**
 * call autoload
 */
require_once BASEPATH.'public/vendor/autoload.php';

/**
 * 
 * auto call class
 */

spl_autoload_register(function ($class_name) {
    $class_name = explode('\\', $class_name);

    // Class folder name
    $sub="";
    $i = count($class_name)-2;
    if( in_array('Core',$class_name) || $i < 0 ){
        $sub = "/core";
    }

    // Class name
    $class_name = end($class_name);
    if(file_exists(__DIR__ . $sub .'/'. $class_name .'.php'))
        require_once __DIR__ . $sub .'/'. $class_name .'.php';

});
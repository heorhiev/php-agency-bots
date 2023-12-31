<?php

include 'paths.php';
include 'vendor/autoload.php';

spl_autoload_register(function($class) {

    $class = str_replace('\\', '/', $class);
	
	$path = '../' . $class . '.php';
	
	if (file_exists($path)) {
        require $path;
    }
});


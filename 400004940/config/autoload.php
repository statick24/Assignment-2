<?php
require_once "config.php";
spl_autoload_register(function ($class) {
    // Convert namespace to directory 
    $classFilePath = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    // Check if the class file exists in APP_DIR
    $classFile = APP_DIR . DIRECTORY_SEPARATOR . $classFilePath;
    if (file_exists($classFile)) {
        require_once $classFile;
        return;
    }

    // Check if the class file exists in FRAMEWORK_DIR
    $classFile = FRAMEWORK_DIR . DIRECTORY_SEPARATOR . $classFilePath;
    if (file_exists($classFile)) {
        require_once $classFile;
        return;
    }
});

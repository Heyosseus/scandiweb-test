<?php
require_once "../database/db.php";
require_once "../cors/CorsHandler.php";

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $classFile = __DIR__ . '/../' . $className . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});

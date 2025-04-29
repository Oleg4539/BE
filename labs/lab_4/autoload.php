<?php
spl_autoload_register(function ($class) { //урахування неймспейсу
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $path = __DIR__ . '/' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});
//автоматичне підключення класу без ручного пропису require

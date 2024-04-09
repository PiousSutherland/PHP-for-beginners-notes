<?php

const BASE_PATH = __DIR__ . '/../';

// Critical - leave at the top
require BASE_PATH . 'Core/functions.php';

spl_autoload_register(function ($class) {
    require base_path(str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php');
});

require base_path('Core/router.php');

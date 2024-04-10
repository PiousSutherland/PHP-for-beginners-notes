<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

$container->bind('Core\Database', fn() => new Database((require base_path('config.php'))['database']));

App::setContainer($container);
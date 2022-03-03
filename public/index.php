<?php

declare(strict_types=1);

spl_autoload_register(function($fqcn) {
    $path = str_replace('\\', '/', $fqcn);
    require_once (__DIR__.'/../'.$path.'.php');
});

$router = App\Routing\Router::getFromGlobals();
$router->getController();


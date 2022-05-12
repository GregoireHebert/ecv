<?php

spl_autoload_register(function (string $class) {
   $path = __DIR__ . '/../'.str_replace(['\\', 'App'], ['/', 'src'], $class).'.php';
   require_once($path);
});

use App\Infra\HttpFoundation\Request;
use App\Infra\HttpKernel;

$request = Request::createFromGlobals();

$kernel = new HttpKernel();
$kernel->handle($request);

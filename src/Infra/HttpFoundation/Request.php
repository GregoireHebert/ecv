<?php

declare(strict_types=1);

namespace App\Infra\HttpFoundation;

class Request
{
    private ?string $path = null;
    private array $get;

    protected function __construct(string $path, array $get)
    {
        $this->path = $path;
        $this->get = $get;
    }

    public static function createFromGlobals(): Request
    {
        return new self(
            $_SERVER['PATH_INFO'] ?? '/',
            $_GET
        );
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getQuery(string $name, $default = null)
    {
        return $this->get[$name] ?? $default;
    }
}

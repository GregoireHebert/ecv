<?php

declare(strict_types=1);

namespace App\Infra\Memory;

class IniLoader
{
    private array $files = [];

    public function loadFile(string $path)
    {
        if (!empty($this->files[base64_encode($path)])) {
            return $this->files[base64_encode($path)];
        }

        if (!file_exists($path)) {
            throw new \RuntimeException("file $path is not readable");
        }

        $this->files[base64_encode($path)] = explode(PHP_EOL, trim(file_get_contents($path)));
        return $this->files[base64_encode($path)];
    }
}

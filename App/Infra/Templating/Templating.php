<?php

declare(strict_types=1);

namespace App\Infra\Templating;

class Templating
{
    public function loadTemplate(string $path): void
    {
        require_once($path);
    }
}

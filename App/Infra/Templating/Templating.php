<?php

declare(strict_types=1);

namespace App\Infra\Templating;

class Templating
{
    public function loadTemplate(string $path, array $context): void
    {
        foreach ($context as $varName => $value) {
            $$varName = $value;
        }

        require_once($path);
    }
}

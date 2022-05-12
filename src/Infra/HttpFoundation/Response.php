<?php

declare(strict_types=1);

namespace App\Infra\HttpFoundation;

class Response
{
    private string $content = '';

    public function __construct(string $content = '')
    {
        $this->content = $content;
    }

    public function send()
    {
        echo $this->content;
    }
}

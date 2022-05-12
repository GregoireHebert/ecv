<?php

declare(strict_types=1);

namespace App\Infra\Repository;

use App\Infra\Memory\IniLoader;

class WordRepository
{
    const PATH = __DIR__ . '/../../../var/words';

    private IniLoader $loader;

    public function __construct()
    {
        $this->loader = new IniLoader();
    }

    public function getRandomWord(): string
    {
        $words = $this->loader->loadFile(self::PATH);

        shuffle($words);
        if ($value = reset($words)) {
            return $value;
        }

        throw new \RuntimeException('There are no words in memory');
    }
}

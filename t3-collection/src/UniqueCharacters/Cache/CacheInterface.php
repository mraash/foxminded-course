<?php

declare(strict_types=1);

namespace App\UniqueCharacters\Cache;

interface CacheInterface
{
    public function set(string $key, int $value): void;

    public function get(string $key): int;

    public function hasKey(string $key): bool;
}

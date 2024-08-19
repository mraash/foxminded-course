<?php

declare(strict_types=1);

namespace App\UniqueCharacters\Cache;

class ArrayCache implements CacheInterface
{
    /** @var array<string,int> */
    private array $cache = [];

    public function set(string $key, int $value): void
    {
        $this->cache[$key] = $value;
    }

    public function get(string $key): int
    {
        if (!$this->hasKey($key)) {
            throw new \Exception('Trying to get undefined value');
        }

        return $this->cache[$key];
    }

    public function hasKey(string $key): bool
    {
        return isset($this->cache[$key]);
    }
}

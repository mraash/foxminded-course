<?php

declare(strict_types=1);

namespace App\UniqueCharacters\Cache;

use Ds\Map;

class MapCache implements CacheInterface
{
    /** @var Map<string,int> */
    private Map $map;

    public function __construct()
    {
        $this->map = new Map();
    }

    public function set(string $key, int $value): void
    {
        $this->map->put($key, $value);
    }

    public function get(string $key): int
    {
        if (!$this->hasKey($key)) {
            throw new \Exception('Trying to get undefined value');
        }

        return $this->map->get($key);
    }

    public function hasKey(string $key): bool
    {
        return $this->map->hasKey($key);
    }
}

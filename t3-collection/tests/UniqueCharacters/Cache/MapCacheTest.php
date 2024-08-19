<?php

namespace Tests\UniqueCharacters\Cache;

use App\UniqueCharacters\Cache\CacheInterface;
use App\UniqueCharacters\Cache\MapCache;

class MapCacheTest extends AbstractCacheTest
{
    protected function getCache(): CacheInterface
    {
        return new MapCache();
    }
}

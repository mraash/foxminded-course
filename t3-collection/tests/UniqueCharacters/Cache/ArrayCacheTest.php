<?php

namespace Tests\UniqueCharacters\Cache;

use App\UniqueCharacters\Cache\CacheInterface;
use App\UniqueCharacters\Cache\ArrayCache;

class ArrayCacheTest extends AbstractCacheTest
{
    protected function getCache(): CacheInterface
    {
        return new ArrayCache();
    }
}

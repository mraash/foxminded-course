<?php

declare(strict_types=1);

namespace Tests\UniqueCharacters\Cache;

use PHPUnit\Framework\TestCase;
use App\UniqueCharacters\Cache\CacheInterface;

abstract class AbstractCacheTest extends TestCase
{
    public function testKeyChecker(): void
    {
        $cache = $this->getCache();

        self::assertFalse($cache->hasKey('key'));
        $cache->set('key', 1);
        self::assertTrue($cache->hasKey('key'));
    }

    public function testGetter(): void
    {
        $cache = $this->getCache();

        $cache->set('key', 1);
        self::assertSame(1, $cache->get('key'));
    }

    public function testGetterWithUndefinedKey(): void
    {
        $this->expectException(\Exception::class);

        $this->getCache()->get('unknow_key');
    }

    public function testSetterThatRewrites(): void
    {
        $cache = $this->getCache();

        $cache->set('key', 1);
        $cache->set('key', 2);

        self::assertSame(2, $cache->get('key'));
    }


    abstract protected function getCache(): CacheInterface;
}

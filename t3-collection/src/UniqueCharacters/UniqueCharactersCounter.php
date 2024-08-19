<?php

declare(strict_types=1);

namespace App\UniqueCharacters;

use App\UniqueCharacters\Cache\CacheInterface;
use App\UniqueCharacters\Cache\ArrayCache;

class UniqueCharactersCounter
{
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache = null)
    {
        $this->cache = $cache ?? new ArrayCache();
    }

    public function count(string $string): int
    {
        if ($this->cache->hasKey($string)) {
            return $this->cache->get($string);
        }

        $result = self::getUniqueCharacters($string);

        $this->cache->set($string, $result);

        return $result;
    }

    private static function getUniqueCharacters(string $string): int
    {
        if ($string === '') {
            return 0;
        }

        $counted = self::countCharacters($string);

        $uniqueCharacters = 0;

        foreach ($counted as $character => $total) {
            if ($total === 1) {
                $uniqueCharacters++;
            }
        }

        return $uniqueCharacters;
    }

    /**
     * @return array<string,int>  An array where key is a character and value
     *   is the total nuber of such characters in the given string
     */
    private static function countCharacters(string $string): array
    {
        if ($string === '') {
            return [];
        }

        $characters = str_split($string);
        $counted    = [];

        foreach ($characters as $character) {
            $counted[$character] = isset($counted[$character]) ? $counted[$character] + 1 : 1;
        }

        return $counted;
    }
}

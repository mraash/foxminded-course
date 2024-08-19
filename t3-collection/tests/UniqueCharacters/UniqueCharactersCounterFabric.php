<?php

declare(strict_types=1);

namespace Tests\UniqueCharacters;

use App\UniqueCharacters\UniqueCharactersCounter;

class UniqueCharactersCounterFabric
{
    public static function count(string $str): int
    {
        $counter = new UniqueCharactersCounter();
        return $counter->count($str);
    }
}

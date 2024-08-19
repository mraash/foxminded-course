<?php

declare(strict_types=1);

use App\UniqueCharacters\Cache\ArrayCache;
use App\UniqueCharacters\Cache\MapCache;
use App\UniqueCharacters\UniqueCharactersCounter;

require_once __DIR__ . '/../vendor/autoload.php';


echo (new UniqueCharactersCounter(new ArrayCache()))->count('abbbccdf');

echo PHP_EOL;

echo (new UniqueCharactersCounter(new MapCache()))->count('abbbccdf');

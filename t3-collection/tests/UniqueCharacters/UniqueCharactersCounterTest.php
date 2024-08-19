<?php

declare(strict_types=1);

namespace Tests\UniqueCharacters;

use PHPUnit\Framework\TestCase;
use App\UniqueCharacters\UniqueCharactersCounter;

/**
 * @covers \App\UniqueCharacters\UniqueCharactersCounter
 */
class UniqueCharactersCounterTest extends TestCase
{
    /**
     * @dataProvider provideSimpleData
     */
    public function testMainMethod(int $expectedOutput, string $input): void
    {
        $output = UniqueCharactersCounterFabric::count($input);

        self::assertSame($expectedOutput, $output);
    }

    public function provideSimpleData(): array
    {
        return [
            'data_1' => [ 3, 'abbbccdf' ],
            'data_2' => [ 2, 'abc1cb' ],
            'empty'  => [ 0, '' ],
        ];
    }

    /**
     * @dataProvider provideSingleString
     */
    public function testThatCacheDidntBrokeSomething(string $input): void
    {
        $counter = new UniqueCharactersCounter();

        $result1 = $counter->count($input);
        $result2 = $counter->count($input);

        self::assertSame($result1, $result2);
    }

    public function provideSingleString(): array
    {
        return [
            ['abcb'],
            ['aabbccd'],
        ];
    }
}

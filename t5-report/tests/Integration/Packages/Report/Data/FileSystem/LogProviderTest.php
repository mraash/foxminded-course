<?php

declare(strict_types=1);

namespace Tests\Integration\Packages\Report\Data\FileSystem;

use Tests\TestCase;
use Tests\Mocks\Packages\Report\Libs\File\FileMock;
use App\Packages\Report\Data\FileSystem\Exceptions\DataConflictException;
use App\Packages\Report\Data\FileSystem\LogProvider;

class LogProviderTest extends TestCase
{
    public function setUp(): void
    {
        FileMock::clearFakeContent();
    }

    public function tearDown(): void
    {
        FileMock::clearFakeContent();
    }

    public function testLenghException(): void
    {
        FileMock::setFakeContent(
            'path-to/start.log',
            "AAA2018-01-01_00:00:00.000\n"
            . "BBB2018-01-01_00:00:00.000\n"
        );

        FileMock::setFakeContent(
            'path-to/end.log',
            "AAA2018-01-01_00:00:00.000\n"
        );

        FileMock::setFakeContent(
            'path-to/abbreviations.txt',
            "AAA_Name_Car\n"
        );

        $this->expectException(DataConflictException::class);

        new LogProvider(
            new FileMock('path-to/start.log'),
            new FileMock('path-to/end.log'),
            new FileMock('path-to/abbreviations.txt')
        );
    }

    public function testAbbreviationException(): void
    {
        FileMock::setFakeContent(
            'path-to/start.log',
            "AAA2018-01-01_00:00:00.000\n"
            . "BBB2018-01-01_00:00:00.000\n"
        );

        FileMock::setFakeContent(
            'path-to/end.log',
            "AAA2018-01-01_00:00:00.000\n"
            . "BBB2018-01-01_00:00:00.000\n"
        );

        FileMock::setFakeContent(
            'path-to/abbreviations.txt',
            "AAA_Name_Car\n"
            . "CCC_Name_Car\n"
        );

        $this->expectException(DataConflictException::class);

        new LogProvider(
            new FileMock('path-to/start.log'),
            new FileMock('path-to/end.log'),
            new FileMock('path-to/abbreviations.txt')
        );
    }
}

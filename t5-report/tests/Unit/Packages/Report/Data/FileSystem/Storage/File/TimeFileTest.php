<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Data\FileSystem\Storage\File;

use Tests\TestCase;
use App\Packages\Report\Data\FileSystem\Storage\File\Exceptions\TimeFileFormatException;
use App\Packages\Report\Data\FileSystem\Storage\File\TimeFile;
use Tests\Mocks\Packages\Report\Libs\File\FileMock;

class TimeFileTest extends TestCase
{
    public function setUp(): void
    {
        FileMock::clearFakeContent();
    }

    public function tearDown(): void
    {
        FileMock::clearFakeContent();
    }

    /**
     * @dataProvider provideInvalidFormatContent
     */
    public function testFileFormatException(string $content): void
    {
        FileMock::setFakeContent('filename', $content);
        $file = new FileMock('filename');

        $this->expectException(TimeFileFormatException::class);

        new TimeFile($file);
    }

    /**
     * @return array<string[]>
     */
    public function provideInvalidFormatContent(): array
    {
        return [
            ['afasdf'],
            ['aaaS2000-00-00_00:00:00.0000'],
            ['bb2000-00-00_00:00:00.000'],
            ['cccc2000-00-00_00:00:00.000'],
        ];
    }
}

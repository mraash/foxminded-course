<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Data\FileSystem\Storage\File;

use Tests\TestCase;
use App\Packages\Report\Data\FileSystem\Storage\File\AbbreviationFile;
use App\Packages\Report\Data\FileSystem\Storage\File\Exceptions\AbbreviationFileFormatException;
use Tests\Mocks\Packages\Report\Libs\File\FileMock;

class AbbreviationFileTest extends TestCase
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

        $this->expectException(AbbreviationFileFormatException::class);

        new AbbreviationFile($file);
    }

    /**
     * @return array<string[]>
     */
    public function provideInvalidFormatContent(): array
    {
        return [
            ['afasdf'],
            ['afasdf_fasdf'],
            ['sadfa_sadfas_fasdf_'],
        ];
    }
}

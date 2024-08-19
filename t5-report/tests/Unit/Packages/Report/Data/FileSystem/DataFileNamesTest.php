<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Data\FileSystem;

use Tests\TestCase;
use App\Packages\Report\Data\FileSystem\DataFileNames;

class DataFileNamesTest extends TestCase
{
    private DataFileNames $names;

    public function setUp(): void
    {
        $this->names = new DataFileNames();
    }

    public function tearDown(): void
    {
        unset($this->names);
    }

    public function testDefaultValued(): void
    {
        $this->assertSame('', $this->names->getStartFilePath());
        $this->assertSame('', $this->names->getEndFilePath());
        $this->assertSame('', $this->names->getAbbreviationFilePath());
    }

    public function testWithSetters(): void
    {
        $this->names->setFolder('folder');
        $this->names->setStartFilename('s.log');
        $this->names->setEndFilename('e.log');
        $this->names->setAbbreviationFilename('a.log');

        $this->assertSame('folder' . DIRECTORY_SEPARATOR . 's.log', $this->names->getStartFilePath());
        $this->assertSame('folder' . DIRECTORY_SEPARATOR . 'e.log', $this->names->getEndFilePath());
        $this->assertSame('folder' . DIRECTORY_SEPARATOR . 'a.log', $this->names->getAbbreviationFilePath());
    }

    public function testFolderEndSlash(): void
    {
        $names1 = new DataFileNames();
        $names2 = new DataFileNames();

        $names1->setFolder('folder');
        $names2->setFolder('folder' . DIRECTORY_SEPARATOR);

        $this->assertSame($names1->getStartFilePath(), $names2->getStartFilePath());
    }

    public function testChainSyntax(): void
    {
        $this->assertInstanceOf(DataFileNames::class, DataFileNames::construct());
        $this->assertInstanceOf(DataFileNames::class, $this->names->setFolder('folder'));
        $this->assertInstanceOf(DataFileNames::class, $this->names->setStartFilename('file'));
        $this->assertInstanceOf(DataFileNames::class, $this->names->setEndFilename('file'));
        $this->assertInstanceOf(DataFileNames::class, $this->names->setAbbreviationFilename('file'));
    }
}

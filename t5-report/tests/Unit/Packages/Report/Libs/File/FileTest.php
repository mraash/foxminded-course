<?php

declare(strict_types=1);

namespace Tests\Unit\Packages\Report\Libs\File;

use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\vfsStreamFile;
use Tests\TestCase;
use App\Packages\Report\Libs\File\Exceptions\NonExistingFileException;
use App\Packages\Report\Libs\File\File;

class FileTest extends TestCase
{
    private vfsStreamFile $virtualFile;

    public function setUp(): void
    {
        $virtualDirectory = vfsStream::setup('some-dir');
        $virtualFile      = vfsStream::newFile('some-file.txt');

        $virtualDirectory->addChild($virtualFile);

        $this->virtualFile = $virtualFile;
    }

    public function testAllInExistinig(): void
    {
        $this->virtualFile->withContent('File content');

        $file = new File($this->virtualFile->url());

        $this->assertSame('File content', $file->getContent());
        $this->assertSame($this->virtualFile->url(), $file->getFilePath());
    }

    public function testExceptionIfNotExists(): void
    {
        $this->expectException(NonExistingFileException::class);

        new File('random-name-dsaiof902i439jdofkas.tttttt');
    }
}

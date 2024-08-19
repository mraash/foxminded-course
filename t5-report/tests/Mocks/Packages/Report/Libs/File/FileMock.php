<?php

declare(strict_types=1);

namespace Tests\Mocks\Packages\Report\Libs\File;

use App\Packages\Report\Libs\File\Exceptions\NonExistingFileException;
use App\Packages\Report\Libs\File\File;

class FileMock extends File
{
    /** @var array<string,string> */
    private static array $fakeContents = [];

    public function getContent(): string
    {
        if (!$this->exists()) {
            throw new NonExistingFileException($this->filePath);
        }

        return self::$fakeContents[$this->getFilePath()];
    }

    protected function exists(): bool
    {
        return isset(self::$fakeContents[$this->filePath]);
    }

    public static function setFakeContent(string $filename, string $content): void
    {
        self::$fakeContents[$filename] = $content;
    }

    public static function clearFakeContent(): void
    {
        self::$fakeContents = [];
    }
}

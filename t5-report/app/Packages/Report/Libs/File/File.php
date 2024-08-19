<?php

declare(strict_types=1);

namespace App\Packages\Report\Libs\File;

use App\Packages\Report\Libs\File\Exceptions\NonExistingFileException;

class File
{
    protected string $filePath;

    /**
     * @param string $filePath  Either relative path from working directory or absolute path.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        if (!$this->exists()) {
            throw new NonExistingFileException($this->filePath);
        }
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getContent(): string
    {
        $content = file_get_contents($this->filePath);

        if ($content === false) {
            throw new NonExistingFileException($this->filePath);
        }

        return $content;
    }

    protected function exists(): bool
    {
        return file_exists($this->filePath);
    }
}

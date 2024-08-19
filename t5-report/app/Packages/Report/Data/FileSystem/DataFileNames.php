<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

/**
 * Helper class for DataProvider. It contains name of each data file (start, end, abbreviation).
 *
 * It can be helpful when file names are dynamic (for example start and end file are set by default,
 *   but abbreviations file sets user).
 */
class DataFileNames
{
    /**
     * Folder that conatain start, end and abbreviation files.
     */
    private string $folder = '';

    private string $startFilename = '';
    private string $endFilename = '';
    private string $abbreviationFilename = '';

    /**
     * Method for prettier chaining syntax. So you can go DataFileNames::construct()->set1()->set2()
     *   instead of (new DataFileNames())->set1()->set2().
     */
    public static function construct(): DataFileNames
    {
        return new self();
    }

    public function setFolder(string $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function setStartFilename(string $filename): self
    {
        $this->startFilename = $filename;

        return $this;
    }

    public function setEndFilename(string $filename): self
    {
        $this->endFilename = $filename;

        return $this;
    }

    public function setAbbreviationFilename(string $filename): self
    {
        $this->abbreviationFilename = $filename;

        return $this;
    }

    public function getStartFilePath(): string
    {
        return self::addEndingSlashToFolder($this->folder) . $this->startFilename;
    }

    public function getEndFilePath(): string
    {
        return self::addEndingSlashToFolder($this->folder) . $this->endFilename;
    }

    public function getAbbreviationFilePath(): string
    {
        return self::addEndingSlashToFolder($this->folder) . $this->abbreviationFilename;
    }

    /**
     * If there is no slash at the end of the $folder, add one.
     */
    private static function addEndingSlashToFolder(string $folder): string
    {
        if ($folder === '') {
            return $folder;
        }

        if (preg_match('/(\\\|\/)$/', $folder)) {
            return $folder;
        }

        return $folder . DIRECTORY_SEPARATOR;
    }
}

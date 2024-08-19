<?php

declare(strict_types=1);

namespace App\Packages\Report\Data\FileSystem;

use App\Packages\Report\Data\FileSystem\Exceptions\DataConflictException;
use App\Packages\Report\Data\FileSystem\Storage\File\AbbreviationFile;
use App\Packages\Report\Data\FileSystem\Storage\File\TimeFile;
use App\Packages\Report\Libs\File\File;

/**
 * Class that encapsulates log objects creation.
 */
class LogProvider
{
    private TimeLog $startLog;
    private TimeLog $endLog;
    private AbbreviationLog $abbriviationsLog;

    public function __construct(
        File $start,
        File $end,
        File $abbreviation,
        LogValidator $logValidator = null
    ) {
        $logValidator = $logValidator ?? new LogValidator();

        $startFile         = new TimeFile($start);
        $endFile           = new TimeFile($end);
        $abbriviationsFile = new AbbreviationFile($abbreviation);

        $this->startLog         = new TimeLog($startFile->getData());
        $this->endLog           = new TimeLog($endFile->getData());
        $this->abbriviationsLog = new AbbreviationLog($abbriviationsFile->getData());

        $logValidator->validate($this->startLog, $this->endLog, $this->abbriviationsLog);
    }

    public static function fromFileNamesObject(DataFileNames $names): self
    {
        return new self(
            new File($names->getStartFilePath()),
            new File($names->getEndFilePath()),
            new File($names->getAbbreviationFilePath())
        );
    }

    public function getStartLog(): TimeLog
    {
        return $this->startLog;
    }

    public function getEndLog(): TimeLog
    {
        return $this->endLog;
    }

    public function getAbbreviationLog(): AbbreviationLog
    {
        return $this->abbriviationsLog;
    }
}

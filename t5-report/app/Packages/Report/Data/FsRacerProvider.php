<?php

declare(strict_types=1);

namespace App\Packages\Report\Data;

use App\Packages\Report\Data\FileSystem\DataFileNames;
use App\Packages\Report\Data\FileSystem\LogProvider;
use App\Packages\Report\Data\FileSystem\LogValidator;
use App\Packages\Report\Racers\RacerCollection;

/**
 * Class that provider racers from file system.
 */
class FsRacerProvider implements RacerProviderInterface
{
    public function provide(): RacerCollection
    {
        return $this->provideByCustomFileNames(new DataFileNames());
    }

    public function provideByCustomFileNames(DataFileNames $dataFileNames): RacerCollection
    {
        $logValidator = new LogValidator();
        $logProvider = LogProvider::fromFileNamesObject($dataFileNames);

        $startLog = $logProvider->getStartLog();
        $endLog = $logProvider->getEndLog();
        $abbreviationLog = $logProvider->getAbbreviationLog();

        $logValidator->validate($startLog, $endLog, $abbreviationLog);

        $racerCollection = new RacerCollection();

        foreach ($startLog->getAllLines() as $startLogItem) {
            $abbreviationLogItem = $abbreviationLog->findByAbbreviation($startLogItem->abbreviation);
            $endLogItem = $endLog->findByAbbreviation($startLogItem->abbreviation);

            $abbreviation = $startLogItem->abbreviation;
            $fullName     = $abbreviationLogItem->fullName;
            $car          = $abbreviationLogItem->car;
            $start        = $startLogItem->dateTime;
            $end          = $endLogItem->dateTime;

            $racerCollection->add($abbreviation, $fullName, $car, $start, $end);
        }

        $racerCollection->freeze();

        return $racerCollection;
    }
}

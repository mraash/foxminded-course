<?php

declare(strict_types=1);

namespace App\Packages\Report\DataTranfer;

use App\Models\Racer as RacerModel;
use App\Packages\Report\Data\FileSystem\DataFileNames;
use App\Packages\Report\Data\FsRacerProvider;

/**
 * Class that saves data form the file system to the database
 */
class FileSystemTransferer
{
    public function saveToDatabase(DataFileNames $dataFileNames = null): void
    {
        $dataFileNames = $dataFileNames ?? new DataFileNames();

        $racers = (new FsRacerProvider())->provideByCustomFileNames($dataFileNames);

        foreach ($racers as $racer) {
            // Some laravel problems :(
            /** @phpstan-ignore-next-line */
            RacerModel::create([
                'abbreviation' => $racer->getAbbreviation(),
                'full_name' => $racer->getFullName(),
                'car' => $racer->getCar(),
                'best_time_start' => $racer->getBestTimeStart()->format('Y-m-d H:i:s.v'),
                'best_time_end' => $racer->getBestTimeEnd()->format('Y-m-d H:i:s.v'),
            ]);
        }
    }
}

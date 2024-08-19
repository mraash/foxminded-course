<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Packages\Report\Data\FileSystem\DataFileNames;
use Exception;
use App\Packages\Report\DataTranfer\FileSystemTransferer;

class DataTransferCommand extends AbstractCommand
{
    /** @var string */
    protected $signature = 'app:data-transfer';

    /** @var string */
    protected $description = 'Command to transfer data from the file system to the database';

    public function handle(DataFileNames $dataFileNames): int
    {
        try {
            $transferer = new FileSystemTransferer();
            $transferer->saveToDatabase($dataFileNames);
        } catch (Exception $err) {
            $this->writeErrorBlock($err->getMessage());
            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}

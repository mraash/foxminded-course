<?php

declare(strict_types=1);

namespace App\Packages\Report\Racers\Exceptions;

use App\Packages\Report\Racer\Racer;
use Exception;

class TooLongBestTimeException extends Exception
{
    public function __construct(string $name, string $abbreviation)
    {
        parent::__construct("Best time of racer \"{$name} ({$abbreviation})\" is too long");
    }
}

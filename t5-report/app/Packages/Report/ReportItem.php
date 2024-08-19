<?php

declare(strict_types=1);

namespace App\Packages\Report;

use App\Packages\Report\Racers\Racer;

class ReportItem
{
    public function __construct(
        public int $position,
        public Racer $racer
    ) {
    }
}

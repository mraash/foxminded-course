<?php

declare(strict_types=1);

namespace App\Packages\Report\Data;

use App\Packages\Report\Racers\RacerCollection;

interface RacerProviderInterface
{
    public function provide(): RacerCollection;
}

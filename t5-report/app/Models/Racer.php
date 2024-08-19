<?php

declare(strict_types=1);

namespace App\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\NullAttributeException;

class Racer extends Model
{
    protected $fillable = [
        'abbreviation',
        'full_name',
        'car',
        'best_time_start',
        'best_time_end',
    ];

    public function getAbbreviation(): string
    {
        return $this->abbreviation ?? throw new NullAttributeException('abbreviation');
    }

    public function getFullName(): string
    {
        return $this->full_name ?? throw new NullAttributeException('full_name');
    }

    public function getCar(): string
    {
        return $this->car ?? throw new NullAttributeException('car');
    }

    public function getBestTimeStart(): DateTimeImmutable
    {
        $bestTimeStart = $this->best_time_start ?? throw new NullAttributeException('best_time_start');

        return new DateTimeImmutable($bestTimeStart);
    }

    public function getBestTimeEnd(): DateTimeImmutable
    {
        $bestTimeEnd = $this->best_time_end ?? throw new NullAttributeException('best_time_end');

        return new DateTimeImmutable($bestTimeEnd);
    }
}

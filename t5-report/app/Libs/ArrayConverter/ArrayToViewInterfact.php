<?php

declare(strict_types=1);

namespace App\Libs\ArrayConverter;

interface ArrayToViewInterfact
{
    /**
     * @param mixed[] $array
     */
    public function encode(array $array): string;
}

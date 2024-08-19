<?php

declare(strict_types=1);

namespace App\Libs\ArrayConverter;

use InvalidArgumentException;

class ArrayConverterFactory
{
    public function build(string $format): ArrayToViewInterfact
    {
        return match ($format) {
            'xml' => new ArrayToSimpleXml(),
            'json' => new ArrayToJson(),
            default => throw new InvalidArgumentException("Wrong format '$format'"),
        };
    }
}

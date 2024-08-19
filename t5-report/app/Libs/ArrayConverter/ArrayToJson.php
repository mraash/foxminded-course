<?php

declare(strict_types=1);

namespace App\Libs\ArrayConverter;

use App\Exceptions\InvalidReturnException;

class ArrayToJson implements ArrayToViewInterfact
{
    /**
     * @inheritdoc
     */
    public function encode(array $array): string
    {
        $result = json_encode($array);

        if ($result === false) {
            throw new InvalidReturnException();
        }

        return $result;
    }
}

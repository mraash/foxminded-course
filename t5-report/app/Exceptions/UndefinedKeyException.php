<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class UndefinedKeyException extends Exception
{
    public function __construct(string|int $keyName)
    {
        $message = "Undefined array key '$keyName'";

        parent::__construct($message);
    }
}

<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

class NullAttributeException extends Exception
{
    public function __construct(string $attribute)
    {
        parent::__construct("Null attribute '$attribute'");
    }
}

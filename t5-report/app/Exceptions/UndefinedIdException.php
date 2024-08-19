<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Exception for cases when there is a selection by non-existing id of domain object.
 */
class UndefinedIdException extends Exception
{
    public function __construct(string $message = null)
    {
        $message = $message ?? 'Trying to find domain object by undefined id';

        parent::__construct($message);
    }
}

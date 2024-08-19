<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;

/**
 * Exception for classes that has methods like 'freeze', 'forbidSomethig', 'disable', ect.
 */
class FreezenObjectActivityException extends Exception
{
    public function __construct()
    {
        $message = 'Trying to do something with freezen object';

        parent::__construct($message);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Pages;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller as BaseController;

abstract class Controller extends BaseController
{
    /**
     * @param array<string,mixed> $data
     */
    public function makeView(string $viewPath, array $data = []): View
    {
        /**
         * @var View
         * @phpstan-ignore-next-line (ignore view-string type error)
         */
        return view($viewPath, $data);
    }
}

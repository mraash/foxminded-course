<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    /**
     * @param array<string,mixed> $headers
     */
    public function makeResponse(string $content, int $status = 200, array $headers = []): Response
    {
        /** @var Response */
        return response($content, $status, $headers);
    }

    public function makeRedirector(): Redirector
    {
        /** @var Redirector */
        return redirect();
    }
}

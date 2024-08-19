<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use App\Exceptions\InvalidReturnException;

abstract class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function __construct()
    {
    }

    /**
     * @param mixed[] $headers
     */
    protected function makeResponse(string $body, int|null $status, array $headers = []): Response
    {
        $status = $status ?? 200;
        $response = response($body, $status, $headers);

        if (!($response instanceof Response)) {
            throw new InvalidReturnException();
        }

        return $response;
    }

    /**
     * @param mixed[] $data
     */
    protected function makeView(string $path, array $data = []): View
    {
        $view = view($path, $data);

        if (!($view instanceof View)) {
            throw new InvalidReturnException();
        }

        return $view;
    }
}

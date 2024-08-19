<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

abstract class AbstractController extends Controller
{
    protected ResponseWrapper $responseWrapper;

    public function __construct()
    {
        parent::__construct();

        $this->responseWrapper = new ResponseWrapper();
    }
}

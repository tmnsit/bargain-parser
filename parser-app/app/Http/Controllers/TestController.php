<?php

namespace App\Http\Controllers;

use App\Services\FetchBargainService;
use App\Services\ParseBargainService;
use DiDom\Exceptions\InvalidSelectorException;



class TestController extends Controller
{
    /**
     * @throws InvalidSelectorException
     */
    public function index(ParseBargainService $bargainService, FetchBargainService $fetcher)
    {

        $data = $bargainService->handle();

        dd($data);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Bargain;
use App\Services\FetchBargainService;
use App\Services\ParseBargainService;
use DiDom\Exceptions\InvalidSelectorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DiDom\Document;

class TestController extends Controller
{
    /**
     * @throws InvalidSelectorException
     */
    public function index(ParseBargainService $bargainService)
    {
        $data = $bargainService->handle();

        dd($data);
    }
}

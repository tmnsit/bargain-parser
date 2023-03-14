<?php

namespace App\Http\Controllers;

use App\Models\Bargain;
use App\Services\FetchBargainService;
use App\Services\ParseBargainService;
use DiDom\Exceptions\InvalidSelectorException;
use Symfony\Component\HttpFoundation\Response;


class TestController extends Controller
{
    /**
     * @throws InvalidSelectorException
     */
    public function index(ParseBargainService $bargainService, FetchBargainService $fetcher)
    {

//        $data = $bargainService->handle(1);
        $data = $fetcher->fetchHtmlList(2);
        dd($data);
    }

    public function getAll()
    {
        $bargains = Bargain::query()->paginate(15);
        return response()->json($bargains);
    }
}

<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class FetchBargainService
{

    public function fetchHtmlList(int $pageNum = 1): string
    {
        $url = config('services.auction.url') . config('services.auction.path_list');
        $pageNum = 1;
        $response = Http::get($url, [
            'page' => $pageNum
        ]);
        return $response->body();
    }

    public function fetchHtmlDetailForId(int $id): string
    {
        $url = config('services.auction.url') . config('services.auction.path_detail');
        $response = Http::get($url, [
            'id' => $id
        ]);
        return $response->body();
    }

    public function fetchLots($id) :string
    {
        $url = config('services.auction.url') .  config('services.auction.path_lot');
        $response = Http::get($url, [
            'perspective' => 'inline',
            'id' => $id
        ]);
        return $response->body();
    }

    public function fetchFiles($id) :string
    {
        $url = config('services.auction.url') .  config('services.auction.path_files');
        $response = Http::get($url, [
            'perspective' => 'inline',
            'id' => $id
        ]);
        return $response->body();
    }

}

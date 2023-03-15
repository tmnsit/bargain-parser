<?php

namespace App\Http\Controllers;

use App\Models\Bargain;



class TestController extends Controller
{

    public function getAll()
    {
        $bargains = Bargain::query()->paginate(15);
        return response()->json($bargains);
    }
}

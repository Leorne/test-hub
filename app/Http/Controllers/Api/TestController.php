<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Test;

class TestController extends Controller
{
    /**
     * @param Test $test
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Test $test)
    {
        return response()->json($test);
    }

    public function start(Test $test)
    {
        dd('test started');
    }
}

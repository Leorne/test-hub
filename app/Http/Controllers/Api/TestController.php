<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestVersion;
use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    public function index(){
        $result = TestVersion::find(10);
        return response()->json($result);
    }


    public function show(Test $test)
    {
        return response()->json($test);
    }

    public function start(Test $test)
    {
        dd('test started');
    }
}

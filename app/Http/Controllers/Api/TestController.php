<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Test\TestCreateRequest;
use App\Models\TestVersion;
use App\Models\Test;
use App\Services\TestService;

class TestController extends Controller
{
    protected $testService;

    public function __construct(TestService $testService)
    {
        $this->testService = $testService;
    }

    public function index()
    {
        $result = TestVersion::find(10);
        return response()->json($result);
    }


    public function show(Test $test)
    {
        return response()->json($test);
    }

    /**
     * @param TestCreateRequest $request
     */
    public function store(TestCreateRequest $request)
    {
        $request->validated();
//        dd($request->all());
        $this->testService->create($request);
    }

    public function start(Test $test)
    {
        dd('test started');
    }
}

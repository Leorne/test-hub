<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TestHistory;
use App\Models\Test;
use App\Models\TestVersion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestHistoryController extends Controller
{
    public function store(Test $test, TestVersion $version)
    {
        $history = TestHistory::create([
//            'user_id' => auth()->id(),
            'test_id' => $test->id,
            'version_id' => $version->id,
            'start' => Carbon::now(),
        ]);
        return response()->json($history->id);
    }

    public function update(Request $request, Test $test, TestVersion $version)
    {
        $history = TestHistory::where([
            'test_id' => $test->id,
            'version_id' => $version->id
        ])->first();
        $history->end = Carbon::now();
        $history->save();
    }
}

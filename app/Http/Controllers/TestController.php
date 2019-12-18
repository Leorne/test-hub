<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use App\Tag;
use App\Test;
use App\TestTag;
use App\TestVersion;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tests = Test::all();
        return view('test.index', compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('test.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'about' => 'string|nullable',
            'questions' => 'required',
            'timer' => 'integer|max:180|nullable',
            'full_result' => 'boolean|nullable'
        ]);

        $inputData = $request->input();

        //Create test data
        $test = Test::create([
            'title' => $inputData['title'],
            'about' => $inputData['about'],
            'timer' => $inputData['timer'],
            'full_result' => $inputData['full_result'],
        ])->fresh();

        //Create tags data
        foreach ($inputData['tags'] as $tag) {
            if (isset($tag['id'])) {
                TestTag::create([
                    'test_id' => $test->id,
                    'tag_id' => $tag['id'],
                ]);
            } else {
                $tag = Tag::create([
                    'value' => $tag['value']
                ]);
                TestTag::create([
                    'test_id' => $test->id,
                    'tag_id' => $tag->id,
                ]);
            }
        }

        //Create questions. And answers for each
        foreach ($inputData['questions'] as $newQuestionData) {
            $question = Question::create([
                'test_version_id' => $test->version->id,
                'question_body' => $newQuestionData['question_body'],
                'question_type' => $newQuestionData['question_type'],
                'question_points' => $newQuestionData['question_points'],
            ]);
            Answer::create([
                'question_id' => $question->id,
                'answer_data' => $newQuestionData['answer_data'],
            ]);
        }
        return response([], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return view('test.show', compact($test));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        return view('test.new', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'title' => 'required|max:255',
            'about' => 'string|nullable',
            'questions' => 'required',
            'timer' => 'integer|max:180|nullable',
            'full_result' => 'boolean|nullable',
            'newVersion' => 'boolean'
        ]);

        $inputData = $request->input();

        $test->update([
            'title' => $inputData['title'],
            'about' => $inputData['about'],
            'timer' => $inputData['timer'],
            'full_result' => $inputData['full_result'],
        ]);


        //Data for destroy old relations
        $newTagsId = [];
        $oldTagsId = [];
        $oldTags = TestTag::where('test_id', $test->id)->get();
        foreach ($oldTags as $tag) {
            $oldTagsId[] = $tag->tag_id;
        }

        //Update tags
        foreach ($inputData['tags'] as $tag) {
            if (isset($tag['id'])) {
                $newTagsId[] = TestTag::firstOrCreate([
                    'test_id' => $test->id,
                    'tag_id' => $tag['id']
                ])->tag_id;
            } else {
                $newTag = Tag::firstOrCreate([
                    'value' => $tag['value']
                ]);
                $newTagsId[] = TestTag::firstOrCreate([
                    'test_id' => $test->id,
                    'tag_id' => $newTag->id,
                ])->tag_id;
            }
        }

        //Delete old tags relation, that has been removed from test
        $tagsForDeleting = array_diff($oldTagsId, $newTagsId);
        TestTag::where('test_id', $test->id)->whereIn('tag_id', $tagsForDeleting)->delete();

        //Create new test questions version
        $version = TestVersion::create([
            'test_id' => $test->id,
        ]);

        //if user edit questions
        if ($inputData['newVersion']){
            //Create new version test questions. And answers for each
            foreach ($inputData['questions'] as $newQuestionData) {
                $question = Question::create([
                    'test_version_id' => $version->id,
                    'question_body' => $newQuestionData['question_body'],
                    'question_type' => $newQuestionData['question_type'],
                    'question_points' => $newQuestionData['question_points'],
                ]);
                Answer::create([
                    'question_id' => $question->id,
                    'answer_data' => $newQuestionData['answer_data'],
                ]);
            }
        }
        return response(200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Test $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        //
    }
}

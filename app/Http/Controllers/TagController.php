<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return response($tags);
    }
}

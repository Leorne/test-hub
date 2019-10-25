<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags = Tag::all();
        return response($tags);
    }
}

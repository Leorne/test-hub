@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($tests as $test)
                    <div class="card my-2">
                        <div class="card-header d-flex justify-content-between">
                            <div class="">
                                {{ $test->title }}
                            </div>
                            <div>
                                <div class="text-right">
                                    <a class="btn btn-success btn-sm" href="{{ route('test.show', $test->id) }}">Try to pass</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('test.edit', $test->id) }}">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="{{ route('test.show', $test->id) }}">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            Tags:
                            @foreach($test->tags as $tag)
                                <span>
                                    {{ $tag->value }},
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

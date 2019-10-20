@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($tests as $test)
                    <div class="card my-2">
                        <div class="card-header" style="display: flex">
                            <div class="" style="flex: 1">
                                {{ $test->title }}
                            </div>
                            <div class="text-right" style="flex: 1">
                                <a class="btn btn-primary" href="{{ route('test.show', $test->id) }}">Try to pass</a>
                            </div>
                        </div>
                        <div class="card-body">
                            Tags:
                            @foreach($test->tags as $tag)
                                <span>
                                    {{ $tag->name }},
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

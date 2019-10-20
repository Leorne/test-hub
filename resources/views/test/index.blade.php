@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($tests as $test)
                    <div class="card my-2">
                        <div class="card-header">
                            {{ $test->title }}
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

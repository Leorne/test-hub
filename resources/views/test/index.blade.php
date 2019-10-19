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
                            Tags: <br>
                            @foreach($test->tags as $tag)
                                <div>
                                    {{ $tag->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection

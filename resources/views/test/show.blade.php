@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <pass-test test_id="{{ $test->id }}"></pass-test>
            </div>
        </div>
    </div>
@endsection

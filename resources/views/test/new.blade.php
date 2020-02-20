@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12">
                <div class="card">
                    <edit-test data="{{ isset($test) ? $test->toJson() : 'null' }}"></edit-test>
                </div>
            </div>
        </div>
    </div>
@endsection

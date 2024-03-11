@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Authors message to you :)</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <p>Hey there!</p>
                        <p>Welcome to <b>Laravel test driven development project</b> :)</p>
                        <p>If you find this project useful, please give it a star on GitHub. &#11088;</p>
                        <a href="https://github.com/perisicnikola37/laravel-test-driven-development" class="text-indigo-500"
                            target="_blank">Click here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

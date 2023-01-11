@extends('layouts.app')
@section('title')
    {{$title}}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ucwords(Auth::user()->role->value) }} {{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as') }} {{ucwords(Auth::user()->role) }}!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

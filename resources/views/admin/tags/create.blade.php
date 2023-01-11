@extends('layouts.admin')
@section('title', '| Create Tag')
  
@section('content')
<div class="card mt-5">
        <div class="card-header">
            <h2 style="text-transform: uppercase;">Create Tag</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('admin.tags.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    @include('partials.messages')
                </div>
                <div class="col-lg-12">
                    @include('partials.errors')
                       
                    <form action="{{ route('admin.tags.store') }}" method="POST">
                        @csrf
                        @include('partials.ext_create_tags_form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

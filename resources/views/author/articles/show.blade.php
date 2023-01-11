@extends('layouts.author')
@section('title', '| Article Details')
  
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2>{{ ucfirst($title) }}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('author.articles.index') }}">Back</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    @include('partials.messages')
                </div>
                @include('partials.ext_show_article')
            </div>
        </div>
    </div>
@endsection

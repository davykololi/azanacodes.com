@extends('layouts.author')
@section('title')
| {{$title}}
@endsection
 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2 style="text-transform: uppercase;color: maroon"><b>{{Auth::user()->name}} Articles</b></h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('author.articles.create') }}">Create</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Published</th>
                            <th>Author</th>
                            <th>Editor</th>
                            <th width="200px">Action</th>
                        </tr>
                        @forelse($articles as $article)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $article->title }}</td>
                            <td>
                                <img src="{{ $article->imageUrl()}}" width="50" height="50" alt="{!! $article->title !!}"/>
                            </td>
                            <td>{{ $article->description }}</td>
                            @if($article->is_published == true)
                            <td><span class="text-success">{{ $article->published }}</span></td>
                            @else
                            <td><span class="text-danger">{{ $article->published }}</span></td>
                            @endif
                            <td>{{ $article->user->name }}</td>
                            @if($article->is_published == true)
                            <td>{{ $article->published_by }}</td>
                            @else
                            <td><div class="text-danger">None</div></td>
                            @endif
                            <td>
                                <form action="{{ route('author.articles.destroy',$article->id) }}" method="POST">
                   
                                    <a class="btn btn-info btn-sm" href="{{ route('author.articles.show',$article->id) }}">Show</a>
                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('author.articles.edit',$article->id) }}">Edit</a>
                   
                                    @csrf
                                    @method('DELETE')
                                    
                                    @cannot('isAuthor')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete {!! $article->title !!}?')">Delete
                                    </button>
                                    @endcannot
                                </form>
                            </td>
                        @empty
                            <td colspan="10" class="text-danger text-bold">No Article(s) By {{Auth::user()->name}}</td>
                        </tr>
                        @endforelse
                    </table>
                    {!! $articles->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

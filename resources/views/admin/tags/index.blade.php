@extends('layouts.admin')
@section('title', '| Tags')
 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2 style="text-transform: uppercase;">Tags</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('admin.tags.create') }}">Create</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Keywords</th>
                            <th width="200px">Action</th>
                        </tr>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->excerpt() }}</td>
                            <td>{{ $tag->keywords }}</td>
                            <td>
                                <form action="{{ route('admin.tags.destroy',$tag->id) }}" method="POST">
                   
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.tags.show',$tag->id) }}">Show</a>
                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.tags.edit',$tag->id) }}">Edit</a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete {!! $tag->name !!}?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $tags->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

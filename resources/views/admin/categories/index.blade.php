@extends('layouts.admin')
@section('title', '| Categories')
 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2 style="text-transform: uppercase;">Categories</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('admin.categories.create') }}">Create</a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-warning">
                        Warning! Deleting categories will also delete all related posts.
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Description</th>
                            <th>Keywords</th>
                            <th width="200px">Action</th>
                        </tr>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->keywords }}</td>
                            <td>
                                <form action="{{ route('admin.categories.destroy',$category->id) }}" method="POST">
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.categories.show',$category->id) }}">Show</a>
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.categories.edit',$category->id) }}">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete {!! $category->name !!}?')">Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $categories->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

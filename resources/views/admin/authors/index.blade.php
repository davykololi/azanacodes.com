@extends('layouts.admin')
@section('title', '| Authors')

 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2>AUTHORS</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('admin.authors.create') }}"> Create </a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-warning">
                        Warning! Deleting authors will also delete all related posts.
                    </div>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        @include('partials.admin_table_head')
                        @foreach ($users as $user)
                        <tr>
                            @include('partials.admin_table_details')
                            <td>
                                <form action="{{ route('admin.authors.destroy',$user->id) }}" method="POST">
                   
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.authors.show',$user->id) }}">Show</a>
                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.authors.edit',$user->id) }}">Edit</a>
                   
                                    @csrf
                                    @method('DELETE')
                      
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete {!! $user->name !!}?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

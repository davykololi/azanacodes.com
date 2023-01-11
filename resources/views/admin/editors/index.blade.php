@extends('layouts.admin')
@section('title', '| Editors')

 
@section('content')
    <div class="card mt-5">
        <div class="card-header">
            <h2>{{ __('Editors List')}}</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 mt-1 mr-1">
                    <div class="float-right">
                        <a class="btn btn-success" href="{{ route('admin.editors.create') }}"> Create </a>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-lg-12">
                    <table class="table table-bordered">
                        @include('partials.admin_table_head')
                        @foreach ($users as $user)
                        <tr>
                            @include('partials.admin_table_details')
                            <td>
                                <form action="{{ route('admin.editors.destroy',$user->id) }}" method="POST">
                   
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.editors.show',$user->id) }}">Show</a>
                    
                                    <a class="btn btn-primary btn-sm" href="{{ route('admin.editors.edit',$user->id) }}">Edit</a>
                   
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

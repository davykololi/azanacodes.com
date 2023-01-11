<div>
    <div class="col-md-8 mb-2">
        <div class="card">
            <div class="card-body">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('error') }}
                    </div>
                @endif

                @if($updateCategory)
                    @include('livewire.article_update')
                @else
                    @include('livewire.article_create')
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Keywords</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($articles) > 0)
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>
                                            {{$article->name}}
                                        </td>
                                        <td>
                                            {{$article->description}}
                                        </td>
                                        <td>
                                            {{$article->keywords}}
                                        </td>
                                        <td>
                                            <button wire:click="edit({{$article->id}})" class="btn btn-primary btn-sm">Edit</button>
                                            <button onclick="deleteCategory({{$article->id}})" class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" align="center">
                                        No Articles Found.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteCategory(id){
            if(confirm("Are you sure to delete this record?"))
                window.livewire.emit('deleteArticle',id);
        }
    </script>
</div>

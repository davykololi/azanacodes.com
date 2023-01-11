<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ucwords(Auth::user()->role->value) }}'s Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2 style="text-align: center;color: blue;">You are in {{ucwords(Auth::user()->role->value) }}'s Dashboard!</h2>
                </div>
            </div>
        </div>
    </div>
</div>
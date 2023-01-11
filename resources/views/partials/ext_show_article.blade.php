                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <h1 style="color: purple;font-size: 30px;text-transform: uppercase;"><b>{{ $article->title }}</b></h1>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <img src="{{ $article->imageUrl()}}" style="width: 40%" alt="{!! $article->title !!}"/>
                            </div>
                            <caption><b style="font-size: 20px">{{ $article->caption }}</b></caption>
                            <br/><br/>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                {{ $article->description }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Content:</strong>
                                {!! $article->content !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Keywords:</strong>
                                {{ $article->keywords }}
                            </div>
                        </div>
                        <div class="container" style="background-color: lightgray;">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Created On:</strong>
                                    {{ $article->created_at->toDayDateTimeString() }} by <strong>{{ $article->user->name }}</strong>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Published On:</strong>
                                    {{ $article->published_at }} by <strong>{{ $article->published_by }}</strong>
                                </div>
                            </div>
                        
                            @if($article->is_published == true)
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Edited On:</strong>
                                    {{ $article->updated_at }} by <strong>{{ Auth::user()->name }}</strong>
                                </div>
                            </div>
                            @else
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Published:</strong>
                                    <span class="text-danger">{{ $article->is_published ? "Yes" : "No" }}</span>
                                </div>
                            </div>
                            @endif

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                <strong>Article Tags:</strong>
                                @forelse($articleTags as $tag)
                                    <span class="badge badge-pill badge-primary" style="margin: 5px;display: inline-block;">
                                        {!! $tag->name !!}
                                    </span>
                                @empty
                                    <span class="badge badge-pill badge-danger">Not tagged.</span>
                                @endforelse
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Total Views:</strong>
                                    {{ $article->total_views }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
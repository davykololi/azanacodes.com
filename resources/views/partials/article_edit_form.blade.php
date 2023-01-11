                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Title:') }}</label>
                                    <input type="text" name="title" value="{{ old('title',$article->title) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Image:') }}</label>
                                    <input type="file" name="image" value="{{ old('image',$article->image) }}" class="form-control">
                                    <img src="{{ $article->imageUrl()}}" width="50" height="50" alt="{!! $article->title !!}"/>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Description:') }}</label>
                                    <input type="text" name="description" value="{{ old('description',$article->description) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Caption:') }}</label>
                                    <input type="text" name="caption" value="{{ old('caption',$article->caption) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Keywords:') }}</label>
                                    <input type="text" name="keywords" value="{{ old('keywords',$article->keywords) }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Content:') }}</label>
                                    <textarea class="form-control" id="myeditorinstance" name="content" rows="5" cols="40">
                                        {!! htmlentities($article->content) !!}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="category_id">{{ __('Category:') }}</label>
                                    <select class="form-control" name="category_id" type="text">
                                        <option value="">{{ __('Select Category:') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{!! $category->id !!}" @if($article->category_id == $category->id) selected @endif>
                                                {!! $category->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Tags:') }}</label>
                                    {!! Form::select('tags[]',$tags,$articleTags,['class'=>'form-control','multiple'=>'multiple']) !!}
                                </div>
                            </div>
                            @can('isEditor')
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="user_id">{{ __('Author:') }}</label>
                                    <select class="form-control" name="user_id" type="text">
                                        <option value="">{{ __('Select Author:') }}</option>
                                        @foreach ($authors as $author)
                                            <option value="{!! $author->id !!}" @if($article->user_id == $author->id) selected @endif>
                                                {!! $author->name !!}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Published At:') }}</label>
                                    <input type="date" name="published_at" value="{{ old('published_at',$article->published_at) }}" class="form-control">
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="checkbox" class="custom-control-input" name="publish" id="publish-post" @if($article->is_published) checked @endif>
                                    <label class="custom-control-label" for="publish-post">{{ __('Publish') }}</label>
                                </div>
                            </div>
                            @endcan
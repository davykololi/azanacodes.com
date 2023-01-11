                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Title:') }}</label>
                                    <input type="text" name="title" class="form-control" id="title" value="{!! old('title') !!}" placeholder="Title"> 
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Image:') }}</label>
                                    <input type="file" name="image" class="form-control" id="image" value="{!! old('image') !!}" placeholder="Image"> 
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Description:') }}</label>
                                    <input type="text" name="description" class="form-control" id="description" value="{!! old('description') !!}" placeholder="Description">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror 
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Caption:') }}</label>
                                    <input type="text" name="caption" class="form-control" id="caption" value="{!! old('caption') !!}" placeholder="Caption"> 
                                    @error('caption')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Content:') }}</label>
                                    <textarea class="form-control" id="myeditorinstance" name="content" rows="5" cols="40">
                                        {!! old('content') !!}
                                    </textarea>
                                    @error('content')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="category_id">{{ __('Category:') }}</label>
                                    <select class="form-control" name="category_id">
                                        <option value="">{{ __('Select Category:') }}</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id}}" {{ $category->id === old('category_id') ? 'selected' : ''}}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Tags:') }}</label>
                                    {!! Form::select('tags[]',$tags,old('tags'),['class'=>'form-control','multiple'=>'multiple']) !!}
                                    @error('tags')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="title">{{ __('Keywords:') }}</label>
                                    <input type="text" name="keywords" class="form-control" id="keywords" value="{!! old('keywords') !!}" placeholder="Keywords">
                                    @error('keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
                            </div>
                            
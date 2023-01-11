                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('Name:') !!}
                            {!! Form::text('name', old('name'), ['class'=>'form-control','placeholder'=>'Name']) !!}
                            <span class="text-danger">{{ $errors->first('name')}}</span>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            {!! Form::label('Description:') !!}
                            {!! Form::text('description', old('description'), ['class'=>'form-control','placeholder'=>'Description']) !!}
                            <span class="text-danger">{{ $errors->first('description')}}</span>
                        </div>

                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                            {!! Form::label('Category:') !!}
                            {!! Form::select('category_id', $categories, old('category_id'), ['class'=>'form-control','placeholder'=>'Select Category']) !!}
                            <span class="text-danger">{{ $errors->first('category_id')}}</span>
                        </div>

                        <div class="form-group {{ $errors->has('keywords') ? 'has-error' : ''}}">
                            {!! Form::label('Keywords:') !!}
                            {!! Form::text('keywords', old('keywords'), ['class'=>'form-control','placeholder'=>'Keywords']) !!}
                            <span class="text-danger">{{ $errors->first('keywords')}}</span>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">Create</button>
                        </div>
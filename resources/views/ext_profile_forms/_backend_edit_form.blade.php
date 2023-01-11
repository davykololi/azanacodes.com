                    <div class="form-group row">
                        <label for="image" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" name="image" id="image" value="{{ old('image',Auth::user()->profile->image) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="facebook_url" class="col-sm-2 col-form-label">Facebook Url</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="facebook_url" id="facebook_url" value="{{ old('facebook_url',Auth::user()->profile->facebook_url) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="twitter_url" class="col-sm-2 col-form-label">Twitter Url</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="twitter_url" id="twitter_url" value="{{ old('twitter_url',Auth::user()->profile->twitter_url) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="instagram_url" class="col-sm-2 col-form-label">Instagram Url</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="instagram_url" id="instagram_url" value="{{ old('instagram_url',Auth::user()->profile->instagram_url) }}">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="mobile_no" class="col-sm-2 col-form-label">Mobile</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="mobile_no" id="mobile_no" value="{{ old('mobile_no',Auth::user()->profile->mobile_no) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="state" class="col-sm-2 col-form-label">State</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="state" id="state" value="{{ old('state',Auth::user()->profile->state) }}">
                        </div>
                      </div>
                      
                      <div class="form-group row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="city" id="city" value="{{ old('city',Auth::user()->profile->city) }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="user_details" class="col-sm-2 col-form-label">Details</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" name="user_details" id="user_details">
                            {{ old('user_details',Auth::user()->profile->user_details) }}
                          </textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>

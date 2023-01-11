@extends('layouts.app')

@section('content')
<main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/visitor/profile') }}">{{ Breadcrumbs::render('visitor.profile') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <section class="inner-page">
      <div class="container">
        <p>
          Profile Page <span style="color: green">{{ Auth::user()->name }}</span>
        </p>

        <form action="{{ route('visitor.store-profile')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <input type="file" class="form-control-file"  name="avatar">
                                                <input type="text" class="form-control-file"  name="facebook_url" placeholder="Facebook Url">
                                                <input type="text" class="form-control-file"  name="twitter_url" placeholder="Twitter Url">
                                                <input type="text" class="form-control-file"  name="instagram_url" placeholder="Instagram Url">
                                                <input type="text" class="form-control-file"  name="mobile" placeholder="Mobile">
                                                <input type="text" class="form-control-file"  name="country" placeholder="Country">
                                                <input type="text" class="form-control-file"  name="state" placeholder="State">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
      </div>
    </section>

  </main><!-- End #main -->
@endsection

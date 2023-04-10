@extends('layouts.app')
    
@section('content')  
  <main id="main">
    @section('breadcrumbs')
    <!-- ======= Breadcrumbs ======= -->
    <section class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="{{ URL::to('/policy') }}">{{ Breadcrumbs::render('policy') }}</a></li>
        </ol>
      </div>
    </section><!-- End Breadcrumbs -->
    @endsection
    <!-- ======= Private Policy Section ======= -->    
    <section class="inner-page">
      <div class="container">
        <div class="row">
            <div class="col-md-12">
              <h1>PRIVATE POLICY</h1>
              <div style="margin-top: 10px;">
                  <p>
                    Here we talk about our private policy. This entails the data we collect from the clients who use our app, the methods we use to collect data and the usage of the collected data. We also talk about how we protect the data collected from our clients from finding it's way into the hands of third parties.
                  </p>
              </div>
              <div style="">
                <h2>DATA COLLECTED</h2>
                <div>
                  <p>
                      We collect various data using the forms embedded in our app. Such forms include registration, newsletter, comments and contacts forms. The registration form is used to collect the names, emails and passwords of users who want to participate in various engagements on our app, and this include participation in discussions in comments section. The na 
                  </p>
                </div>
              </div>
            </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->
@endsection
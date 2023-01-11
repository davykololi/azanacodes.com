    <div class="footer-newsletter">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-12 text-center">
            <h4>Subscribe To Our Newsletter</h4>
            <p>Sign up here to get the latest news updates and special offers delivered directly to your inbox.</p>
          </div>
          <div class="col-lg-6">
            <form action="{{route('newsletter')}}" method="post">
              @csrf
              <input type="email" name="email"><input type="submit" value="Subscribe">
            </form>
          </div>
        </div>
      </div>
    </div>
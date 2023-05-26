<footer class="bg-dark text-white py-3">
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Contact Us</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">E-mail</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Phone Number</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Road</a></li>
          {{-- <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li> --}}
        
          {{-- @guest
          <li class="nav-item list-unstyled">
            <a href="{{route('become.revisor')}}" class=" text-white">Diventa Revisore</a>
          </li>
          @else   --}}
          @auth
            {{-- @if(!Auth::user()->is_revisor) --}}
            <li class="nav-item">
              <a href="{{route('become.revisor')}}" class="nav-link p-0 text-muted">Diventa Revisore</a>
            </li>
            {{-- @endif --}}
          @endauth

        </ul>
      </div>

      <div class="col-6 col-md-2 mb-3">
        <h5>Section</h5>
        <ul class="nav flex-column">
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
          <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
        </ul>
      </div>

      <div class="col-md-5 offset-md-1 mb-3">
        <form>
          <h5>Subscribe to our newsletter</h5>
          <p>Monthly digest of what's new and exciting from us.</p>
          <div class="d-flex flex-column flex-sm-row w-100 gap-2">
            <label for="newsletter1" class="visually-hidden">Email address</label>
            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
            <button class="btn btn-primary" type="button">Subscribe</button>
            
          </div>
        </form>
      </div>
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-between py-4 border-top">
      <p>© 2022 Company, Inc. All rights reserved.</p>
      <ul class="list-unstyled d-flex">
        <li class="ms-3"><a class="link-dark" href="#"><i class="fa-brands fa-twitter fa-2x"></i></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><i class="fa-brands fa-instagram fa-2x"></i></a></li>
        <li class="ms-3"><a class="link-dark" href="#"><i class="fa-brands fa-facebook fa-2x"></i></a></li>
      </ul>
    </div>
  </div>
  </footer>
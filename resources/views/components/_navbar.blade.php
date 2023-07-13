<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand text-light" href="/">Laravel Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link text-light" href="/">Home <span class="sr-only">(current)</span></a>
        </li>


        @auth
            <li class="nav-item">
                <a class="nav-link text-light" href="#">@ {{auth()->user()->name}}</a>
            </li>

            <li class="nav-item">
              <a class="nav-link text-light" href="{{ route('create') }}">Create Post</a>
          </li>
  

            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('logout') }}">Sign Out</a>
            </li>


         @else
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('login') }}">Sign In</a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('register') }}">Sign Up</a>
            </li>
        @endauth
      </ul>

      
      <form method="GET" class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>

    @if(session()->has('message'))
        <p class="text-center bg-danger mt-2">
            <small class=" pt-2 pb-2 ps-5 pe-5" style="color: white; width:100%;" >{{session('message')}}</small>
        </p>

    @endif
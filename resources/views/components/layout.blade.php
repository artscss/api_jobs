<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <title>{{ $title ?? "title" }}</title>
    </head>
    <body>
        <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <a class="navbar-brand" href="{{ route('job.dashboard') }}">job app</a>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      @if(Auth::check() && Auth::user()->role > 0)                   
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('job.create') }}">create new job</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('job.dashboard') }}">dashboard</a>
                      </li>
                      @endif
                      @guest
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.register') }}">register</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('auth.login') }}">login</a>
                      </li>
                      @endguest
                      @auth                        
                      <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <li><a class="dropdown-item" href="{{ route('profile') }}">profile</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="{{ route('auth.logout') }}">logout</a></li>
                        </ul>
                      </li>
                      @endauth
                    </ul>
                  </div>
                </div>
            </nav>

            <br>

            @if(Session::has("success"))
            <p class="alert alert-success text-center">{{ Session::get("success") }}</p>
            @elseif(Session::has("danger"))
            <p class="alert alert-danger text-center">{{ Session::get("danger") }}</p>
            @endif
    
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}

        </div>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    </body>
</html>
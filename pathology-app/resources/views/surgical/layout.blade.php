<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="/css/fontawesome/css/all.min.css">    
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <img src="{{asset('images/logo.png')}}" alt="" width="30" class="d-inline-block align-text-top">
              <a class="navbar-brand" href="#">DUCPH LAB</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  @if (Auth::user()->is_admin)
                   <li class="nav-item"><a class="nav-link active" href="{{route('register')}}">เพิ่มผู้ใช้</a></li>
                  @endif            
                  <li class="nav-item"><a class="nav-link active" href="/surgical/index">ผลรายงาน</a></li>            
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ห้องทำงานแพทย์
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item" href="/surgical/report">SURGICAL</a></li>
                      <li><a class="dropdown-item" href="/pathology-b/report">เทมเพลต B</a></li>                      
                    </ul>
                  </li>
                </ul>
                  @auth
                  <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{Auth::user()->name}}
                      </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li>
                        <form class="d-flex" action="{{route('logout')}}" method="POST">
                        @csrf
                        <button class="btn btn-link" type="submit">LOGOUT</button>
                      </form>
                    </li>                                           
                    </ul> 
                  </li>
                  </ul>
                  @else
                  <form class="d-flex" action="{{route('login')}}" method="GET">                    
                    <button class="btn btn-link" type="submit">LOGIN</button>
                  </form>
                  @endauth
                
              </div>
            </div>
          </nav>
          
   
    <div class="container">
        @yield('content')
    </div>
    
    <script src="{{asset('js/plugins/alpine.js')}}"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>    
    <script>
       
    </script>
</body>
</html>
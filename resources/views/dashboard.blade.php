<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Home</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="position-ref full-height">
          <div class="position-ref full-height dashboard">
            @section('navbar')
            <div class = "top-toolbar">
                <a href="/"><img class="dashboard-logo" src = "{{URL::asset('/images/logo.png')}}"></a>
            </div>
            @show
            <div class="dashboard-content">
              @section('sidebar')
                <div class = "dashboard-menu">
                  <div class="user-profile-area">
                    <div class = "image-column">
                      <img class="user-photo" src = "{{URL::asset('/images/user-placeholder.png')}}">
                    </div>
                    <div class = "text-column">
                      <div class = "email">{{{ Auth::user()->email }}}</div>
                      <div class = "roles">
                        <div class = "role">developer</div>
                      </div>
                    </div>

                  </div>
                  <div class="dashbord-item">
                    Users
                    <a href="/users" class="tap-area"></a>
                  </div>
                  <div class="dashbord-item">
                    Roles
                    <a href="/roles" class="tap-area"></a>
                  </div>
                  <div class="dashbord-item">
                    Skype
                    <a href="/skype" class="tap-area"></a>
                  </div>
                  <div class="dashbord-item">
                    Logout
                    <a href="/logout" class="tap-area"></a>
                  </div>
                </div>
              @show
              <div class="dashbord-view"> 
                @yield('content')
              </div>
            </div>
          </div>
        </div>
    </body>
</html>

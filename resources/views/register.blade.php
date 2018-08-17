<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Register</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <a href="/"><img class="small-logo" src = "{{URL::asset('/images/logo.png')}}"></a>
        <div class="position-ref align-center">
            @if (Auth::check())
              <script>window.location.href = "/home"</script>
            @else
              <div class="auth-form">
                {{ Form::open(array('url' => 'register')) }}
                <h1>Register</h1>

                <!-- if there are login errors, show them here -->
                <p>
                {{ $errors->first('email') }}
                {{ $errors->first('password') }}
                {{ $errors->first('auth') }}
                </p>

                <p class="input-row">
                {{ Form::label('email', 'Email Address') }}
                {{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
                </p>

                <p class="input-row">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password') }}
                </p>

                <p class="input-row">
                {{ Form::label('password', 'Confirm Password') }}
                {{ Form::password('password_confirmation') }}
                </p>

                <p>{{ Form::submit('Register') }}</p>
                <p>or</p>
                <p><a href="/login">Login now</a></p>
                {{ Form::close() }}
              </div>
            @endif
        </div>
    </body>
</html>

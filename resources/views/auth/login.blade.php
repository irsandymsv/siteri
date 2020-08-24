<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SITERI - LOGIN</title>

    <!-- Styles -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
     <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous" -->
    <!-- Scripts -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('/assets/images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>
    <div id="app">


        <div class="limiter">
  <div class="container-login100" style="background-color:#0064AB;">
    <div class="wrap-login100">
      <div class="" style="position:absolute; margin-top:-160px; margin-left:-80px;">
        <img src="{{asset('/assets/images/img-02.png')}}" alt="IMG" width="80px" height="80px">
      </div>
      <div class="login100-pic js-tilt" data-tilt>
        <img src="{{asset('/assets/images/img-01.png')}}" alt="IMG">
      </div>

    <form class="login100-form validate-form" method="POST" action="{{route('login')}}">
        @csrf
        <span class="login100-form-title">
          LOGIN
        </span>

        <div class="form-group wrap-input100 validate-input">
          <input class="input100" type="text" class="form-control @error('username') is-invalid @enderror" name="username" required placeholder="Username" value="{{old('username')}}">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
          </span>
        </div>

        <div class="form-group wrap-input100 validate-input" data-validate = "Password is required">
          <input class="input100" type="password" class="form-control" name="password" required placeholder="Password">
          <span class="focus-input100"></span>
          <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
          </span>
        </div>

        {{-- <div class="checkbox">
            <label class="txt2">
                <input type="checkbox" name="remember" > Remember Me
            </label>
        </div> --}}

        @error('username')
          <span class="invalid-feedback" style="display: block;" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror

        <div class="container-login100-form-btn">
          <button class="login100-form-btn" type="submit">
            Login
          </button>
        </div>
      </form>
    </div>  
  </div>
</div>

    </div>

    <!-- Scripts -->

    <script src="{{asset('/assets/js/app.js')}}"></script>
     <!--script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script-->
    <!--script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script-->
    <!--===============================================================================================-->
    	<script src="{{asset('/assets/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    	<script src="{{asset('/assets/vendor/bootstrap/js/popper.js')}}"></script>
    	<script src="{{asset('/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    	<script src="{{asset('/assets/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    	<script src="{{asset('/assets/vendor/tilt/tilt.jquery.min.js')}}"></script>
    	<script >
    		$('.js-tilt').tilt({
    			scale: 1.1
    		})
    	</script>
    <!--===============================================================================================-->
    	<script src="{{asset('/assets/js/main.js')}}"></script>
</body>
</html>

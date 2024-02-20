<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title> Login </title>

    <!-- vendor css -->
    <link href="{{ asset("assets/backend") }}/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="{{ asset("assets/backend") }}/lib/Ionicons/css/ionicons.css" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset("assets/backend") }}/css/starlight.css">
  </head>

  <body>
      

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

        <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
          <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
          <div class="tx-center mg-b-60">Professional Admin Template Design</div>
          @include("_message")
          <form action="{{ url('/login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" class="form-control" name="email" placeholder="Enter your Email">
            </div><!-- form-group -->
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="Enter your password">
              {{-- remember me --}}
              <div class="form-check mt-2">
              <input type="checkbox" name="remember" id="remember" >
              <label for="remember">Remenber me</label>
              </div>
            </div><!-- form-group -->
            <button type="submit" class="btn btn-info btn-block">Login</button>
          </form>
    
          <div class="mg-t-60 tx-center"> <a href="{{ url("/forget-password") }}" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a></div>
         
        </div><!-- login-wrapper -->
      </div><!-- d-flex -->
  
      <script src="{{ asset("assets/backend") }}/lib/jquery/jquery.js"></script>
      <script src="{{ asset("assets/backend") }}/lib/popper.js/popper.js"></script>
      <script src="{{ asset("assets/backend") }}/lib/bootstrap/bootstrap.js"></script>
  
    </body>
  </html>
  
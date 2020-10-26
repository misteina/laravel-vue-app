<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-4.5.3.css">
    <!-- app css -->
    <link rel="stylesheet" href="css/app.css">
    <!-- vue -->
    <script src="js/vue.js"></script>

    <title>TODO Application</title>
  </head>
  <body>

    <div id="app" class="container-fliud">
        @section('content')
        <div class="container-fliud header">
            <h1>TODO</h1>
            @auth
                <a href="/logout">Log out</a>
            @endauth
        </div>
        @show
    </div>

    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="js/jquery-3.5.1.js"></script>
    <script src="js/bootstrap-4.5.3.js"></script>
    <!-- app js -->
    <script src="js/app.js"></script>
  </body>
</html>
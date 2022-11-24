<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="/images/favicon.png" type="image/png">

        <!-- Bootstrap CSS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/style.css">
        <title>Login - Case Management Tool</title>
    </head>
    <body>
        <div class="container h-100">
            <div class="row align-items-center h-100">
                <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12 mx-auto">
                    <img class="login_logo d-block" src="/images/login_logo.png" alt="" />
                    <p class="text-center text-uppercase font-weight-bold">Case Management System</p>
                    @if(isset($message))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="jumbotron">
                        <form id="login_form" method="POST" action="">
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" required>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <button id="action_login" type="submit" class="btn btn-primary">Login Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Adding scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="/js/script.js"></script>
    </body>
</html>
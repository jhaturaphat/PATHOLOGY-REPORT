<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
    <div class="container d-flex flex-column justify-content-center align-items-center">
        <div class="pt-5">
            <div class="card mx-auto" style="width: 480px">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" name="email" >
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-md-12 d-flex flex-row justify-content-end">
                            <button type="submit" class="btn btn-primary">LOGIN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
</body>
</html>

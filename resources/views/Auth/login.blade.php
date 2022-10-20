<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            background-image: url('https://cdn.wallpapersafari.com/72/41/NmPIY6.jpg');
            background-size: cover;
        }
    </style>
</head>
</head>

<body>
    <div class="container mt-5 pt-5">
        <div class="card col-5 m-auto bg-light mt-5 pt-5">
            <div class="card-body">
                <div class="card-title">
                    <h2 class="text-center">Login Form</h2>
                </div>
                <hr>
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        <strong>{{ session('error') }}!</strong>
                    </div>
                @endif
                <form action="{{ route('LoginPost') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control @error('email')@enderror" id="email" placeholder="Enter email" value="{{ old('email') }}">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password')@enderror" id="password" placeholder="Password">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input type="checkbox" name="check" class="form-check-input @error('check')@enderror" id="check">
                        <label class="form-check-label" for="check">Check me out</label>
                        @error('check')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <button type="submit" class="btn btn-secondary">Login</button>
                        </div>
                        <div class="col-6 ps-5">
                            <a href="{{ route('ForgatePass') }}">Forgate Password</a>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('Register') }}">Create an account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</html>

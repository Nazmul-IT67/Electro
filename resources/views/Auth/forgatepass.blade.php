<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgate Password</title>
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
        <div class="card col-5 m-auto bg-light mt-5 pt-2">
            <div class="card-body">
                <img src="https://www.pngitem.com/pimgs/m/35-352534_transparent-security-icon-png-clip-art-of-a.png" alt="" style="width: 25%; margin-left:150px">
                <hr>
                <div class="card-title pb-2">
                    <h3 class="text-secondary">Forgate Password</h3>
                </div>
                @if (session('error'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ session('error') }}!</strong>
                    </div>
                @endif
                <form action="{{ route('PasswordLink') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" value="{{ old('email') }}">
                        @if($errors->any('email'))
                            <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="mt-3">
                        <button class="btn btn-secondary">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</html>

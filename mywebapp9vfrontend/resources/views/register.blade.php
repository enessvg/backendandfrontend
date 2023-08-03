<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.css" rel="stylesheet" />
    <style>
        .login__forms {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .login__box {
            display: flex;
            align-items: center;
            background: #fff;
            border-radius: 4px;
            padding: 0.875rem;
            margin-bottom: 1rem;
            width: 450px;
        }

        .login__box input {
            border: none;
            outline: none;
            padding: 0.45rem 0.875rem;
            font-family: 'Poppins', sans-serif;
            width: 100%;
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #3a3a3a;
            color: #fff;
            padding: 0.875rem;
            width: 12rem;
            box-shadow: 4px 4px #2a2a2a;
            cursor: pointer;
            font-family: 'Poppins', sans-serif;
            transition: 300ms;
        }

        .btn-login:hover {
            transform: translateY(7px);
            transition: 300ms;
        }

        .btn-login span {
            padding-left: 10px;
        }

        .fs-20 {
            font-size: 24px;
        }

        .centered-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .centered-pyazi {
            display: flex;
            justify-content: center;
            align-items: center;

        }

        @media screen and (max-width:1112px) {
            .containerwidth {
                width: 90%
            }
        }

        @media screen and (min-width:1113px) {
            .containerwidth {
                width: 50%
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="http://127.0.0.1:8001">Home page</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/register">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div style="width: 100%;height:89vh;margin:0px;padding:0px;"
        class="d-flex justify-content-center align-items-center">
        <div style="border: 1px solid green;border-radius: 20px;" class="container containerwidth">
            @if ($errors->has('kayitemail'))
            <div class="alert alert-danger mt-2" style="margin-bottom: -30px;" role="alert">
                {{ $errors->first('kayitemail') }}
            </div>
            @endif
            <form class="m-3" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label mt-3">İsim</label>
                    <input style="border: 1px solid green;" type="text" name="name" class="form-control" id="exampleInputPassword1">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">E-Mail adresi</label>
                    <input style="border: 1px solid green;" type="email" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Şifre</label>
                    <input style="border: 1px solid green;" type="password" name="password" class="form-control" id="exampleInputPassword1">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Şifre tekrar</label>
                    <input style="border: 1px solid green;" type="password" name="c_password" class="form-control" id="exampleInputPassword1">
                    @error('c_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Giriş</button>
            </form>
            <a href="/login" class="centered-pyazi mb-4">Hesabın Var mı? Giriş yap!</a>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.0/mdb.min.js"></script>

</body>

</html>
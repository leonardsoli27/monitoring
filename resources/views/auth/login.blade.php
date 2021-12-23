<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
    <title>Login | Balai Karantina Pertanian Kelas II Ternate</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{ asset('assets1/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/vendor/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets1/vendor/linearicons/style.css') }}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets1/css/main.css') }}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{ asset('assets1/css/demo.css') }}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo1.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo1.png') }}">
</head>

<body>
    <!-- WRAPPER -->
    @include('sweetalert::alert')
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle">
                <div class="auth-box ">
                    <div class="left">
                        <div class="content">
                            <div class="header">
                                <img src="{{ asset('images/logo3.png') }}" style="width: 90%" alt="Karantina Logo">
                                <p class="lead">Login Akun Wilker</p>
                            </div>
                            <form class="form-auth-small" action="/" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="username" class="control-label sr-only">Email</label>
                                    <input type="text" class="form-control @error('username')
                                        is-invalid
                                    @enderror" id="username" name="username" placeholder="Username" required
                                        value="{{ old('username') }}">
                                    @error('username')
                                    <div class="invalid-feedback">
                                        Username Wajib Diisi.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label sr-only">Password</label>
                                    <input type="password" class="form-control @error('password')
                                        is-invalid
                                    @enderror" id="password" name="password" placeholder="Password" required>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        Password Wajib Diisi.
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox" value="remember_me" id="remember_me" name="remember_me">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-info btn-lg btn-block">LOGIN</button>
                                <div class="bottom">
                                    {{-- <span class="helper-text"><i class="fa fa-lock"></i> <a
                                            href="{{ url('/lupaPassword') }}">Lupa
                                    password?</a></span> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="right">
                        <div class="overlay"></div>
                        <div class="content text">
                            <h1 class="heading"><strong>Aplikasi Lalu Lintas Komoditas Pertanian</strong></h1>
                            <p>Balai Karantina Pertanian Kelas II Ternate</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->
</body>

</html>

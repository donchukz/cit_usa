<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Payroll Management Syetem." />

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/favicon/favicon.ico" type="image/x-icon" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <!-- Libs CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/libs.bundle.css') }}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/css/theme.bundle.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">


    <!-- Title -->
    <title>Payroll</title>
</head>

<body class="d-flex align-items-center  border-top border-top-2 border-primary loginBody">

    <!-- CONTENT
    ================================================== -->
    <div class="container-fluid loginBody">
        <div class="row align-items-center justify-content-center ">
            <div class="col-12 col-md-6 col-lg-6 col-xl-6 d-none d-lg-block">
                <img src="./assets/images/Group1825.png" class="signInImageTop pt-3" alt="" srcset="">
                <div class="portalContainer">
                    <div class="portalBg">
                        <img src="./assets/images/Group1834.png" class="signInImageCenter" alt=""
                            srcset="">
                        <h1 class=" text-white portalHeader ml-4 mt-3">Care In Touch</h1>
                        <p class=" text-white portalInfo ml-4"> Web Portal</p>
                    </div>
                </div>
                <img src="./assets/images/Group1826.png" class="signInImageBottom pb-3" alt="" srcset="">
            </div>
            <div class="col-12 col-md-6 col-lg-6 col-xl-6">

                <div class="loginFormBody">
                    <!-- Form -->
                    <form class="loginForm" action="{{ url('login') }}" method="post">
                        @csrf
                        <div class="logo">
                            <img src="./assets/images/logo.png" alt="logo">
                        </div>
                        <!-- Heading -->
                        <h1 class="signIn text-center mb-3">
                            Sign In
                        </h1>
                        <!-- Email address -->


                        <div class="form-group">

                            @if (session('status'))
                                <center class="text-light border border-danger bg-danger">
                                    {{ session('status') }}
                                </center>
                                <br>
                            @endif

                            <!-- Label -->
                            <label class="form-label">
                                Email Address
                            </label>

                            <!-- Input -->
                            <input type="email" name="email"
                                class="form-control @error('email') border border-danger @enderror"
                                placeholder="name@address.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col">

                                    <!-- Label -->
                                    <label class="form-label">
                                        Password
                                    </label>

                                </div>
                                <div class="col-auto">

                                </div>
                            </div> <!-- / .row -->

                            <!-- Input group -->
                            <div class="input-group input-group-merge">

                                <!-- Input -->
                                <input class="form-control @error('password') border border-danger @enderror"
                                    name="password" type="password" placeholder="Enter your password" id="pass">

                                <!-- Icon -->
                                <span class="input-group-text @error('password') border border-danger @enderror"
                                    onclick="showPassword()">
                                    <i class="fe fe-eye" id="togglePassword"></i>
                                    {{-- <i class="fe fe-eye-off" style="display: none;"></i> --}}
                                </span>

                            </div>
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Submit -->
                        <button class="btn btn-lg btn-block btn-primary mb-3" type="submit">
                            Sign In
                        </button>

                        <div class="d-flex justify-content-between">
                            <!-- Help text -->
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember"> Remember me</label>
                            </div>
                            <!-- Help text -->
                            <a href="password-reset.html"
                                class="form-text text-bold text-decoration-underline link-primary">
                                <a href="{{ route('resetpassword') }}"> <strong>Forgot password</strong> </a>
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div> <!-- / .row -->
    </div>


    <!-- Vendor JS -->
    <script src="./assets/js/vendor.bundle.js"></script>

    <!-- Theme JS -->
    <script src="./assets/js/theme.bundle.js"></script>
    <script>
        function showPassword() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
                document.getElementByClassName("fe-eye").style.display = 'none';
                document.getElementByClassName("fe-eye-off").style.display = 'block';
            } else {
                x.type = "password";
                document.getElementByClassName("fe-eye-off").style.display = 'none';
                document.getElementByClassName("fe-eye").style.display = 'block';
            }
        }
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#pass');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fe-eye-off');
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        });
    </script>

</body>

</html>

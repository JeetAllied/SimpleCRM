<?php /*<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<?php */ ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Simple CRM | @yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('/resources/')}}/assets/img/icon.ico" type="image/x-icon"/>
    <!-- csrf token for ajax request -->
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <!-- Fonts and icons -->
    <script src="{{asset('/resources/')}}/js//plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {"families":["Lato:300,400,700,900"]},
            custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../resources/css/fonts.min.css']},
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('/resources/')}}/css//bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/resources/')}}/css//atlantis.min.css">
    @stack('css')
</head>
<body>
<div class="wrapper" style="background-color: aqua;">

        <div class="container justify-content-center align-items-center align-content-center" style="height:100vh;">
            <div class="row">
                <div class="col md-6 col-lg-6 mx-auto">
                    <div class="card mt-auto mb-auto align-content-center">
                        <div class="card-header">
                            <h2 class="px-2">Login</h2>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}" onsubmit="return validateLogin()">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">

                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                <i class="fa fa-envelope"></i>
                                                </span>
                                            </div>

                                            <input type="email" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" placeholder="Enter Email" value="{{old('email')}}">
                                            @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text" style="cursor: pointer;">
                                                    <i class="fa fa-eye-slash" id="icon_eye"></i>
                                                </span>
                                                </div>

                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password">
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                            @if (Route::has('password.request'))
                                                <span class="float-right"><a href="{{ route('password.request') }}">Forgot Password?</a></span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


</div>
<!--   Core JS Files   -->
<script src="{{asset('/resources/')}}/js//core/jquery.3.2.1.min.js"></script>
<script src="{{asset('/resources/')}}/js//core/popper.min.js"></script>
<script src="{{asset('/resources/')}}/js//core/bootstrap.min.js"></script>

<!-- jQuery UI -->
<script src="{{asset('/resources/')}}/js//plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="{{asset('/resources/')}}/js//plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="{{asset('/resources/')}}/js//plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


<!-- Chart JS -->
<script src="{{asset('/resources/')}}/js//plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="{{asset('/resources/')}}/js//plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="{{asset('/resources/')}}/js//plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="{{asset('/resources/')}}/js//plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="{{asset('/resources/')}}/js//plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="{{asset('/resources/')}}/js//plugin/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('/resources/')}}/js//plugin/jqvmap/maps/jquery.vmap.world.js"></script>

<!-- Sweet Alert -->
<script src="{{asset('/resources/')}}/js//plugin/sweetalert/sweetalert.min.js"></script>

<!-- Atlantis JS -->
<script src="{{asset('/resources/')}}/js//atlantis.min.js"></script>

    <script>
        $(document).ready(function() {
            //password visibility toggle
            $(document).on('click','#icon_eye', function(){
                $(this).toggleClass("fa-eye fa-eye-slash");
                var type = $(this).hasClass("fa-eye") ? "text" : "password";
                $("#password").attr("type", type);
            })
            //notify();

        });
        function notify(){
            //Notify
            $.notify({
                icon: 'flaticon-success',
                title: 'Success',
                message: 'Free Bootstrap 4 Admin Dashboard',
            },{
                type: 'info',
                placement: {
                    from: "top",
                    align: "right"
                },
                time: 1000,
            });
        }

        function validateLogin(){
            let email = document.getElementById("email").value;
            let password = document.getElementById("password").value;
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if(email == "" || email == null || email == undefined)
            {
                //alert("Please Enter Email.");
                displayAlert("warning","btn-warning","Please Enter Email.");
                return false;
            }
            if(email != "" && email != null && email != undefined && !emailPattern.test(email))
            {
                displayAlert("warning","btn-warning","Please Enter valid E-mail.");
                return false;
            }
            if(password == "" || password == null || password == undefined)
            {
                //alert("Please Enter Password.");
                displayAlert("warning","btn-warning","Please Enter Password.");
                return false;
            }
            else
            {
                return true;
            }
        }
        function displayAlert(icon="warning", className="btn-warning", msg="")
        {
            swal(msg, {
                icon : icon,
                buttons: {
                    confirm: {
                        className : 'btn '+className
                    }
                },
                timer: 3000,
            });
        }
    </script>


</body>
</html>

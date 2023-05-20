@extends('layouts.user-app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin-register.css') }}">
@endpush

@section('content')
    <div class="limiter">
        <h1 style="color:blue;text-align:center;padding-top:30px;min-height: 5vh;">Admin Registration
        </h1>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div style="display:flex;justify-content:center;color:red;font-weight:npm600;">
                    <span>{{ $error }}</span>
                </div>
            @endforeach
        @endif

        <div class="container-login100">
            <div class="wrap-login100">
                <form id="registerForm" action="{{ route('create-admin') }}" method="POST">
                    @csrf

                    <span class="login100-form-title p-b-26 pb-2">
                        Notes
                    </span>
                    <ul style="list-style: square !important;font-size:14px">
                        <li>This registration require an email verification.</li>
                        <li>This registration will expire after 3 days.</li>
                        <li>Useing wide screen for dashboard is recommended.</li>
                    </ul>
                    <hr class="mt-5 mb-5">
                    <span class="login100-form-title p-b-48">
                        <i class="zmdi zmdi-font"></i>
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="User name is required">
                        <input class="input100" type="text" name="name" data-spry='username'>
                        <span class="focus-input100" data-placeholder="User name"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.co">
                        <input class="input100" type="text" name="email" data-spry='email'>
                        <span class="focus-input100" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Phone number is invalid">
                        <input class="input100" type="text" name="phone" data-type='phone' data-spry='phone_number'>
                        <span class="focus-input100" data-placeholder="01273542801"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is require">
                        <span class="btn-show-pass">
                            <span class="iconify" data-icon="zmdi:eye"></span>
                        </span>
                        <input id="password" class="input100" type="password" name="password" data-spry='password'>
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password confirmation faild">
                        <span class="btn-show-pass">
                            <span class="iconify" data-icon="zmdi:eye"></span>
                        </span>
                        <input class="input100" type="password" name="password_confirmation" data-type='confirm'
                            data-spry='confirm'>
                        <span class="focus-input100" data-placeholder="Password Confirm"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn" name="register_btn">
                                REGISTER NOW
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.input100').each(function() {
                if ($(this).val() !== "") {
                    $(this).addClass('has-val');
                }
            })
        });

        $(document).ready(function() {
            setTimeout(function() {
                $("#preloader").css("opacity", 0)
            }, 500)
        });

        $('.input100').each(function() {
            $(this).on('blur', function() {
                if ($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                } else {
                    $(this).removeClass('has-val');
                }
            })
        })

        // SHOW PASSWORD FEATURE
        var showPass = 0;
        $('.btn-show-pass').on('click', function() {
            if (showPass == 0) {
                $(this).next('input').attr('type', 'text');
                $(this).find('i').removeClass('zmdi-eye');
                $(this).find('i').addClass('zmdi-eye-off');
                showPass = 1;
            } else {
                $(this).next('input').attr('type', 'password');
                $(this).find('i').addClass('zmdi-eye');
                $(this).find('i').removeClass('zmdi-eye-off');
                showPass = 0;
            }

        });

        // VALIDATION
        var input = $('.validate-input .input100');

        $('#registerForm').on('submit', function(e) {
            var check = true;

            for (var i = 0; i < input.length; i++) {
                if (validate(input[i]) == false) {
                    showValidate(input[i]);
                    check = false;
                }
            }
            if (check) {
                $('#registerForm').find("button[type=submit]").attr("disabled", true);
            }
            return check;
        });

        $('#register .input100').each(function() {
            $(this).focus(function() {
                hideValidate(this);
            });
        });

        function validate(input) {
            if ($(input).val().trim() == '') {
                return false;
            } else if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if (!$(input).val().trim().match(
                        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    )) {
                    return false;
                }
            } else if ($(input).data('type') == 'confirm') {
                if ($(input).val() !== $('#password').val()) {
                    return false;
                }
            } else if ($(input).data('type') == 'phone') {
                const regexPhoneNumber = /^01[0125][0-9]{8}$/gm;

                if ($(input).val().match(regexPhoneNumber)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
    </script>
@endpush
{{-- <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.input100').each(function() {
                if ($(this).val() !== "") {
                    $(this).addClass('has-val');
                }
            })
        });

        $('.input100').each(function() {
            $(this).on('blur', function() {
                if ($(this).val().trim() != "") {
                    $(this).addClass('has-val');
                } else {
                    $(this).removeClass('has-val');
                }
            })
        })

        // SHOW PASSWORD FEATURE
        var showPass = 0;
        $('.btn-show-pass').on('click', function() {
            if (showPass == 0) {
                $(this).next('input').attr('type', 'text');
                $(this).find('i').removeClass('zmdi-eye');
                $(this).find('i').addClass('zmdi-eye-off');
                showPass = 1;
            } else {
                $(this).next('input').attr('type', 'password');
                $(this).find('i').addClass('zmdi-eye');
                $(this).find('i').removeClass('zmdi-eye-off');
                showPass = 0;
            }

        });

        // VALIDATION
        var input = $('.validate-input .input100');

        $('#registerForm').on('submit', function(e) {
            var check = true;

            for (var i = 0; i < input.length; i++) {
                if (validate(input[i]) == false) {
                    showValidate(input[i]);
                    check = false;
                }
            }
            console.log(check);
            return check;
        });

        $('#register .input100').each(function() {
            $(this).focus(function() {
                hideValidate(this);
            });
        });

        function validate(input) {
            if ($(input).val().trim() == '') {
                return false;
            } else if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
                if (!$(input).val().trim().match(
                        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                    )) {
                    return false;
                }
            } else if ($(input).data('type') == 'confirm') {
                if ($(input).val() !== $('#password').val()) {
                    return false;
                }
            } else if ($(input).data('type') == 'phone') {
                const regexPhoneNumber = /^01[0125][0-9]{8}$/gm;

                if ($(input).val().match(regexPhoneNumber)) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        function showValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).addClass('alert-validate');
        }

        function hideValidate(input) {
            var thisAlert = $(input).parent();

            $(thisAlert).removeClass('alert-validate');
        }
    </script> --}}
{{-- </body>

</html> --}}

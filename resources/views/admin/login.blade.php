<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title> 
    @include('admin.layouts.header-links')
</head>

<body>
    <main class="loginPage">
        <div class="loginPage__inner d-flex align-items-center justify-content-center flex-column">

            <div class="loginPage__box bg-white text-center">
                <h1>Login</h1>
                <form method="post" id="loginForm" action="{{ route('admin/login') }}">
                    @csrf
                    <div class="form-group focusField">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                        <div class="error-help-block text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label>Email ID</label>
                    </div>
                    <div class="form-group focusField">
                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                        @error('password')
                        <div class="error-help-block text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label>Password</label>
                    </div>
                    <div class="d-flex justify-content-between  form-group">
                        <div class="custom-control custom-checkbox">
                              <input type="checkbox" class="custom-control-input" id="customCheck1">
                              <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                        <!-- <a href="forgot-password.php" class="link">Forgot password?</a> -->
                    </div> 
                    <button type="submit" class="btn btn-danger btn-lg ripple-effect w-100">LOGIN</button>
                </form>
            </div>
        </div>
    </main> 
    @include('admin.layouts.footer-links')

    <script>
        @if(Session::has('logout_success'))
            _toast.success("{{Session::get('logout_success')}}");
        @endif
        (function login() {

            $("#loginForm input[name=email]").focus(function(e) {
                $("#loginForm input[name=email]").closest('.form-group').find('.error-help-block').html('')
            });
            $("#loginForm input[name=password]").focus(function(e) {
                $("#loginForm input[name=password]").closest('.form-group').find('.error-help-block').html('')
            });
        })();
    </script>
    
</body>

</html>
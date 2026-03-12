    @include('clients.blocks.header')

    <div class="login-template">
        <div class="main">

            <!-- Sing in  Form -->
            <section class="sign-in">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure><img src="{{ asset('clients/assets/images/login/signin-image.jpg') }}"
                                    alt="sing up image"></figure>
                            <a href="javascript:void(0)" class="signup-image-link" id="show-signup">Create an account</a>
                        </div>

                        <div class="signin-form">
                            <h2 class="form-title">Đăng nhập</h2>
                            <form action="{{ route('user-login') }}" method="POST" class="login-form" id="login-form">
                                <div class="form-group">
                                    <label for="username_login"><i
                                            class="zmdi zmdi-account material-icons-name"></i></label>
                                    <input type="text" name="username_login" id="username_login"
                                        placeholder="Tên đăng nhập" required />
                                </div>
                                <div class="invalid-feedback" style="margin-top:-15px" id="validate_username"></div>
                                @csrf
                                <div class="form-group">
                                    <label for="password_login"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password_login" id="password_login"
                                        placeholder="Mật khẩu" required />
                                </div>
                                <div class="invalid-feedback" style="margin-top:-15px" id="validate_password"></div>
                                <div class="form-group form-button">
                                    <input type="submit" name="signin" id="signin" class="form-submit"
                                        value="Đăng nhập" />
                                </div>
                            </form>
                            <div class="social-login">
                                <span class="social-label">Đăng nhập với</span>
                                <ul class="socials">
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a>
                                    </li>
                                    <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="{{ route('login-google') }}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- Sign up form -->
            <section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Đăng ký</h2>
                            <form action="{{ route('register') }}" method="POST" class="register-form" id="register-form" >
                               <div class="form-group">
                                <label for="username_register"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username_register" id="username_register" placeholder="Tên tài khoản" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_username_regis"></div>
                            @csrf
                            <div class="form-group">
                                <label for="email_register"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email_register" id="email_register" placeholder="Email" required/>
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_email_regis"></div>
                            <div class="form-group">
                                <label for="password_register"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_register" id="password_register" placeholder="Mật khẩu" required/>
                               
                            </div>
                             <div class="invalid-feedback" style="margin-top:-15px" id="validate_password_regis"></div>
                           
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Nhập lại mật khẩu" required/>
                                
                            </div>
                            <div class="invalid-feedback" style="margin-top:-15px" id="validate_repass"></div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit"
                                    value="Đăng ký" />
                            </div>
                            </form>
                        </div>
                        <div class="signup-image">
                            <figure><img src="{{ asset('clients/assets/images/login/signup-image.jpg') }}"
                                    alt="sing up image"></figure>
                            <a href="javascript:void(0)" class="signup-image-link" id="show-signin">Tôi đã có tài
                                khoản</a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- js --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Khi nhấn vào "Create an account"
            $('#show-signup').on('click', function() {
                // Ẩn form Đăng nhập mờ dần
                $('.sign-in').fadeOut(300, function() {
                    // Sau khi ẩn xong, hiện form Đăng ký lên
                    $('.signup').fadeIn(300);
                });
            });

            // 2. Khi nhấn vào "I am already member"
            $('#show-signin').on('click', function() {
                // Ẩn form Đăng ký mờ dần
                $('.signup').fadeOut(300, function() {
                    // Sau khi ẩn xong, hiện lại form Đăng nhập
                    $('.sign-in').fadeIn(300);
                });
            });
        });
    </script>


    @include('clients.blocks.footer')

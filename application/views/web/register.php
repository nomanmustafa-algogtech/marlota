<main class="main login-page">
           

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li>Login</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class="page-content">
                <div class="container">
                    <div class="login-popup">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li class="nav-item">
                                    <a href="#sign-in" class="nav-link">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sign-up" class="nav-link active">Sign Up</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane" id="sign-in">
                                    <div class="alert alert-error alert-bg alert-inline show-code-action" id="sign-in-error" style="display:none"></div>
                                    <div class="alert alert-success alert-bg alert-inline show-code-action" id="sign-in-success" style="display:none"></div>
                                    <form id="sign-in-form" method="post" onsubmit="return login();">
                                        <div class="form-group">
                                            <label>Mobile No. <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="username" id="username" required>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password" required>
                                        </div>
                                        <div class="form-checkbox d-flex align-items-center justify-content-between">
                                            <input type="checkbox" class="custom-checkbox" id="remember" name="remember">
                                            <label for="remember">Remember me</label>
                                            <script>
                                                function showResetForm(){
                                                    $("#sign-in").removeClass("active");
                                                    $("#forgot-password").addClass("active");
                                                    return false;
                                                }
                                                function showSignInForm(){
                                                    $("#forgot-password").removeClass("active");
                                                    $("#sign-in").addClass("active");
                                                    return false;
                                                }
                                                function showSignUpForm(){
                                                    $("#otp-section").removeClass("active");
                                                    $("#sign-up").addClass("active");
                                                    return false;
                                                }
                                            </script>
                                            <a href="javascript:void(0)" onclick="showResetForm();">Forgot your password?</a>
                                        </div>
                                        <button type="submit" name="signin" class="btn btn-primary">Sign In</button>
                                    </form>
                                </div>
                                <div class="tab-pane" id="forgot-password">
                                    <div class="alert alert-error alert-bg alert-inline show-code-action" id="reset-error" style="display:none"></div>
                                    <div class="alert alert-success alert-bg alert-inline show-code-action" id="reset-success" style="display:none"></div>
                                    <form id="forgot-password-form" method="post" action="" onsubmit="return resetpassword();">
                                        <!--<div class="form-group">-->
                                        <!--    <label>Email address <span style="color:red">*</span></label>-->
                                        <!--    <input type="email" class="form-control" name="email" id="email" required>-->
                                        <!--</div>-->
                                        <div class="form-group mb-5">
                                            <label>Phone <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="phone" id="phone" required>
                                        </div>
                                        <button type="submit" name="sendpassword" id="sendpassword" class="btn btn-primary">Reset Password</button>
                                        <center style="margin-top: 20px;">
                                             <a href="javascript:void(0)" onclick="showSignInForm();">Go Back</a>
                                        </center>
                                       
                                    </form>
                                </div>
                                
                                <div class="tab-pane" id="otp-section" >
                                    <div class="alert alert-error alert-bg alert-inline show-code-action" id="otp-error" style="display:none"></div>
                                    <div class="alert alert-success alert-bg alert-inline show-code-action" id="otp-success" style="display:none"></div>
                                    <form id="otp-form" method="post" action="" onsubmit="return otpverify();">
                                        <!--<div class="form-group">-->
                                        <!--    <label>Email OTP (<span id="email-otp"></span>)<span style="color:red">*</span></label>-->
                                        <!--    <input type="text" class="form-control" name="email_otp" id="email_otp" required>-->
                                        <!--</div>-->
                                        <div class="form-group mb-5">
                                            <label>Phone OTP (<span id="phone-otp"></span>) <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="phone_otp" id="phone_otp" required>
                                        </div>
                                        <button type="submit" name="verify_otp" id="verifyOtp" class="btn btn-primary">Verify Account</button>
                                        <center style="margin-top: 20px;">
                                             <a href="javascript:void(0)" onclick="showSignUpForm();">Change Details</a>
                                        </center>
                                       
                                    </form>
                                </div>
                                
                                <div class="tab-pane active" id="sign-up">
                                    <div class="alert alert-error alert-bg alert-inline show-code-action" id="sign-up-error" style="display:none"></div>
                                    <div class="alert alert-success alert-bg alert-inline show-code-action" id="sign-up-success" style="display:none"></div>
                                    <form id="sign-up-form" method="post" action="" onsubmit="return register();">
                                        <div class="form-group">
                                            <label>Full Name <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="full_name" id="full_name-register" required>
                                        </div>
                                        <!--<div class="form-group">-->
                                        <!--    <label>Email address <span style="color:red">*</span></label>-->
                                        <!--    <input type="email" class="form-control" name="email" id="email-register" required>-->
                                        <!--</div>-->
                                         <div class="form-group mb-5">
                                            <label>Mobile No <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" name="phone" id="phone-register" required>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label>Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="password" id="password-register" required>
                                        </div>
                                       
                                        <div class="form-group mb-5">
                                            <label>City <span style="color:red">*</span></label>
                                            <select class="form-control" name="city" id="city-register" required>
                                                <? include('includes/cities.php');?>
                                            </select>
                                        </div>
                                        <?php if($this->settings['mlm_system']==1){ ?>
                                        <div class="form-group mb-5">
                                            <label>Referral code <span style="color:red">*</span></label>
                                            <input type="text" class="form-control" onkeyup="changeSignupText(this.value)" onchange="changeSignupText(this.value)" name="referral" id="referral-register" <?php if(isset($_COOKIE['referral_code'])){ ?> value="<?=$_COOKIE['referral_code'];?>" readonly<?php } ?>>
                                        </div>
                                        <?php } ?>
                                        <p>Your personal data will be used to support your experience 
                                            throughout this website, to manage access to your account, 
                                            and for other purposes described in our <a href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary">privacy policy</a>.</p>
                                        <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                            <input type="checkbox" class="custom-checkbox" id="agree-register" name="agree" required="">
                                            <label for="agree" class="font-size-md">I agree to the <a  href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary font-size-md">privacy policy</a></label>
                                        </div>
                                        <button type="submit" name="signup" id="btnSignup" class="btn btn-primary"><?php if(isset($_COOKIE['referral_code'])){ ?>Sign Up<?php }else{ ?>Sign Up Without Referral<?php } ?></button>
                                    </form>
                                </div>
                            </div>
                            <p class="text-center">Follow Us</p>
                            <div class="social-icons social-icon-border-color d-flex justify-content-center">
                                <a href="https://www.facebook.com/topaonlineshopping" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="https://www.instagram.com/topaonlineshopping/" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
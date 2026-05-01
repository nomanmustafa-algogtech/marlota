<style>
    .login-popup #sign-up-error p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-up-success p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-in-error p{
        margin-bottom: 0px !important;
    }
    .login-popup #sign-in-success p{
        margin-bottom: 0px !important;
    }
    
</style>





<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#sign-in" class="nav-link active">Sign In</a>
            </li>
            <li class="nav-item">
                <a href="#sign-up" class="nav-link">Sign Up</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="sign-in">
                <div class="alert alert-error alert-bg alert-inline show-code-action" id="sign-in-error" style="display:none"></div>
                <div class="alert alert-success alert-bg alert-inline show-code-action" id="sign-in-success" style="display:none"></div>
                <form id="sign-in-form" method="post" onsubmit="return login();">
                    <div class="form-group">
                        <label>Email Address. <span style="color:red">*</span></label>
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
                    <div class="form-group">
                        <label>Email address <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <!--<div class="form-group mb-5">-->
                    <!--    <label>Phone <span style="color:red">*</span></label>-->
                    <!--    <input type="text" class="form-control" name="phone" id="phone" required>-->
                    <!--</div>-->
                    <button type="submit" name="sendpassword" id="sendpassword" class="btn btn-primary">Reset Password</button>
                    <center style="margin-top: 20px;">
                         <a href="javascript:void(0)" onclick="showSignInForm();">Go Back</a>
                    </center>
                   
                </form>
            </div>
            
            <!--<div class="tab-pane" id="otp-section" style="display: none;">-->
                <!-- OTP Verification Form (Removed) -->
            <!--</div>-->
            
            <div class="tab-pane" id="sign-up">
                <div class="alert alert-error alert-bg alert-inline show-code-action" id="sign-up-error" style="display:none"></div>
                <div class="alert alert-success alert-bg alert-inline show-code-action" id="sign-up-success" style="display:none"></div>
                <form id="sign-up-form" method="post" action="" onsubmit="return register();">
                    <div class="form-group">
                        <label>Full Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="full_name" id="full_name-register" required>
                    </div>
                    <div class="form-group">
                        <label>Email address <span style="color:red">*</span></label>
                        <input type="email" class="form-control" name="email" id="email-register" required>
                    </div>
                    <div class="form-group mb-5">
                        <label>Mobile No <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone-register" required>
                    </div>
                    <div class="form-group mb-5">
                        <label>Country <span style="color:red">*</span></label>
                        <select class="form-control" name="country" id="country-register" required>
                            <option value="">Select Country</option>  
                            <?php $countries = $this->db->select("*")->from('app_countries')->order_by('country_name', 'asc')->get()->result_array();
                            foreach($countries as $country){ ?>
                            <option value="<?=$country['country_name'];?>"><?=$country['country_name'];?></option>  
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label>Password <span style="color:red">*</span></label>
                        <input type="password" class="form-control" name="password" id="password-register" required>
                    </div>
                    
                    <?php if($this->settings['mlm_system']==1){ ?>
                    <div class="form-group mb-5">
                        <label>Referral code <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="referral" id="referral-register" onkeyup="changeSignupText(this.value)" onchange="changeSignupText(this.value)" <?php if(isset($_COOKIE['referral_code'])){ ?> value="<?=$_COOKIE['referral_code'];?>" readonly<?php }else{ ?> value="" <?php } ?>>
                    </div>
                    <?php } ?>
                    <p>Your personal data will be used to support your experience 
                        throughout this website, to manage access to your account, 
                        and for other purposes described in our <a href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary">privacy policy</a>.</p>
                    <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                        <input type="checkbox" class="custom-checkbox" id="agree-register" name="agree" required="">
                        <label for="agree" class="font-size-md">I agree to the <a  href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary font-size-md">privacy policy</a></label>
                    </div>
                    <button type="submit" name="signup" id="btnSignup" class="btn btn-primary">Sign Up</button>
                    <input type="hidden" id="redirectUrl" value="#sign-in">
                </form>
            </div>
        </div>
        
    </div>
</div>
<script>
    function register() {
        // Your registration logic here
        
        // Display success message
        $('#sign-up-success').html('<p>Registered successfully!</p>').show();
        
        // Redirect to sign-in tab after a short delay
        var redirectUrl = $('#redirectUrl').val();
        setTimeout(function() {
            $('.nav-link[href="' + redirectUrl + '"]').tab('show');
        }, 1000); // Adjust delay as needed
        
        // Prevent form submission
        return false;
    }
</script>





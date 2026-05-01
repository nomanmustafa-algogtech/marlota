<section class="login footer-padding">
  <div class="container">
    <div class="login-section">
      <div class="review-form">
        <h5 class="comment-title">Log In</h5>

        <!-- Alerts -->
        <div class="alert alert-danger" id="sign-in-error" style="display:none"></div>
        <div class="alert alert-success" id="sign-in-success" style="display:none"></div>

        <form id="sign-in-form" method="post" onsubmit="return login();">
          <div class="review-inner-form">
            <div class="review-form-name">
              <label for="username" class="form-label">Email Address <span style="color:red">*</span></label>
              <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="review-form-name">
              <label for="password" class="form-label">Password <span style="color:red">*</span></label>
              <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="review-form-name checkbox">
              <div class="checkbox-item">
                <input type="checkbox" name="remember_me" id="remember_me" value="1">
                <label for="remember_me">Remember Me</label>
              </div>
              <div class="forget-pass">
                <a href="<?= base_url(); ?>/user/forgotpassword">Forgot your password?</a>
              </div>
            </div>
          </div>

          <div class="login-btn text-center">
            <button type="submit" id="btnLogin" class="shop-btn">Log In</button>
            <span class="shop-account">Don't have an account? 
              <a href="<?= base_url(); ?>/user/register">Sign Up Free</a>
            </span>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
function login() {
  $(".preloader").show();
  var form = $("#sign-in-form");

  $("#btnLogin").html('Logging in...').attr("disabled", true);

  $.ajax({
    type: "POST",
    url: '<?=base_url();?>/authentication/login/',
    data: form.serialize(),
    success: function(data) {
      $(".preloader").hide();
      $("#btnLogin").html('Log In').removeAttr("disabled");

      if (data == 'SUCCESS') {
        $("#sign-in-success").html("Logged in successfully. Redirecting...").show();
        $("#sign-in-error").hide();
        setTimeout(function() {
          window.location.href = '<?=base_url();?>user/account';
        }, 3000);
      } else {
        $("#sign-in-error").html(data).show();
        $("#sign-in-success").hide();
        setTimeout(function() { $('#sign-in-error').fadeOut(400); }, 5000);
      }
    }
  });

  return false;
}
</script>

<section class="login account footer-padding">
  <div class="container">
    <div class="login-section account-section">

     

      <form id="sign-up-form" method="post" action="" onsubmit="return register();">
        <div class="review-form">
					 <!-- Alerts -->
					<div class="alert alert-danger alert-bg alert-inline" id="sign-up-error" style="display:none"></div>
					<div class="alert alert-success alert-bg alert-inline" id="sign-up-success" style="display:none"></div>
          <h5 class="comment-title">Create Account</h5>

          <div class="review-form-name">
            <label for="full_name-register" class="form-label">Full Name <span style="color:red">*</span></label>
            <input type="text" name="full_name" id="full_name-register" required class="form-control" placeholder="First Name">
          </div>

          <div class="review-form-name">
            <label for="email-register" class="form-label">Email address <span style="color:red">*</span></label>
            <input type="email" name="email" id="email-register" class="form-control" required placeholder="user@gmail.com">
          </div>

          <div class="review-form-name">
            <label for="phone-register" class="form-label">Mobile No <span style="color:red">*</span></label>
            <input type="text" name="phone" id="phone-register" class="form-control" required>
          </div>

          <div class="review-form-name">
            <label for="country-register" class="form-label">Country <span style="color:red">*</span></label>
            <select name="country" id="country-register" class="form-select" required>
              <option value="">Select Country</option>
              <?php $countries = $this->db->select("*")->from('app_countries')->order_by('country_name', 'asc')->get()->result_array();
              foreach($countries as $country){ ?>
                <option value="<?=$country['country_name'];?>"><?=$country['country_name'];?></option>  
              <?php } ?>
            </select>
          </div>

          <div class="review-form-name">
            <label for="password-register" class="form-label">Password <span style="color:red">*</span></label>
            <input type="password" name="password" id="password-register" class="form-control" required>
          </div>

          <p class="mb-3">
            Your personal data will be used to support your experience throughout this website,
            to manage access to your account, and for other purposes described in our 
            <a href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary">privacy policy</a>.
          </p>

          <div class="login-btn text-center">
            <button type="submit" name="signup" id="btnSignup" class="shop-btn">Sign Up</button>
            <span class="shop-account">Already have an account? <a href="<?= base_url(); ?>/user/login">Log In</a></span>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<script>
function register() {
  $(".preloader").show();
  var form = $("#sign-up-form");

  $("#btnSignup").html('Creating Account...').attr("disabled", true);

  $.ajax({
    type: "POST",
    url: '<?=base_url();?>/authentication/register/',
    data: form.serialize(),
    success: function(data) {
      $(".preloader").hide();
      $("#btnSignup").html('Sign Up').removeAttr("disabled");

      if (data == 'SUCCESS') {
        $('#sign-up-success').html('<p>Registered successfully! Please verify your email.</p>').show();
        $("#sign-up-error").hide();
        form.trigger("reset");
				// Redirect to login page after 3 seconds
        setTimeout(function() {
          window.location.href = "<?= base_url('user/login'); ?>";
        }, 3000);
      } else {
        $("#sign-up-error").html('<p>' + data + '</p>').show();
        $("#sign-up-success").hide();
        setTimeout(function() { $('#sign-up-error').fadeOut(400); }, 5000);
      }
    }
  });

  return false;
}
</script>

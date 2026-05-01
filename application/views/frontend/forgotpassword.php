<!--------------- login-section --------------->
<section class="login footer-padding">
  <div class="container">
    <div class="login-section">
      <div class="review-form review-form-forgot-password">
        <h5 class="comment-title">Reset Password</h5>

        <!-- ✅ Add Success & Error placeholders -->
        <div id="reset-success" class="alert alert-success" style="display:none;"></div>
        <div id="reset-error" class="alert alert-danger" style="display:none;"></div>

        <form id="forgot-password-form" method="post" action="" onsubmit="return resetpassword();">
          <div class="review-inner-form">
            <div class="review-form-name">
              <label for="email" class="form-label">Email Address <span style="color:red">*</span></label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
          </div>
          <div class="login-btn text-center">
            <button type="submit" name="sendpassword" id="sendpassword" class="shop-btn">
              Reset Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!--------------- login-section-end --------------->

<script>
function resetpassword() {
  $(".preloader").show();
  var form = $("#forgot-password-form");

  $("#sendpassword").html('Submitting.....').attr("disabled", "disabled");

  $.ajax({
    type: "POST",
    url: '<?= base_url(); ?>/authentication/sendpassword/',
    data: form.serialize(),
    success: function(data) {
      $(".preloader").hide();
      $("#sendpassword").html('Reset Password').removeAttr("disabled");

      if (data == 'SUCCESS') {
        form.trigger("reset");
        $("#reset-success").html("A new password has been sent to your registered email address.").show();
        $("#reset-error").hide();
        form.hide();

         // Redirect to login page after 3 seconds
        setTimeout(function() {
          window.location.href = "<?= base_url('user/login'); ?>";
        }, 3000);

      } else {
        $("#reset-error").html(data).show();
        $("#reset-success").hide();
        setTimeout(function() {
          $('#reset-error').fadeOut(400);
        }, 5000);
      }
    }
  });
  return false;
}
</script>

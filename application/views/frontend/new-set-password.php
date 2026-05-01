<section class="login footer-padding">
	<div class="container">
		<div class="login-section">
			<div class="review-form">
				<h5 class="comment-title">New Password</h5>

				<!-- Alerts -->
				<div class="alert alert-danger" id="sign-in-error" style="display:none"></div>
				<div class="alert alert-success" id="sign-in-success" style="display:none"></div>
				<p class="mb-5" style="color:red;text-align:center">Please choose your own password to secure your account.</p>
				<?= $this->CI->flash_message(); ?>
				<form action="" method="post">
					<div class="review-inner-form">
						<div class="review-form-name">
							<label for="username" class="form-label">New Password <span style="color:red">*</span></label>
							<input type="text" name="newpassword" id="newpassword" class="form-control" required>
						</div>
						<div class="review-form-name">
							<label for="password" class="form-label">Confirm Password <span style="color:red">*</span></label>
							<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
						</div>
					</div>
					<div class="login-btn text-center">
						<button type="submit" id="btnLogin" class="shop-btn">Submit</button>

					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
    $("form").on("submit", function(e){
        e.preventDefault();

        $.ajax({
            url: "<?= base_url('user/setnewpassword') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function(){
                $("#btnLogin").prop("disabled", true).text("Processing...");
                $("#sign-in-error").hide();
                $("#sign-in-success").hide();
            },
            success: function(response){
                if(response.status === "success"){
                    $("#sign-in-success").text(response.message).fadeIn();
                    $("#sign-in-error").hide();
                    $("form")[0].reset();

                    // optional redirect
                    setTimeout(() => {
                        window.location.href = "<?= base_url('user/account') ?>";
                    }, 2000);
                } else {
                    $("#sign-in-error").text(response.message).fadeIn();
                }
            },
            error: function(){
                $("#sign-in-error").text("Something went wrong, try again.").fadeIn();
            },
            complete: function(){
                $("#btnLogin").prop("disabled", false).text("Submit");
            }
        });
    });
});
</script>

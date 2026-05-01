<div class="content-page">
	<div class="content">
		<div class="container-fluid">
			<div class="card shadow-lg rounded-4">
				<div class="card-header bg-primary text-white">
					<h4 class="mb-0">Stripe API Settings</h4>
				</div>
				<div class="card-body">
					<form id="stripeSettingsForm">
						<div class="mb-3">
							<label for="stripe_pk" class="form-label">Publishable Key</label>
							<input type="text" class="form-control" id="stripe_pk" name="stripe_pk"
								value="<?= htmlspecialchars($stripe_pk); ?>" required>
						</div>
						<div class="mb-3">
							<label for="stripe_sk" class="form-label">Secret Key</label>
							<input type="text" class="form-control" id="stripe_sk" name="stripe_sk"
								value="<?= htmlspecialchars($stripe_sk); ?>" required>
						</div>
						<button type="submit" class="btn btn-success rounded-pill px-4">Save</button>
					</form>
					<div id="responseMsg" class="mt-3"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$("#stripeSettingsForm").on("submit", function(e) {
		e.preventDefault();

		$.ajax({
			url: "<?= base_url('admin/stripe_settings/save'); ?>",
			type: "POST",
			data: $(this).serialize(),
			dataType: "json",
			success: function(res) {
				if (res.status === "success") {
					$("#responseMsg").html('<div class="alert alert-success">' + res.message + '</div>');
				} else {
					$("#responseMsg").html('<div class="alert alert-danger">Something went wrong!</div>');
				}
			},
			error: function() {
				$("#responseMsg").html('<div class="alert alert-danger">Server error!</div>');
			}
		});
	});
</script>

</body>

</html>

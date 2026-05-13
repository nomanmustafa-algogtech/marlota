<?php
$userid = (int)$this->session->userdata('user_id');
$is_loggedin = (bool)$this->session->userdata('user_loggedin');

if (!isset($user) || !is_array($user)) {
	$user = $is_loggedin
		? $this->db->select('*')->from('app_users')->where('id', $userid)->get()->row_array()
		: [];
}

if (!isset($billing) || !is_array($billing)) {
	$billing = $is_loggedin
		? $this->db->query("SELECT * FROM app_address where user_id = '$userid' && type = '1' ORDER BY id DESC LIMIT 1")->row_array()
		: [];
}

$subtotal = 0;
$vat_rate = 0.20;

foreach ($cart as $row) {
	$subtotal += ((float)$row['qty'] * (float)$row['price']);
}

$vat = $subtotal * $vat_rate;
$grand_total = $subtotal + $vat;

?>

	<!--------------- blog-tittle-section---------------->
	<section class="blog about-blog">
		<div class="container">
			<div class="blog-bradcrum">
				<span><a href="<?= base_url(); ?>">Home</a></span>
				<span class="devider">/</span>
				<span><a href="<?= base_url(); ?>checkout">Checkout</a></span>
			</div>
			<div class="blog-heading about-heading">
				<h1 class="heading">Checkout</h1>
			</div>
		</div>
	</section>
	<!--------------- blog-tittle-section-end---------------->

	<!--------------- checkout-section---------------->
	<section class="checkout product footer-padding">
		<div class="container">
			<div class="checkout-section">
				<div class="row gy-5">
					<div class="col-lg-6">
						<div class="checkout-wrapper">
							<div class="account-section billing-section">
								<h5 class="wrapper-heading">Billing & Shipping Details</h5>
									<form class="form checkout-form" id="shipping_details" action="" onsubmit="return false;" method="post">
										<div class="review-form">

											<div class="review-form-name">
												<label for="fname" class="form-label">Full Name <span style="color:red">*</span></label>
												<input type="text" id="full_name" name="full_name" class="form-control" 
													placeholder="Full Name" 
													value="<?= isset($billing['full_name']) ? $billing['full_name'] : (isset($user['full_name']) ? $user['full_name'] : ''); ?>" 
													required>

											</div>

											<div class="account-inner-form mt-4">
												<div class="review-form-name">
													<label for="email" class="form-label">Email <span style="color:red">*</span></label>
													<input type="email" name="email" id="email" class="form-control"
														placeholder="user@gmail.com"
														value="<?= isset($billing['email']) ? $billing['email'] : (isset($user['email']) ? $user['email'] : ''); ?>" 
														required>
												</div>

												<div class="review-form-name">
													<label for="phone" class="form-label">Phone <span style="color:red">*</span></label>
													<input type="tel" id="phone" name="phone" class="form-control"
														placeholder="+880388**0899"
														value="<?= isset($billing['phone']) ? $billing['phone'] : (isset($user['phone']) ? $user['phone'] : ''); ?>" 
														required>
												</div>
											</div>

											<div class="review-form-name">
												<label for="country" class="form-label">Country <span style="color:red">*</span></label>
												<select id="country" name="country" required class="form-select">
													<option>Choose...</option>
													<?php 
													$countries = $this->db->select("*")
																		->from('app_countries')
																		->order_by('country_name', 'asc')
																		->get()
																		->result_array();

													$selected_country = isset($billing['country']) ? $billing['country'] : (isset($user['country']) ? $user['country'] : '');

													foreach ($countries as $country) { 
													?>
														<option value="<?= $country['country_name']; ?>" 
															<?= ($selected_country === $country['country_name']) ? 'selected' : ''; ?>>
															<?= $country['country_name']; ?>
														</option>
													<?php } ?>
												</select>
											</div>

											<div class="review-form-name address-form">
												<label for="address" class="form-label">Address <span style="color:red">*</span></label>
												<input type="text" name="address" id="address" class="form-control"
													placeholder="Enter your Address" 
													value="<?= isset($billing['address']) ? $billing['address'] : (isset($user['address']) ? $user['address'] : ''); ?>" required>
											</div>

											<div class="account-inner-form">
												<div class="review-form-name city-form">
													<label for="city" class="form-label">City <span style="color:red">*</span></label>
													<input type="text" id="city" name="city" class="form-control"
														placeholder="Enter your City" 
														value="<?= isset($billing['city']) ? $billing['city'] : (isset($user['city']) ? $user['city'] : ''); ?>" required>
												</div>

												<div class="review-form-name zipcode-form">
													<label for="zipcode" class="form-label">Postal Code <span style="color:red">*</span></label>
													<input type="text" id="zipcode" name="zipcode" class="form-control"
														placeholder="Enter your postal code" 
														value="<?= isset($billing['zipcode']) ? $billing['zipcode'] : (isset($user['zipcode']) ? $user['zipcode'] : ''); ?>" required>
												</div>
											</div>

											<div class="form-group mt-3">
												<label for="order-notes">Order notes (optional)</label>
												<textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30" rows="4"
													placeholder="Notes about your order, e.g special notes for delivery"></textarea>
											</div>

											<input type="hidden" 
												value="<?= number_format(($grand_total < 0 ? 0 : $grand_total), 2, '.', ''); ?>" 
												id="total_payable" />
												<input type="hidden" id="checkout_type" name="checkout_type" 
       												value="<?= $this->session->userdata('user_loggedin') ? 'user' : 'guest'; ?>">


										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="checkout-wrapper">
								<div class="account-section billing-section">
									<h5 class="wrapper-heading">Order Summary</h5>
									<div class="order-summery">
										<div class="subtotal product-total">
											<h5 class="wrapper-heading">PRODUCT</h5>
											<h5 class="wrapper-heading">QTY</h5>
											<h5 class="wrapper-heading">TOTAL</h5>
										</div>
										<hr>
										<div class="subtotal product-total">
											<ul class="product-list">
												<?php
													foreach ($cart as $row) {
														$total = (float)$row['qty'] * (float)$row['price'];
														$product = $this->db->query("SELECT * FROM app_products WHERE id = '{$row['product_id']}'")->row_array();
													?>
													<li>
														<div class="product-info">
															<h5 class="wrapper-heading"><?= $row['sku']; ?></h5>
															
														</div>

														<div class="product-quantity">
															<h5 class="wrapper-heading"><?= $row['qty']; ?></h5>
														</div>

														<div class="price">
															<h5 class="wrapper-heading">£<?= number_format($total, 2); ?></h5>
														</div>
													</li>
												<?php } ?>
												
											</ul>
										</div>
										<hr>
										
									
											<div class="subtotal product-total">
											<h5 class="wrapper-heading">SUBTOTAL</h5>
											<h5 class="wrapper-heading">£<?= number_format($subtotal, 2); ?></h5>
										</div>
										<div class="subtotal product-total">
											<h5 class="wrapper-heading">VAT (20%)</h5>
											<h5 class="wrapper-heading">£<?= number_format($vat, 2); ?></h5>
										</div>
										
								
									
										<hr>
										<div class="subtotal total">
											<h5 class="wrapper-heading">TOTAL Payable</h5>
											<h5 class="wrapper-heading price">£<?= number_format(($grand_total < 0 ? 0 : $grand_total), 2); ?>
											</h5>
																
											
										</div>
										<script src="https://js.stripe.com/v3/"></script>



										<!-- Spinner Overlay -->
										<div id="spinner-overlay" class="d-none">
											<div class="spinner-border text-warning" role="status">
												<span class="visually-hidden">Loading...</span>
											</div>
										</div>

										<div class="subtotal payment-type">
											<button type="button" onclick="paywithcod();" class="btn btn-dark btn-block btn-rounded payment-button" style="margin-bottom:15px">Cash On Delivery</button>
											<button type="button" onclick="openPaymentModal();" 
												class="btn btn-dark btn-block btn-rounded payment-button" 
												style="margin-bottom:15px;border-color: #03a9f4;background-color: #03a9f4;">
												<i class="w-icon-wallet"></i> Credit/Debit Card
											</button>
											

											<div id="paypal-button-container"></div>
										</div>
										
										
										<!-- Payment Modal --> 
										<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-lg modal-dialog-centered">
												<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="paymentModalLabel">Complete Payment</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div id="card-element" class="mb-3"></div>
													<div id="card-errors" class="text-danger mt-2"></div>
													<div id="payment-success" class="alert alert-success d-none"></div>
												</div>
												<div class="modal-footer">
													<button id="submitPayment" class="btn btn-primary">Pay Now</button>
												</div>
												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					
				</div>
			</div>
		</div>
	</section>

<style>
	:root {
		--ui-surface: #ffffff;
		--ui-soft: #f8fafc;
		--ui-border: #e5e7eb;
		--ui-text: #111827;
		--ui-muted: #6b7280;
		--ui-brand: #03a9f4;
		--ui-brand-dark: #0284c7;
		--ui-dark: #1f2937;
		--ui-shadow: 0 10px 28px rgba(17, 24, 39, 0.08);
	}

	.blog.about-blog .container,
	.checkout.product .container {
		background: var(--ui-surface);
		border: 1px solid var(--ui-border);
		border-radius: 16px;
		box-shadow: var(--ui-shadow);
	}

	.blog.about-blog .container {
		background: #3a1b76;
		border-color: #3a1b76;
		padding: 22px;
	}

	.checkout.product .container {
		padding: 24px;
	}

	.blog-bradcrum span,
	.blog-bradcrum a {
		color: rgba(255, 255, 255, 0.88);
	}

	.blog-bradcrum .devider {
		color: rgba(255, 255, 255, 0.6);
	}

	.blog-heading .heading {
		color: #ffffff;
		font-weight: 800;
	}

	.checkout-wrapper .account-section {
		border: 1px solid var(--ui-border);
		border-radius: 14px;
		background: var(--ui-surface);
		padding: 18px;
	}

	.wrapper-heading {
		color: var(--ui-text);
		font-weight: 800;
	}

	.form-label,
	#order-notes + label {
		color: var(--ui-text);
		font-weight: 600;
	}

	.checkout-form .form-control,
	.checkout-form .form-select,
	#order-notes {
		border: 1px solid var(--ui-border);
		border-radius: 10px;
		background: #fff;
		color: var(--ui-text);
		min-height: 44px;
		box-shadow: none;
	}

	.checkout-form .form-control:focus,
	.checkout-form .form-select:focus,
	#order-notes:focus {
		border-color: var(--ui-brand);
		box-shadow: 0 0 0 3px rgba(3, 169, 244, 0.14);
	}

	#order-notes {
		min-height: 110px;
	}

	.order-summery {
		border: 1px solid var(--ui-border);
		border-radius: 12px;
		padding: 14px;
		background: var(--ui-soft);
	}

	.order-summery .subtotal {
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 8px;
	}

	.order-summery .product-list {
		list-style: none;
		padding-left: 0;
		margin-bottom: 0;
	}

	.order-summery .product-list li {
		display: grid;
		grid-template-columns: 1fr auto auto;
		gap: 12px;
		padding: 10px 0;
		border-bottom: 1px solid var(--ui-border);
	}

	.order-summery .product-list li:last-child {
		border-bottom: 0;
	}

	.order-summery .price .wrapper-heading,
	.order-summery .total .price {
		color: var(--ui-dark);
		font-weight: 800;
	}

	.order-summery hr {
		border-color: var(--ui-border);
		opacity: 1;
	}

	.payment-type {
		display: flex;
		flex-direction: column;
		gap: 10px;
	}

	.payment-button {
		width: 100%;
		min-height: 46px;
		padding: 10px 14px;
		font-size: 16px;
		font-weight: 700;
		border-radius: 999px;
	}

	#spinner-overlay {
		position: fixed;
		inset: 0;
		z-index: 1055;
		background: rgba(15, 23, 42, 0.35);
		display: flex;
		align-items: center;
		justify-content: center;
	}

	#paymentModal .modal-content {
		border-radius: 14px;
		border: 1px solid var(--ui-border);
	}

	#submitPayment {
		border-radius: 999px;
		font-weight: 700;
		padding: 8px 16px;
	}

	@media (max-width: 991px) {
		.blog.about-blog .container,
		.checkout.product .container {
			padding: 16px;
		}

		.checkout-wrapper .account-section {
			padding: 14px;
		}
	}

	@media (max-width: 576px) {
		.order-summery .product-list li {
			grid-template-columns: 1fr;
		}
	}
</style>
<!--------------- checkout-section-end---------------->
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
		// function paywithcard() {
		// 	if (parseFloat($('#total_payable').val()) == 0 || $('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {
		// 		alert("Please Fill out all the Fields!");

		// 	} else {
		// 		Wolmart.popup({
		// 			items: {
		// 				src: '<?= base_url(); ?>checkout/stripe_card'
		// 			}
		// 		}, "login");
		// 	}

		// }
		

	
		const stripe = Stripe("<?= $this->settings['stripe_pk']; ?>");
		let elements = stripe.elements();
		let card = elements.create("card");
		card.mount("#card-element");

		function saveCheckoutDraft() {
			var draft = {
				full_name: $('#full_name').val() || '',
				email: $('#email').val() || '',
				phone: $('#phone').val() || '',
				address: $('#address').val() || '',
				city: $('#city').val() || '',
				zipcode: $('#zipcode').val() || '',
				country: $('#country').val() || '',
				order_notes: $('#order-notes').val() || ''
			};
			localStorage.setItem('checkout_form_draft', JSON.stringify(draft));
		}

		function restoreCheckoutDraft() {
			var raw = localStorage.getItem('checkout_form_draft');
			if (!raw) return;
			var draft = null;
			try {
				draft = JSON.parse(raw);
			} catch (e) {
				draft = null;
			}
			if (!draft) return;

			if (!$('#full_name').val() && draft.full_name) $('#full_name').val(draft.full_name);
			if (!$('#email').val() && draft.email) $('#email').val(draft.email);
			if (!$('#phone').val() && draft.phone) $('#phone').val(draft.phone);
			if (!$('#address').val() && draft.address) $('#address').val(draft.address);
			if (!$('#city').val() && draft.city) $('#city').val(draft.city);
			if (!$('#zipcode').val() && draft.zipcode) $('#zipcode').val(draft.zipcode);
			if (!$('#country').val() && draft.country) $('#country').val(draft.country).trigger('change');
			if (!$('#order-notes').val() && draft.order_notes) $('#order-notes').val(draft.order_notes);
		}

		function clearCheckoutDraft() {
			localStorage.removeItem('checkout_form_draft');
		}

		function initCheckoutPage() {
			if (initCheckoutPage.initialized || typeof window.jQuery === 'undefined' || typeof window.paypal === 'undefined') {
				return;
			}

			initCheckoutPage.initialized = true;
			restoreCheckoutDraft();
			$('#shipping_details').on('input change', 'input, select, textarea', saveCheckoutDraft);

			$("#submitPayment").on("click", function() {
				let $btn = $(this); // cache button
  		    		$btn.prop("disabled", true).text("Processing..."); // disable + change text
				let grandTotal = $('#total_payable').val();
				$.ajax({
					url: "<?= base_url('checkout/create_payment_intent'); ?>",
					method: "POST",
					data : {
						"grand_total": grandTotal
					},
					success: async function(response) {
						debugger
						let data = JSON.parse(response);

						if (data.error) {
							$("#card-errors").text(data.error);
							$btn.prop("disabled", false).text("Pay Now"); // re-enable if error
							return;
						}

						const { error, paymentIntent } = await stripe.confirmCardPayment(data.clientSecret, {
							payment_method: {
								card: card,
								billing_details: {
									name: $("#full_name").val(),
									email: $("#email").val()
								}
							}
						});

						if (error) {
							$("#card-errors").text(error.message);
							$btn.prop("disabled", false).text("Pay Now"); // re-enable if error
						} else if (paymentIntent.status === "succeeded") {
							$("#payment-success").removeClass("d-none").text("Payment successful!");
							
							// Close payment modal if it's open
							try {
								const paymentModal = document.getElementById('paymentModal');
								if (paymentModal) {
									const bsModal = bootstrap.Modal.getInstance(paymentModal);
									if (bsModal) bsModal.hide();
								}
							} catch (e) {
								console.log('Payment modal close:', e);
							}
							
							showSpinner(); 
							
							$.ajax({
								type: "POST",
								url: '<?= base_url(); ?>/checkout/processorder/',
								data:{
								    'payment_type': 2,
									stripe_intent_id: paymentIntent.id,
									grand_total: $('#total_payable').val(),
									checkout_type: $('#checkout_type').val(),
									full_name: $('#full_name').val(),
									email: $('#email').val(),
									phone: $('#phone').val(),
									address: $('#address').val(),
									street: $('#street').val(),
									city: $('#city').val(),
									zipcode: $('#zipcode').val(),
									country: $('#country').val(),
									order_notes: $('#order-notes').val(),
								},
								success: function(data) {
									console.log(data);
									
									dataObj = JSON.parse(data);
									hideSpinner();
									if (dataObj.status == 'success') {
										clearCheckoutDraft();
										showOrderSuccessModal(dataObj.order_id, dataObj.total_amount);
									} else {
										 $btn.prop("disabled", false).text("Pay Now");
                           				 $("#card-pay-error").html(dataObj.msg).show();
										if (payment_type == 2) {
											$("#card-pay-error").html(dataObj.msg);
											$("#card-pay-error").show();
										} else {
											alert(dataObj.msg);
										}
									}
								},
								error: function () {
									$(".preloader").hide();
									$btn.prop("disabled", false).text("Pay Now"); // re-enable on ajax fail
								},
							});
						}
					},
					error: function () {
						$btn.prop("disabled", false).text("Pay Now"); // re-enable on ajax fail
					},
				});
			});

			paypal.Buttons({
				onInit: function(data, actions) {
					// actionStatus.enable();
					if (parseFloat($('#total_payable').val()) == 0 || $('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {

						actions.disable();
					} else {
						actions.enable();
					}

					actionStatus = actions;


					$('.checkout-form :input').change(function() {
						if (parseFloat($('#total_payable').val()) == 0 || $('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {

							actionStatus.disable();
						} else {
							actionStatus.enable();
						}
					});
				},
				onClick: function() {
					console.log("Paypal Payment", parseFloat($('#total_payable').val()));
					if (parseFloat($('#total_payable').val()) == 0 || $('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {
						alert("Please Fill out all the Fields!");
						actionStatus.disable();
						return;
					} else {
						actionStatus.enable();
						// return;
					}
				},
				createOrder: function(data, actions) {

					// This function sets up the details of the transaction, including the amount and line item details.
					return actions.order.create({
						purchase_units: [{
							amount: {
								value: parseFloat($('#total_payable').val()),
								currency_code: 'GBP'
							}
						}]
					});
				},
				onApprove: function(data, actions) {

					// This function captures the funds from the transaction.
					return actions.order.capture().then(function(details) {
						if (details.status == "COMPLETED") {
							var datap = "paypal_trx_id=" + details.id + ""
							placeorder(3, datap);
						}

					});
				}
			}).render('#paypal-button-container');
		}

		function waitForCheckoutDependencies(attempt) {
			if (initCheckoutPage.initialized) {
				return;
			}

			if (typeof window.jQuery !== 'undefined' && typeof window.paypal !== 'undefined') {
				initCheckoutPage();
				return;
			}

			if ((attempt || 0) >= 120) {
				return;
			}

			window.setTimeout(function () {
				waitForCheckoutDependencies((attempt || 0) + 1);
			}, 50);
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', function () {
				waitForCheckoutDependencies(0);
			});
		} else {
			waitForCheckoutDependencies(0);
		}

		function openPaymentModal() {
			// show modal first
			if (
				parseFloat($('#total_payable').val()) == 0 ||
				$('#full_name').val() == "" ||
				$('#address').val() == "" ||
				$('#street').val() == "" ||
				$('#city').val() == "" ||
				$('#zipcode').val() == "" ||
				$('#country').val() == "" ||
				$('#email').val() == "" ||
				$('#phone').val() == ""
			) {
				alert("Please fill out all the fields!");
				return;
			}
			try {
				if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
					var modal = new bootstrap.Modal(document.getElementById('paymentModal'), {
						backdrop: 'static',   // Prevent closing on outside click
						keyboard: false       // Prevent closing with ESC
					});
					modal.show();
				} else {
					console.error('Bootstrap Modal not available');
					$('#paymentModal').modal('show');
				}
			} catch (e) {
				console.error('Error opening payment modal:', e);
				alert('Error opening payment form. Please try again.');
			}
		}


		function showSpinner() {
		$("#spinner-overlay").removeClass("d-none");
		}

		function hideSpinner() {
		$("#spinner-overlay").addClass("d-none");
		}

		function paywithcod() {
			if ($('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {
				alert("Please Fill out all the Fields!");

			} else {
				placeorder(1, "");
			}
		}

		function process_card() {

			var cardpayform = $("#card-pay-form").serialize();
			console.log(cardpayform);
			placeorder(2, cardpayform);

			return false;
		}

		function placeorder(payment_type, details) {
			var shipping_details = $("#shipping_details").serialize();
			console.log("We got it", details);
			var form = "payment_type=" + payment_type + "&" + details + "&" + shipping_details;
			$(".preloader").show();
			
			// Close payment modal if it's open
			try {
				const paymentModal = document.getElementById('paymentModal');
				if (paymentModal) {
					const bsModal = bootstrap.Modal.getInstance(paymentModal);
					if (bsModal) bsModal.hide();
				}
			} catch (e) {
				console.log('Payment modal close:', e);
			}
			
			$.ajax({
				type: "POST",
				url: '<?= base_url(); ?>/checkout/processorder/',
				data: form, // serializes the form's elements.
				success: function(data) {
					console.log(data);
					dataObj = JSON.parse(data);
					$(".preloader").hide();
					if (dataObj.status == 'success') {
						clearCheckoutDraft();
					showOrderSuccessModal(dataObj.order_id, dataObj.total_amount);
							$("#card-pay-error").html(dataObj.msg);
							$("#card-pay-error").show();
						} else {
							alert(dataObj.msg);
						}
					}


				
			});
		}
	</script>

	<!-- Order Success Modal -->
	<div id="orderSuccessModal" class="order-success-modal" style="display: none;">
		<div class="modal-overlay"></div>
		<div class="success-modal">
			<!-- Header -->
			<div class="success-header">
				<div class="success-icon">✅</div>
				<h1>Order Placed Successfully!</h1>
				<p>Thank you for shopping with Marlota Ltd.</p>
			</div>

			<!-- Body -->
			<div class="success-body">
				<div class="order-id">
					<div class="order-id-label">Order Reference</div>
					<div class="order-id-value" id="modal-order-id">#ORD-38</div>
				</div>

				<div class="success-message">
					<p>Your order has been received and is now being <strong>processed</strong>. We will notify you via email once your order is dispatched.</p>
				</div>

				<div class="order-details">
					<div class="detail-row">
						<span class="detail-label">Order Date:</span>
						<span class="detail-value" id="modal-order-date">13 May 2026, 23:04</span>
					</div>
					<div class="detail-row">
						<span class="detail-label">Total Amount:</span>
						<span class="detail-value" id="modal-total-amount">&pound;28.07</span>
					</div>
					<div class="detail-row">
						<span class="detail-label">Status:</span>
						<span class="detail-value" style="color: #28a745; font-weight: 700;">Processing</span>
					</div>
				</div>

				<div class="button-group">
					<a href="<?php echo base_url(''); ?>" class="btn btn-home">← Back to Home</a>
					<a href="<?php echo base_url('products'); ?>" class="btn btn-continue">Continue Shopping →</a>
				</div>
			</div>

			<!-- Footer -->
			<div class="success-footer">
				<p>A confirmation email has been sent to your registered email address.</p>
			</div>
		</div>
	</div>

	<style>
	.order-success-modal {
		position: fixed;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		display: flex;
		align-items: center;
		justify-content: center;
		z-index: 9999;
	}

	.order-success-modal .modal-overlay {
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background: rgba(0, 0, 0, 0.5);
		z-index: -1;
	}

	.order-success-modal .success-modal {
		background: #ffffff;
		border-radius: 12px;
		box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
		max-width: 500px;
		width: 90%;
		overflow: hidden;
		animation: slideIn 0.4s ease-out;
		z-index: 10000;
	}

	@keyframes slideIn {
		from {
			opacity: 0;
			transform: translateY(20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	.order-success-modal .success-header {
		background: #3a1b76;
		padding: 40px 30px;
		text-align: center;
		color: #ffffff;
	}

	.order-success-modal .success-header h1 {
		font-size: 28px;
		margin-bottom: 8px;
		font-weight: 700;
		color: #ffffff;
		text-shadow: none;
	}

	.order-success-modal .success-header p {
		font-size: 14px;
		opacity: 1;
		margin-bottom: 5px;
		color: #ffffff;
	}

	.order-success-modal .success-icon {
		font-size: 60px;
		margin-bottom: 15px;
		display: inline-block;
		animation: bounce 0.6s ease-out;
	}

	@keyframes bounce {
		0%, 100% { transform: translateY(0); }
		50% { transform: translateY(-10px); }
	}

	.order-success-modal .success-body {
		padding: 40px 30px;
		text-align: center;
	}

	.order-success-modal .order-id {
		background: #F9F6F1;
		border: 2px solid #C9A646;
		border-radius: 8px;
		padding: 15px;
		margin-bottom: 20px;
	}

	.order-success-modal .order-id-label {
		font-size: 12px;
		color: #4A4A4A;
		text-transform: uppercase;
		letter-spacing: 0.5px;
		font-weight: 600;
		margin-bottom: 5px;
	}

	.order-success-modal .order-id-value {
		font-size: 24px;
		color: #3a1b76;
		font-weight: 700;
		letter-spacing: 1px;
	}

	.order-success-modal .success-message {
		font-size: 15px;
		color: #4A4A4A;
		line-height: 1.6;
		margin-bottom: 30px;
	}

	.order-success-modal .success-message strong {
		color: #3a1b76;
	}

	.order-success-modal .order-details {
		background: #F9F6F1;
		border-radius: 8px;
		padding: 15px;
		margin-bottom: 30px;
		text-align: left;
	}

	.order-success-modal .detail-row {
		display: flex;
		justify-content: space-between;
		padding: 8px 0;
		border-bottom: 1px solid #e8e8e8;
		font-size: 14px;
	}

	.order-success-modal .detail-row:last-child {
		border-bottom: none;
	}

	.order-success-modal .detail-label {
		color: #4A4A4A;
		font-weight: 600;
	}

	.order-success-modal .detail-value {
		color: #1E1E1E;
		font-weight: 500;
	}

	.order-success-modal .button-group {
		display: flex;
		gap: 12px;
		justify-content: center;
	}

	.order-success-modal .btn {
		display: inline-block;
		padding: 12px 28px;
		border: none;
		border-radius: 6px;
		font-size: 14px;
		font-weight: 600;
		text-decoration: none;
		cursor: pointer;
		transition: all 0.3s ease;
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}

	.order-success-modal .btn-home {
		background: #3a1b76;
		color: #ffffff;
		flex: 1;
	}

	.order-success-modal .btn-home:hover {
		background: #2a1456;
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(58, 27, 118, 0.3);
	}

	.order-success-modal .btn-continue {
		background: #C9A646;
		color: #1E1E1E;
		flex: 1;
	}

	.order-success-modal .btn-continue:hover {
		background: #b89237;
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(201, 166, 70, 0.3);
	}

	.order-success-modal .success-footer {
		background: #3a1b76;
		padding: 15px 30px;
		text-align: center;
		border-top: 1px solid #2a1456;
	}

	.order-success-modal .success-footer p {
		font-size: 12px;
		color: #C9A646;
		margin: 0;
	}

	@media (max-width: 480px) {
		.order-success-modal .button-group {
			flex-direction: column;
		}

		.order-success-modal .btn {
			width: 100%;
		}

		.order-success-modal .success-header h1 {
			font-size: 22px;
		}

		.order-success-modal .order-id-value {
			font-size: 20px;
		}

		.order-success-modal .success-body {
			padding: 30px 20px;
		}
	}

	.order-success-modal.show {
		display: flex !important;
	}
	</style>

	<script>
	function showOrderSuccessModal(orderId, totalAmount) {
		const modal = document.getElementById('orderSuccessModal');
		document.getElementById('modal-order-id').textContent = '#ORD-' + orderId;
		document.getElementById('modal-total-amount').textContent = '£' + parseFloat(totalAmount).toFixed(2);
		document.getElementById('modal-order-date').textContent = new Date().toLocaleDateString('en-GB', {
			day: '2-digit',
			month: 'short',
			year: 'numeric',
			hour: '2-digit',
			minute: '2-digit'
		});
		modal.classList.add('show');
		document.body.style.overflow = 'hidden';
	}
	</script>

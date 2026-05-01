<?php
$userid = $this->session->userdata('user_id');

$user = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array();

$billing = $this->db->query("SELECT * FROM app_address where user_id = '$userid' && type = '1' ORDER BY id DESC");
$shipping = $this->db->query("SELECT * FROM app_address where user_id = '$userid' && type = '2' ORDER BY id DESC");
$total = 0;
$total_sum = 0;
$shipping_cost = 4; // Flat shipping charge
$vat_rate = 0.20; // VAT rate (20%)
$usertotalpayable = '';
foreach ($cart as $row) {

$total = $row['qty'] * $row['price'];
$total_sum += $total;
$product = $this->db->query("SELECT * FROM app_products WHERE id = '{$row['product_id']}'")->row_array();
$subtotal = $total; // Subtotal includes shipping charges
$vat = $total * $vat_rate; // VAT on products + shipping
}
$usertotalpayable = $total_sum; // Subtotal including VAT

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
													value="<?php 
														if ($billing && $billing->num_rows() > 0 && isset($billing->row()->full_name)) {
															echo $billing->row()->full_name;
														} elseif (isset($user['full_name'])) {
															echo $user['full_name'];
														} else {
															echo '';
														}
													?>" 
													required>

											</div>

											<div class="account-inner-form mt-4">
												<div class="review-form-name">
													<label for="email" class="form-label">Email <span style="color:red">*</span></label>
													<input type="email" name="email" id="email" class="form-control"
														placeholder="user@gmail.com"
														value="<?php 
															if ($billing && $billing->num_rows() > 0 && isset($billing->row()->email)) {
																echo $billing->row()->email;
															} elseif (isset($user['email'])) {
																echo $user['email'];
															} else {
																echo '';
															}
														?>" 
														required>
												</div>

												<div class="review-form-name">
													<label for="phone" class="form-label">Phone <span style="color:red">*</span></label>
													<input type="tel" id="phone" name="phone" class="form-control"
														placeholder="+880388**0899"
														value="<?php 
															if ($billing && $billing->num_rows() > 0 && isset($billing->row()->phone)) {
																echo $billing->row()->phone;
															} elseif (isset($user['phone'])) {
																echo $user['phone'];
															} else {
																echo '';
															}
														?>" 
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

													$selected_country = '';
													if ($billing && $billing->num_rows() > 0 && isset($billing->row()->country)) {
														$selected_country = $billing->row()->country;
													} elseif (isset($user['country'])) {
														$selected_country = $user['country'];
													}

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
													value="<?php 
														if ($billing && $billing->num_rows() > 0 && isset($billing->row()->address)) {
															echo $billing->row()->address;
														} elseif (isset($user['address'])) {
															echo $user['address'];
														}
													?>" required>
											</div>

											<div class="account-inner-form">
												<div class="review-form-name city-form">
													<label for="city" class="form-label">City <span style="color:red">*</span></label>
													<input type="text" id="city" name="city" class="form-control"
														placeholder="Enter your City" 
														value="<?php 
															if ($billing && $billing->num_rows() > 0 && isset($billing->row()->city)) {
																echo $billing->row()->city;
															} elseif (isset($user['city'])) {
																echo $user['city'];
															}
														?>" required>
												</div>

												<div class="review-form-name zipcode-form">
													<label for="zipcode" class="form-label">Postal Code <span style="color:red">*</span></label>
													<input type="text" id="zipcode" name="zipcode" class="form-control"
														placeholder="Enter your postal code" 
														value="<?php 
															if ($billing && $billing->num_rows() > 0 && isset($billing->row()->zipcode)) {
																echo $billing->row()->zipcode;
															} elseif (isset($user['zipcode'])) {
																echo $user['zipcode'];
															}
														?>" required>
												</div>
											</div>

											<div class="form-group mt-3">
												<label for="order-notes">Order notes (optional)</label>
												<textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30" rows="4"
													placeholder="Notes about your order, e.g special notes for delivery"></textarea>
											</div>

											<input type="hidden" 
												value="<?php 
													$payable = $usertotalpayable;
													// $payable = $usertotalpayable - $user['balance'];
													echo ($payable < 0) ? 0 : number_format($payable, 2);
												?>" 
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
													
													$all_total = 0;
													foreach ($cart as $row) {
														$total = $row['qty'] * $row['price'];
														$all_total += $total;
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
															<h5 class="wrapper-heading">$<?= $total; ?></h5>
														</div>
													</li>
												<?php }
												// Calculate VAT
													 $subtotal = $all_total; // Subtotal includes shipping charges
													$vat = $total * $vat_rate; // VAT on products + shipping
													$subtotal_with_vat = $subtotal; // Subtotal including VAT
												?>
												
											</ul>
										</div>
										<hr>
										
									
											<div class="subtotal product-total">
											<h5 class="wrapper-heading">SUBTOTAL</h5>
											<h5 class="wrapper-heading">$<?= $subtotal; ?></h5>
										</div>
								
									
										<hr>
										<div class="subtotal total">
											<h5 class="wrapper-heading">TOTAL Payable</h5>
											<h5 class="wrapper-heading price">$<?php
												// Total payable calculation
												$payable = $subtotal_with_vat;
												// $payable = $subtotal_with_vat - $user['balance'];
												if ($payable < 0) {
													echo 0;
												} else {
													echo number_format($payable, 2);
												}
												?>
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
	.payment-button {
		    margin-bottom: 15px;
    width: 250px;
    padding: 10px;
    font-size: large;
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
			var modal = new bootstrap.Modal(document.getElementById('paymentModal'), {
					backdrop: 'static',   // Prevent closing on outside click
					keyboard: false       // Prevent closing with ESC
				});
			modal.show();
		}

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
								debugger
								console.log(data);
								
								dataObj = JSON.parse(data);
								hideSpinner();
								if (dataObj.status == 'success') {
									window.location.href = "<?= base_url(); ?>user/account#v-pills-order";
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
			//  var form = {payment_type:payment_type,details:details,shipping_details:shipping_details};
			$(".preloader").show();
			$.ajax({
				type: "POST",
				url: '<?= base_url(); ?>/checkout/processorder/',
				data: form, // serializes the form's elements.
				success: function(data) {
					console.log(data);
					dataObj = JSON.parse(data);
					$(".preloader").hide();
					if (dataObj.status == 'success') {
						window.location.href = "<?= base_url(); ?>user/orders";
					} else {
						if (payment_type == 2) {
							$("#card-pay-error").html(dataObj.msg);
							$("#card-pay-error").show();
						} else {
							alert(dataObj.msg);
						}
					}


				}
			});
		}
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
	</script>

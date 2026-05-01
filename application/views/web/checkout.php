<?php if ($this->session->userdata('user_loggedin')) { ?>
	<main class="main checkout">
		<!-- Start of Breadcrumb -->
		<nav class="breadcrumb-nav">
			<div class="container">
				<ul class="breadcrumb shop-breadcrumb bb-no">
					<li><a href="<?= base_url(); ?>cart">Shopping Cart</a></li>
					<li class="active"><a href="<?= base_url(); ?>checkout">Checkout</a></li>
					<li><a href="javascript:void(0);">Order Complete</a></li>
				</ul>
			</div>
		</nav>
		<!-- End of Breadcrumb -->
		<?php
		$userid = $this->session->userdata('user_id');

		$user = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array();

		$billing = $this->db->query("SELECT * FROM app_address where user_id = '$userid' && type = '1' ORDER BY id DESC");
		$shipping = $this->db->query("SELECT * FROM app_address where user_id = '$userid' && type = '2' ORDER BY id DESC");

		?>

		<!-- Start of PageContent -->
		<div class="page-content">
			<div class="container">

				<form class="form checkout-form" id="shipping_details" action="" onsubmit="return false;" method="post">
					<div class="row mb-9">
						<div class="col-lg-7 pr-lg-4 mb-4">
							<h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
								Billing & Shipping Details
							</h3>
							<div class="form-group">
								<label>Full name <span style="color:red">*</span></label>
								<input type="text" class="form-control form-control-md" id="full_name" name="full_name" value="<?php if ($billing->num_rows() > 0) {
																																	echo $billing->row()->full_name;
																																} else {
																																	echo $user['full_name'];
																																} ?>" required>
							</div>


							<div class="form-group">
								<label>Street address <span style="color:red">*</span></label>
								<input type="text" placeholder="House number and street name"
									class="form-control form-control-md mb-2" name="address" id="address" value="<?php if ($billing->num_rows() > 0) {
																														echo $billing->row()->address;
																													} ?>" required>
								<!--<input type="text" placeholder="Apartment, suite, unit, etc."-->
								<!--    class="form-control form-control-md" name="street" id="street" value="<?php if ($billing->num_rows() > 0) {
																													echo $billing->row()->street;
																												} ?>" required>-->
							</div>
							<div class="row gutter-sm">
								<div class="col-xs-6">
									<div class="form-group">
										<label>City <span style="color:red">*</span></label>
										<input type="text" placeholder="London" class="form-control form-control-md" id="city" name="city" value="<?php if ($billing->num_rows() > 0) {
																																						echo $billing->row()->city;
																																					} ?>" required>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Postal Code <span style="color:red">*</span></label>
										<input type="text" placeholder="100012" class="form-control form-control-md" id="zipcode" name="zipcode" value="<?php if ($billing->num_rows() > 0) {
																																							echo $billing->row()->zipcode;
																																						} ?>" required>
									</div>
								</div>
							</div>
							<div class="row gutter-sm">
								<div class="col-xs-12">
									<div class="form-group">
										<label>Country <span style="color:red">*</span></label>
										<select class="form-control" id="country" name="country" required>
											<option value="">Select Country</option>
											<?php $countries = $this->db->select("*")->from('app_countries')->order_by('country_name', 'asc')->get()->result_array();
											foreach ($countries as $country) { ?>
												<option value="<?= $country['country_name']; ?>" <?php if ($billing->num_rows() > 0) {
																									if ($billing->row()->country == $country['country_name']) {
																										echo 'selected';
																									}
																								} ?>><?= $country['country_name']; ?></option>
											<?php } ?>
										</select>

									</div>
								</div>
							</div>

							<div class="row gutter-sm">
								<div class="col-xs-6">
									<div class="form-group">
										<label>Email <span style="color:red">*</span></label>
										<input type="email" class="form-control form-control-md" name="email" id="email" value="<?php if ($billing->num_rows() > 0) {
																																	echo $billing->row()->email;
																																} else {
																																	echo $user['email'];
																																} ?>" required>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Phone <span style="color:red">*</span></label>
										<input type="text" class="form-control form-control-md" name="phone" id="phone" value="<?php if ($billing->num_rows() > 0) {
																																	echo $billing->row()->phone;
																																} else {
																																	echo $user['phone'];
																																} ?>" required>
									</div>
								</div>
							</div>
							<script>
								function shipping_toggler() {
									if ($('#shipping-toggle').is(':checked')) {
										$(".checkbox-content input").attr('required', 'required');
										$(".checkbox-content select").attr('required', 'required');
										$('.checkbox-content').show();
									} else {
										$(".checkbox-content input").removeAttr('required');
										$(".checkbox-content select").removeAttr('required');
										$('.checkbox-content').hide();
									}
								}
							</script>
							<div class="form-group pb-2" style="display:none;">
								<input type="checkbox" class="custom-checkbox" id="shipping-toggle"
									name="shipping_toggle" onclick="shipping_toggler()">
								<label>Ship to a different address?</label>
							</div>
							<div class="checkbox-content">
								<div class="form-group">
									<label>Full name <span style="color:red">*</span></label>
									<input type="text" class="form-control form-control-md" value="<?php if ($shipping->num_rows() > 0) {
																										echo $shipping->row()->full_name;
																									} else {
																										echo $user['full_name'];
																									} ?>" name="sfull_name">
								</div>


								<div class="form-group">
									<label>Street address <span style="color:red">*</span></label>
									<input type="text" placeholder="House number and street name"
										class="form-control form-control-md mb-2" name="saddress" value="<?php if ($shipping->num_rows() > 0) {
																												echo $shipping->row()->address;
																											} ?>">
									<input type="text" placeholder="Apartment, suite, unit, etc."
										class="form-control form-control-md" name="sstreet" value="<?php if ($shipping->num_rows() > 0) {
																										echo $shipping->row()->street;
																									} ?>">
								</div>
								<div class="row gutter-sm">
									<div class="col-xs-12">
										<div class="form-group">
											<label>Google Plus Code </label>
											<input type="text" class="form-control form-control-md" name="splus_code" value="<?php if ($shipping->num_rows() > 0) {
																																	echo $shipping->row()->plus_code;
																																} ?>">
										</div>
									</div>
								</div>

								<div class="row gutter-sm">
									<div class="col-xs-6">
										<div class="form-group">
											<label>Email <span style="color:red">*</span></label>
											<input type="email" class="form-control form-control-md" value="<?php if ($shipping->num_rows() > 0) {
																												echo $shipping->row()->email;
																											} else {
																												echo $user['email'];
																											} ?>" name="semail">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label>Phone <span style="color:red">*</span></label>
											<input type="text" class="form-control form-control-md" value="<?php if ($shipping->num_rows() > 0) {
																												echo $shipping->row()->phone;
																											} else {
																												echo $user['phone'];
																											} ?>" name="sphone">
										</div>
									</div>
								</div>
							</div>

							<div class="form-group mt-3">
								<label for="order-notes">Order notes (optional)</label>
								<textarea class="form-control mb-0" id="order-notes" name="order_notes" cols="30"
									rows="4"
									placeholder="Notes about your order, e.g special notes for delivery"></textarea>
							</div>
						</div>
						<div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
							<div class="order-summary-wrapper sticky-sidebar">
								<h3 class="title text-uppercase ls-10">Your Order</h3>
								<div class="order-summary">
									<table class="order-table">
										<thead>
											<tr>
												<th colspan="2">
													<b>Product</b>
												</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$total = 0;
											$shipping_cost = 4; // Flat shipping charge
											$vat_rate = 0.20; // VAT rate (20%)

											foreach ($cart as $row) {
												$total += $row['qty'] * $row['price'];
												$product = $this->db->query("SELECT * FROM app_products WHERE id = '{$row['product_id']}'")->row_array();
											?>
												<tr class="bb-no">
													<td class="product-name"><?= $row['sku']; ?> <i class="fas fa-times"></i> <span class="product-quantity"><?= $row['qty']; ?></span></td>
													<td class="product-total">£<?= $row['total_amount']; ?></td>
												</tr>
											<?php }

											// Calculate VAT
											$subtotal = $total + $shipping_cost; // Subtotal includes shipping charges
											$vat = $subtotal * $vat_rate; // VAT on products + shipping
											$subtotal_with_vat = $subtotal + $vat; // Subtotal including VAT
											?>

											<tr class="order-shipping bb-no">
												<td>Shipping Charges</td>
												<td>£<?= $shipping_cost; ?></td>
											</tr>

											<tr class="cart-subtotal bb-no">
												<td><b>Subtotal</b></td>
												<td><b>£<?= $subtotal; ?></b></td> <!-- Includes products + shipping -->
											</tr>

											<tr class="cart-vat bb-no">
												<td>VAT (20%)</td>
												<td>£<?= number_format($vat, 2); ?></td>
											</tr>

											<tr class="cart-subtotal-vat bb-no">
												<!--<td><b>Subtotal </b></td>-->
												<!--<td><b>£<?= number_format($subtotal_with_vat, 2); ?></b></td>-->
											</tr>

											<tr class="bb-no" id="cashbask_free" style="">
												<!--<td class="product-name">Balance Used</td>-->
												<!--<td class="product-total">-<?php if ($subtotal_with_vat >= $user['balance']) {
																					echo $user['balance'];
																				} else {
																					echo $subtotal_with_vat;
																				} ?></td>-->
											</tr>

										</tbody>
										<tfoot>
											<tr class="order-total" id="total_payable">
												<th><b>Total Payable</b></th>
												<td><b>£<?php
														// Total payable calculation
														$payable = $subtotal_with_vat - $user['balance'];
														if ($payable < 0) {
															echo 0;
														} else {
															echo number_format($payable, 2);
														}
														?></b></td>
												<input type="hidden" value="<?php
																			$payable = $subtotal_with_vat - $user['balance'];
																			echo ($payable < 0) ? 0 : number_format($payable, 2);
																			?>" id="total_payable_hidden" />
											</tr>

										</tfoot>
									</table>

									<div class="payment-methods" id="payment_method">
										<h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
										<button type="button" onclick="paywithcod();" class="btn btn-dark btn-block btn-rounded" style="margin-bottom:15px">Cash On Delivery</button>

										<button type="button" onclick="paywithcard();" class="btn btn-dark btn-block btn-rounded" style="margin-bottom:15px;border-color: #03a9f4;background-color: #03a9f4;"><i class="w-icon-wallet"></i> Credit/Debit Card</button>


										<div id="paypal-button-container"></div>


									</div>

									<div class="form-group place-order pt-6">

									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End of PageContent -->
	</main>

	<script>
		function paywithcard() {
			if (parseFloat($('#total_payable').val()) == 0 || $('#full_name').val() == "" || $('#address').val() == "" || $('#street').val() == "" || $('#city').val() == "" || $('#zipcode').val() == "" || $('#country').val() == "" || $('#email').val() == "" || $('#phone').val() == "") {
				alert("Please Fill out all the Fields!");

			} else {
				Wolmart.popup({
					items: {
						src: '<?= base_url(); ?>checkout/stripe_card'
					}
				}, "login");
			}

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
							value: parseFloat($('#total_payable_hidden').val()),
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
<?php } else { ?>
	<main class="main login-page">


		<!-- Start of Breadcrumb -->
		<nav class="breadcrumb-nav">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="<?= base_url(); ?>">Home</a></li>
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
							<?php
							if (uri_string() != 'user/register') { ?>
								<li class="nav-item">
									<a href="#sign-in" class="nav-link active">Sign In</a>
								</li>
								<li class="nav-item">
									<a href="#sign-in" class="nav-link register-click">Sign UP</a>
								</li>
							<?php } ?>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="sign-in">
								<div class="alert alert-error alert-bg alert-inline show-code-action" id="sign-in-error" style="display:none"></div>
								<div class="alert alert-success alert-bg alert-inline show-code-action" id="sign-in-success" style="display:none"></div>
								<form id="sign-in-form" method="post" onsubmit="return login();">
									<div class="form-group">
										<label>Email. <span style="color:red">*</span></label>
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
											function showResetForm() {
												$("#sign-in").removeClass("active");
												$("#forgot-password").addClass("active");
												return false;
											}

											function showSignInForm() {
												$("#forgot-password").removeClass("active");
												$("#sign-in").addClass("active");
												return false;
											}
										</script>
									</div>
									<button type="submit" name="signin" class="btn btn-primary">Sign In</button>
								</form>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
<?php } ?>

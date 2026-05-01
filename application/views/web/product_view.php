<style>
	.grid-container {
		display: grid;
		grid-template-columns: repeat(2, 1fr);
		/* 2 columns */
		gap: 0px;
		/* Gap between grid items */
	}

	.grid-item {
		border: 1px solid #ccc;
		padding: 5px;
		text-align: center;
	}

	/* Make icon and text stack vertically */
	.icon-box {
		text-align: center;
		margin: 0 60px; /* space between each box */
	}

	.icon-box-icon {
		display: block;
		font-size: 2.5rem; /* increase icon size */
		margin-bottom: 10px; /* space between icon and title */
	}

	.icon-box-title {
		font-size: 1.7rem !important;
		font-weight: 600;
		margin-bottom: 5px;
	}

	.icon-box-content p {
		font-size: 1.6rem;
		color: #555;
	}
	.widget-icon-box {
		padding: 10rem 0rem !important;
	}
	.icon-size{
		font-size: 8rem !important;
	}
	.nav-item a:hover {
		color: #871919 !important;
		border-color: #d80000;
	}
	#product-tab-description p{
		font-size: 15px;
		color: #0f0f0fff;
		
	}
	.product-hr{
		 border: none;
		height: 2px;
		background-color: #871919;
		width: 100%;  
		margin: 20px 0;
	}
	.btn-cart{
		    border-radius: 10px;
	}
	#choice_options_11 {
		    border-radius: 5px;
	}
	
</style>
<?php $category = $this->db->query("SELECT * FROM app_categories where id = '{$product['category_id']}'")->row_array();
$brand = $this->db->query("SELECT * FROM app_brands where id = '{$product['brand_id']}'")->row_array();
$stock = $this->db->query("SELECT * FROM app_product_stocks where product_id = '{$product['id']}'");
// echo '<script>window.location.replace("beaters://home/product-view?id='.$product['id'].'");</script>';
?>

<input type="hidden" id="product_id" value="<?= $product['id']; ?>" />
<main class="main mb-10 pb-1">
	<!-- Start of Breadcrumb -->
	<nav class="breadcrumb-nav container">
		<ul class="breadcrumb bb-no">
			<li><a href="<?= base_url(); ?>">Home</a></li>
			<li><a href="<?= base_url(); ?>products">Products</a></li>
			<li><?= $product['name']; ?></li>
		</ul>

	</nav>
	<!-- End of Breadcrumb -->

	<!-- Start of Page Content -->
	<div class="page-content">
		<div class="container">
			<div class="row gutter-lg">
				<div class="main-content">
					<div class="product product-single row">
						<div class="col-md-6 mb-6">
							<div class="product-gallery product-gallery-sticky">
								<div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
									<div class="swiper-wrapper row cols-1 gutter-no">
										<div class="swiper-slide">
											<figure class="product-image" id="thumbdiv">
												<img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>"
													data-zoom-image="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>"
													alt="<?= $product['name']; ?>" width="75%">
											</figure>
										</div>
										<?php if ($product['photos'] != '') {
											foreach (explode(',', $product['photos']) as $pic) { ?>
												<div class="swiper-slide">
													<figure class="product-image">
														<img src="<?= base_url(); ?>uploads/products/<?= $pic; ?>"
															data-zoom-image="<?= base_url(); ?>uploads/products/<?= $pic; ?>"
															alt="<?= $product['name']; ?>">
													</figure>
												</div>
										<?php }
										} ?>



									</div>
									<button class="swiper-button-next"></button>
									<button class="swiper-button-prev"></button>
								</div>
								<div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
									<div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
										<div class="product-thumb swiper-slide">
											<img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>"
												alt="<?= $product['name']; ?>" width="500" height="500">
										</div>
										<?php if ($product['photos'] != '') {
											foreach (explode(',', $product['photos']) as $pic) { ?>
												<div class="product-thumb swiper-slide">
													<img src="<?= base_url(); ?>uploads/products/<?= $pic; ?>"
														alt="<?= $product['name']; ?>" width="800" height="900">
												</div>
										<?php }
										} ?>

									</div>
									<button class="swiper-button-next"></button>
									<button class="swiper-button-prev"></button>
								</div>
							</div>
						</div>
						<div class="col-md-6 mb-4 mb-md-6">
							<div class="product-details" data-sticky-options="{'minWidth': 767}">
								<h1 class="product-title"><?= $product['name']; ?></h1>
								<hr class="product-hr">
								<input type="hidden" value="<?= $product['slug']; ?>" id="product-slug" />
								<div class="product-bm-wrapper">
									<figure class="brand">
										<img src="<?= base_url(); ?>uploads/brands/<?= $brand['logo']; ?>" alt="<?= $brand['name']; ?>"
											style="width:75px;height:50px" />
									</figure>
									<div class="product-meta">
										<div class="product-categories">
											Category:
											<span class="product-category"><a href="<?= base_url(); ?>products/?category=<?= $category['slug']; ?>"><?= $category['name']; ?></a></span>
										</div>
										<?php if ($stock->num_rows() == 1) { ?>
											<div class="product-sku" id="product_sku">
												SKU: <span><?= $stock->row()->sku; ?></span>
											</div>
										<?php } else { ?>
											<div class="product-sku" id="product_sku" style="display:none">
												SKU: <span></span>
											</div>
										<?php } ?>
									</div>
								</div>





								<hr class="product-divider">
								<?php
								// Fetch all product variants and their prices
								$product_variants = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'")->result();

								// Check if the product has attribute_id 7
								$has_attribute_7 = $this->db->query("SELECT COUNT(*) AS count FROM app_attribute_values WHERE product_id = '{$product['id']}' AND attribute_id = 7")->row()->count;

								// If no variants found, or if only one value exists, then fetch attribute values
								if (($has_attribute_7 && (empty($product_variants) || count($product_variants) <= 1)) || !$has_attribute_7) {
									$attribute_values = $this->db->query("SELECT av.value, aps.price, aps.discount 
                                           FROM app_attribute_values av 
                                           LEFT JOIN app_attributes a 
                                           ON av.attribute_id = attribute_id
                                           LEFT JOIN app_product_stocks aps 
                                           ON a.id = aps.attribute_id
                                           WHERE aps.product_id = '{$product['id']}' 
                                           ORDER BY av.value ASC")->result();
								}

								// Display grid only if the product has attribute_id 7
								if ($has_attribute_7) {
								?>
									<div class="grid-container">
										<?php
										// Loop through each variant or attribute value
										foreach ($product_variants as $variant):
											// Check if the variant object has the 'value' property
											if (property_exists($variant, 'value')) {
												$value = $variant->value;
											} else {
												// Set default value or handle the situation when 'value' is not present
												$value = ''; // for example
											}

											$price = $variant->price;
											$discount = $variant->discount;

											// If variant has no price, fall back to attribute values
											if ($price === null) {
												foreach ($attribute_values as $attr) {
													if ($attr->value === $value) {
														$price = $attr->price;
														$discount = $attr->discount;
														break;
													}
												}
											}
										?>
											<div class="grid-item">
												<p><?php echo $variant->variant; ?> </p>
												<?php
												// Display price for this variant
												if ($discount > 0) {
													echo '<del class="old-price">£ ' . $price . '</del>';
													echo '<ins class="new-price">£ ' . $discount . '</ins>';
												} else {
													echo '<ins class="new-price">£ ' . $price . '</ins>';
												}
												?>
												<!-- Display appropriate content for this grid item -->
											</div>
										<?php endforeach; ?>
									</div>
								<?php
								}
								?>



								<hr class="product-divider">



								<?php
								// Fetch all product variants and their prices
								$product_variants = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'")->result();

								// Check if the product has attribute_id 7
								$has_attribute_7 = $this->db->query("SELECT COUNT(*) AS count FROM app_attribute_values WHERE product_id = '{$product['id']}' AND attribute_id = 7")->row()->count;

								// If no variants found, or if only one value exists, then fetch attribute values
								if (($has_attribute_7 && (empty($product_variants) || count($product_variants) <= 1)) || !$has_attribute_7) {
									$attribute_values = $this->db->query("SELECT av.value, aps.price, aps.discount 
                                           FROM app_attribute_values av 
                                           LEFT JOIN app_attributes a 
                                           ON av.attribute_id = attribute_id
                                           LEFT JOIN app_product_stocks aps 
                                           ON a.id = aps.attribute_id
                                           WHERE aps.product_id = '{$product['id']}' 
                                           ORDER BY av.value ASC")->result();
								}

								// Display grid only if the product has attribute_id 7
								if ($has_attribute_7) {
									// Initialize variables for maximum and minimum prices
									$max_price = PHP_INT_MIN;
									$min_price = PHP_INT_MAX;

									// Loop through each variant or attribute value
									foreach ($product_variants as $variant):
										// Check if the variant object has the 'value' property
										if (property_exists($variant, 'value')) {
											$value = $variant->value;
										} else {
											// Set default value or handle the situation when 'value' is not present
											$value = ''; // for example
										}

										$price = $variant->price;
										$discount = $variant->discount;

										// If variant has no price, fall back to attribute values
										if ($price === null) {
											foreach ($attribute_values as $attr) {
												if ($attr->value === $value) {
													$price = $attr->price;
													$discount = $attr->discount;
													break;
												}
											}
										}

										// Update maximum and minimum prices
										if ($price > $max_price) {
											$max_price = $price;
										}
										if ($price < $min_price) {
											$min_price = $price;
										}
									endforeach;

									// Display the maximum and minimum prices
									echo " £" . $min_price  . " - ";
									echo " £" .  $max_price;
								}
								?>
								<div class="product-price" id="product-price">
									<?php if ($stock->num_rows() > 1) {
										$low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price asc")->row();
									?>
										<?php if ($low_price->discount > 0) { ?>
											<del class="old-price">£ <?= $low_price->price; ?></del>
											<ins class="new-price">£ <?= $low_price->discount; ?></ins>
										<?php } else { ?>
											<ins class="new-price">£ <?= $low_price->price; ?></ins>
										<?php } ?>
									<?php } else { ?>
										<?php if ($stock->row()->discount > 0) { ?>
											<del class="old-price">£ <?= $stock->row()->price; ?></del>
											<ins class="new-price">£ <?= $stock->row()->discount; ?></ins>
											<input type="hidden" id="product-price-orignal" value="£ <?= $stock->row()->discount; ?>" />
										<?php } else { ?>
											<ins class="new-price">£ <?= $stock->row()->price; ?></ins>
											<input type="hidden" id="product-price-orignal" value="£ <?= $stock->row()->price; ?>" />
										<?php } ?>
									<?php } ?>
								</div>
								<?php if ($stock->num_rows() == 1) { ?>
									<div class="product-sku" id="product_stock" style="margin-bottom:10px">
										<span style="<?php if ($stock->row()->qty < 10) {
															echo 'color:red;';
														} else {
															echo 'color:green;';
														} ?>"><?= $stock->row()->qty; ?> left in stock</span>
									</div>
								<?php } else { ?>
									<div class="product-sku" id="product_stock" style="margin-bottom:10px;display:none">
										<span>0 left in stock</span>
									</div>
								<?php } ?>
								<div class="ratings-container">
									<div class="ratings-full">
										<span class="ratings" style="width: <?= ($product['rating'] * 100 / 5); ?>%;"></span>
										<span class="tooltiptext tooltip-top"></span>
									</div>
									<a href="#product-tab-reviews" class="rating-reviews scroll-to">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows(); ?>
										Reviews)</a>
								</div>


								<hr class="product-divider">

								<div class="product-short-desc lh-2">
									<ul class="list-type-check list-style-none">
										<li>Customer Support Assistance</li>
										<li>10 Days free returns</li>
										<li>Return collection from doorstep</li>
										<p style="color:red;"><span style="color:red; font-weight:bold;">Note:</span> Minimum order should be <span style="color:red; font-weight:bold;">10</span> packs.</p>
									</ul>
								</div>

								<hr class="product-divider">



								<form id="choice_options_form" action="" method="post">
									<?php if ($product['variant_product'] == 1) { ?>
										<?php foreach (json_decode($product['choice_options']) as $key => $choice_option) { ?>
											<input type="hidden" name="choice_no[]" value="<?= $choice_option->attribute_id; ?>">
											<div class="product-form product-variation-form product-size-swatch">
												<label class="mb-1"><?= $this->db->query("select * from app_attributes where id='" . $choice_option->attribute_id . "'")->row()->name; ?>:</label>
												<div class="flex-wrap d-flex align-items-center product-variations" style="width: 35%;">
													<select name="choice_options_<?= $choice_option->attribute_id; ?>" id="choice_options_<?= $choice_option->attribute_id; ?>" onchange="getVariantDetails();">
														<option value="">Select <?= $this->db->query("select * from app_attributes where id='" . $choice_option->attribute_id . "'")->row()->name; ?></option>
														<?php foreach ($choice_option->values as $row) { ?>
															<option value="<?= $row; ?>">
																<?= $row; ?>
															</option>
														<?php } ?>
													</select>
												</div>
											</div>
									<?php }
									} ?>
								</form>



								<!--variation for price pack -->

								<form id="choice_options_form" action="" method="post">
									<?php if ($product['variant_product'] == 4) { ?>
										<?php foreach (json_decode($product['choice_options']) as $key => $choice_option) { ?>
											<input type="hidden" name="choice_no[]" value="<?= $choice_option->attribute_id; ?>">
											<div class="product-form product-variation-form product-size-swatch">
												<label class="mb-1"><?= $this->db->query("select * from app_attributes where id='" . $choice_option->attribute_id . "'")->row()->name; ?>:</label>
												<div class="flex-wrap d-flex align-items-center product-variations" style="width: 60%;">
													<select name="choice_options_<?= $choice_option->attribute_id; ?>" id="choice_options_<?= $choice_option->attribute_id; ?>" onchange="getPriceVariantDetails();">
														<option value="">Select <?= $this->db->query("select * from app_attributes where id='" . $choice_option->attribute_id . "'")->row()->name; ?></option>
														<?php foreach ($choice_option->values as $row) { ?>
															<option value="<?= $row; ?>">
																<?= $row; ?>
															</option>
														<?php } ?>
													</select>
												</div>


											</div>
									<?php }
									} ?>
								</form>

								<div class="">
									<div class=" flex flex-col w-full items-left">
										<div class="w-1/3 mb-4">
											<div class="input-group">
												<input class="quantity form-control" type="number" min="10" max="1000" id="user_qty" value="10">
												<button class="quantity-plus w-icon-plus"></button>
												<button class="quantity-minus w-icon-minus"></button>
											</div>
										</div>

										<button class="btn btn-primary btn-cart mb-4">
										<!-- <button class="btn btn-primary btn-cart mb-4" onclick="addToCart()"> -->
											<i class="w-icon-cart"></i>
											<span>Add to Cart</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="d-flex justify-content-center">
						<div class="widget widget-icon-box mb-6 d-flex">
							<div class="icon-box">
								<span class="icon-box-icon text-dark">
									<i class="icon-size w-icon-truck"></i>
								</span>
								<div class="icon-box-content">
									<h4 class="icon-box-title">Customer Support Assistance</h4>
									<p>Dedicated Customer Support</p>
								</div>
							</div>
							<div class="icon-box">
								<span class="icon-box-icon text-dark">
									<i class="icon-size w-icon-bag"></i>
								</span>
								<div class="icon-box-content">
									<h4 class="icon-box-title">Secure Payment</h4>
									<p>We ensure secure payment</p>
								</div>
							</div>
							<div class="icon-box">
								<span class="icon-box-icon text-dark">
									<i class="icon-size w-icon-money"></i>
								</span>
								<div class="icon-box-content">
									<h4 class="icon-box-title">Money Back Guarantee</h4>
									<p>Any back within 10 days</p>
								</div>
							</div>
						</div>
					</div>

					<div class="tab tab-nav-boxed tab-nav-underline product-tabs">
						<ul class="nav nav-tabs justify-content-center" role="tablist">
							<li class="nav-item">
								<a href="#product-tab-description" class="nav-link active">Description</a>
							</li>
							<li class="nav-item">
								<a href="#product-tab-reviews" class="nav-link">Customer Reviews (<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows(); ?>)</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="product-tab-description">
								<?= $product['description']; ?>
							</div>
							<div class="tab-pane" id="product-tab-reviews">
								<div class="row mb-4">
									<div class="col-xl-12 col-lg-12 mb-4">
										<div class="ratings-wrapper d-flex justify-content-center">
											<div class="avg-rating-container">
												<h4 class="avg-mark font-weight-bolder ls-50"><?= $product['rating']; ?></h4>
												<div class="avg-rating">
													<p class="text-dark mb-1">Average Rating</p>
													<div class="ratings-container">
														<div class="ratings-full">
															<span class="ratings" style="width: <?= ($product['rating'] * 100 / 5); ?>%;"></span>
															<span class="tooltiptext tooltip-top"></span>
														</div>
														<a href="#" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
													</div>
												</div>
											</div>

										</div>
									</div>

								</div>

								<div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
									<?php $reviews = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'"); ?>
									<div class="tab-content">
										<div class="tab-pane active" id="show-all">
											<?php if ($reviews->num_rows() == 0) { ?>
												<p style="color:red; text-align:center;">No review found.</p>
											<?php } else { ?>
												<ul class="comments list-style-none">
													<?php foreach ($reviews->result_array() as $review) { ?>
														<li class="comment">
															<div class="comment-body">
																<div class="comment-content">
																	<h4 class="comment-author">
																		<a href="javascript:void(0)"><?= $this->db->query("SELECT * FROM app_users where id = '{$review['user_id']}'")->row()->full_name; ?></a>
																		<span class="comment-date"><?= date('F j, Y', strtotime($review['created_date'])); ?> at <?= date('h:i a', strtotime($review['created_date'])); ?></span>
																	</h4>
																	<div class="ratings-container comment-rating">
																		<div class="ratings-full">
																			<span class="ratings"
																				style="width: <?= ($review['rating'] * 100 / 5); ?>%;">%;"></span>
																			<span
																				class="tooltiptext tooltip-top"></span>
																		</div>
																	</div>
																	<p><?= $review['comment']; ?></p>

																</div>
															</div>
														</li>
													<?php } ?>
												</ul>
											<?php } ?>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<!-- End of Main Content -->
				<!-- <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
					<div class="sidebar-overlay"></div>
					<a class="sidebar-close" href="#"><i class="close-icon"></i></a>
					<a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
					<div class="sidebar-content scrollable">
						<div class="sticky-sidebar">
							<div class="widget widget-icon-box mb-6">
								<div class="icon-box icon-box-side">
									<span class="icon-box-icon text-dark">
										<i class="w-icon-truck"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title">Customer Support Assistance</h4>
										<p>Dedicated Customer Support</p>
									</div>
								</div>
								<div class="icon-box icon-box-side">
									<span class="icon-box-icon text-dark">
										<i class="w-icon-bag"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title">Secure Payment</h4>
										<p>We ensure secure payment</p>
									</div>
								</div>
								<div class="icon-box icon-box-side">
									<span class="icon-box-icon text-dark">
										<i class="w-icon-money"></i>
									</span>
									<div class="icon-box-content">
										<h4 class="icon-box-title">Money Back Guarantee</h4>
										<p>Any back within 10 days</p>
									</div>
								</div>
							</div>

							<div class="widget widget-banner mb-9">
								<div class="banner banner-fixed br-sm">
									<figure>
										<img src="<?= base_url(); ?>uploads/product-img-banner.jpg" alt="Banner" width="266"
											height="220" style="background-color: #1D2D44;" />
									</figure>

								</div>
							</div>

						</div>
					</div>
				</aside> -->
				
			</div>
		</div>
	</div>
</main>

<script>
	function getVariantDetails() {
		$(".preloader").show();
		var formdata = $("#choice_options_form").serialize();

		formdata += '&product_id=' + $("#product_id").val();

		$.ajax({
			type: "POST",
			url: '<?= base_url(); ?>products/get_sku_combination/',
			data: formdata,
			success: function(data) {
				console.log(data);
				const obj = JSON.parse(data);
				$(".preloader").hide();
				if (obj.status != -1) {
					if (obj.status == 1) {
						console.log(obj);
						$("#product_sku").show();
						$("#product_stock").show();
						$("#product_sku").html("SKU : <span>" + obj.sku + "</span>");
						if (obj.discount > 0) {
							$("#product-price").html("<del class='old-price'>£ " + obj.price + "</del> <ins class='new-price'>£ " + obj.discount + "</ins>");
						} else {
							$("#product-price").html("<ins class='new-price'>£ " + obj.price + "</ins>");
						}

						if (obj.qty < 10) {
							$("#product_stock").html('<span style="color:red;">' + obj.qty + ' left in stock</span>');
						} else {
							$("#product_stock").html('<span style="color:green;">' + obj.qty + ' left in stock</span>');
						}


						if (obj.image != null && obj.image != '') {
							$("#thumbdiv").find("img").attr('src', '<?= base_url(); ?>uploads/products/' + obj.image);
						}


					} else {
						//   $("#product-price").html("<ins class='new-price'>£ "+$("#product-price-orignal").val()+"</ins>");
						$("#product_sku").hide();
						$('#choice_options_form').trigger("reset"); //Line1
						$('#choice_options_form select').trigger("change"); //Line2
						alert('Error from getting details, try again later.');
						location.reload();
					}
				}

			}
		});
	}

	function getPriceVariantDetails() {
		$(".preloader").show();
		var formdata = $("#choice_options_form").serialize();

		formdata += '&product_id=' + $("#product_id").val();

		$.ajax({
			type: "POST",
			url: '<?= base_url(); ?>products/get_sku_combination/',
			data: formdata,
			success: function(data) {
				console.log(data);
				const obj = JSON.parse(data);
				$(".preloader").hide();
				if (obj.status != -1) {
					if (obj.status == 1) {
						console.log(obj);
						$("#product_sku").show();
						$("#product_stock").show();
						$("#product_sku").html("SKU : <span>" + obj.sku + "</span>");
						if (obj.discount > 0) {
							$("#product-price").html("<del class='old-price'>£ " + obj.price + "</del> <ins class='new-price'>£ " + obj.discount + "</ins>");
						} else {
							$("#product-price").html("<ins class='new-price'>£ " + obj.price + "</ins>");
						}

						if (obj.qty < 10) {
							$("#product_stock").html('<span style="color:red;">' + obj.qty + ' left in stock</span>');
						} else {
							$("#product_stock").html('<span style="color:green;">' + obj.qty + ' left in stock</span>');
						}


						if (obj.image != null && obj.image != '') {
							$("#thumbdiv").find("img").attr('src', '<?= base_url(); ?>uploads/products/' + obj.image);
						}


					} else {
						//   $("#product-price").html("<ins class='new-price'>£ "+$("#product-price-orignal").val()+"</ins>");
						$("#product_sku").hide();
						$('#choice_options_form').trigger("reset"); //Line1
						$('#choice_options_form select').trigger("change"); //Line2
						alert('Error from getting details, try again later.');
						location.reload();
					}
				}

			}
		});
	}
</script>

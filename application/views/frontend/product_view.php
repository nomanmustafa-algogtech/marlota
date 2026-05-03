<?php $category = $this->db->query("SELECT * FROM app_categories where id = '{$product['category_id']}'")->row_array();
$brand = $this->db->query("SELECT * FROM app_brands where id = '{$product['brand_id']}'")->row_array();
$stock = $this->db->query("SELECT * FROM app_product_stocks where product_id = '{$product['id']}'");
?>
<style>
.list-type-check li {
	position: relative;
	padding-left: 25px; 
	margin-bottom: 8px;
	font-size: 16px;
}
.list-type-check li::before {
  content: "✔"; 
  position: absolute;
  left: 0;
  top: 0;
  color: green;
  font-weight: bold;
}
</style>
<input type="hidden" id="product_id" value="<?= $product['id']; ?>" />
    <section class="product product-info">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="<?= base_url(); ?>">Home</a></span>
                <span class="devider">/</span>
                <span><a href="<?= base_url(); ?>products">Products</a></span>
                <span class="devider">/</span>
                <span><a href="<?= $product['slug']; ?>"><?= $product['name']; ?></a></span>
            </div>
            <div class="product-info-section">
                <div class="row ">
                 <div class="col-md-4">
					<div class="product-info-img" data-aos="fade-right">
						<!-- Top Slider (Main Images) -->
							<div class="swiper product-top">
								<div class="swiper-wrapper">
									<div class="swiper-slide slider-top-img product-media">
										<a href="<?= base_url('uploads/products/' . $product['thumbnail_img']); ?>" data-fancybox="gallery">
											<img  src="<?= base_url('uploads/products/' . $product['thumbnail_img']); ?>" alt="product-img">
										</a>
									</div>

									<?php if (!empty($product['photos'])): ?>
										<?php foreach (explode(',', $product['photos']) as $pic): ?>
											<div class="swiper-slide slider-top-img">
											<a href="<?= base_url('uploads/products/' . $pic); ?>" data-fancybox="gallery">
												<img src="<?= base_url('uploads/products/' . $pic); ?>" alt="product-img">
											</a>
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
							<!-- Bottom Thumbnails -->
							<div class="swiper product-bottom">
								<div class="swiper-wrapper">
									<div class="swiper-slide slider-bottom-img">
										<img src="<?= base_url('uploads/products/' . $product['thumbnail_img']); ?>" alt="product-thumb">
									</div>
									<?php if (!empty($product['photos'])): ?>
										<?php foreach (explode(',', $product['photos']) as $pic): ?>
											<div class="swiper-slide slider-bottom-img">
												<img src="<?= base_url('uploads/products/' . $pic); ?>" alt="product-thumb">
											</div>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
					</div>
				</div>

                    <div class="col-md-8">
                        <div class="product-info-content" data-aos="fade-left">
                           <span class="wrapper-subtitle"><?= $brand['name'] ?? null ?></span>

                            <h5 class="product-name"><?= $product['name']; ?>
                            </h5>
							<div class="divider"></div>
						
							<input type="hidden" value="<?= $product['slug']; ?>" id="product-slug" />
                            <div class="ratings">
								<span class="stars">
									<?php 
									$rating = $product['rating']; // from DB
									$fullStars = floor($rating);
									$halfStar = ($rating - $fullStars >= 0.5) ? true : false;
									$emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

									// Full stars
									for ($i = 0; $i < $fullStars; $i++) { ?>
										<svg width="15" height="15" viewBox="0 0 15 15" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
												fill="#FFA800" />
										</svg>
									<?php }

									// Half star (optional: you can design half star with gradient or SVG mask)
									if ($halfStar) { ?>
										<svg width="15" height="15" viewBox="0 0 15 15" xmlns="http://www.w3.org/2000/svg">
											<defs>
												<linearGradient id="half-grad">
													<stop offset="50%" stop-color="#FFA800"/>
													<stop offset="50%" stop-color="#E0E0E0"/>
												</linearGradient>
											</defs>
											<path
												d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
												fill="url(#half-grad)" />
										</svg>
									<?php }

									// Empty stars
									for ($i = 0; $i < $emptyStars; $i++) { ?>
										<svg width="15" height="15" viewBox="0 0 15 15" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												<!--d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"-->
												<!--fill="#E0E0E0" />-->
										</svg>
									<?php } ?>
								</span>

								<!--<span class="text">-->
								<!--	(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows(); ?> Reviews)-->
								<!--</span>-->
							</div>

                            <div class="price" id="product-price">
								<?php if ($stock->num_rows() > 1) {
									$low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price ASC")->row();
								?>
									<?php if ($low_price->discount > 0) { ?>
										<span class="price-cut">£ <?= $low_price->price; ?></span>
										<span class="new-price">£ <?= $low_price->discount; ?></span>
									<?php } else { ?>
										<span class="new-price">£ <?= $low_price->price; ?></span>
									<?php } ?>
								<?php } else { ?>
									<?php if ($stock->row()->discount > 0) { ?>
										<span class="price-cut">£ <?= $stock->row()->price; ?></span>
										<span class="new-price">£ <?= $stock->row()->discount; ?></span>
										<input type="hidden" id="product-price-orignal" value="£ <?= $stock->row()->discount; ?>" />
									<?php } else { ?>
										<span class="new-price">£ <?= $stock->row()->price; ?></span>
										<input type="hidden" id="product-price-orignal" value="£ <?= $stock->row()->price; ?>" />
									<?php } ?>
								<?php } ?>
							</div>

                            <p class="content-paragraph">
								<ul class="list-type-check list-style-none">
									<li>Customer Support Assistance</li>
									<li>10 Days free returns</li>
									<li>Return collection from doorstep</li>
									<li>FREE UK Standard Delivery</li>
								</ul>
							</p>
                            <hr>
							
							<?php if ($stock->num_rows() == 1): ?>
								<?php $qty = $stock->row()->qty; ?>
								<div class="product-availability" id="product_stock">
									<span>Availability : </span>
									<span class="inner-text" style="color: <?= ($qty < 10) ? 'red' : 'green'; ?>;">
										<?= $qty; ?> Products Available
									</span>
								</div>
							<?php else: ?>
								<!-- Variable product: hidden initially -->
								<div class="product-availability" id="product_stock" style="display:none;">
									<span>Availability : </span>
									<span class="inner-text" id="stock_text"></span>
								</div>
							<?php endif; ?>


								<form id="choice_options_form_variant" class="choice-options-form" action="" method="post">
									<?php if ($product['variant_product'] == 1) { ?>
										<?php foreach (json_decode($product['choice_options']) as $key => $choice_option) { ?>
											<input type="hidden" name="choice_no[]" value="<?= $choice_option->attribute_id; ?>">

											<div class="mb-3">
												<label class="form-label fw-bold">
													<?= $this->db->query("SELECT name FROM app_attributes WHERE id='" . $choice_option->attribute_id . "'")->row()->name; ?>:
												</label>
												<select class="form-select w-50" 
														name="choice_options_<?= $choice_option->attribute_id; ?>" 
														id="choice_options_<?= $choice_option->attribute_id; ?>" 
														onchange="getVariantDetails();">
													<option value="">Select <?= $this->db->query("SELECT name FROM app_attributes WHERE id='" . $choice_option->attribute_id . "'")->row()->name; ?></option>
													<?php foreach ($choice_option->values as $row) { ?>
														<option value="<?= $row; ?>"><?= $row; ?></option>
													<?php } ?>
												</select>
											</div>
										<?php } ?>
									<?php } ?>
								</form>

								<!-- Variation for price pack -->
								<form id="choice_options_form_price" class="choice-options-form" action="" method="post">
									<?php if ($product['variant_product'] == 4) { ?>
										<?php foreach (json_decode($product['choice_options']) as $key => $choice_option) { ?>
											<input type="hidden" name="choice_no[]" value="<?= $choice_option->attribute_id; ?>">

											<div class="mb-3">
												<label class="form-label fw-bold">
													<?= $this->db->query("SELECT name FROM app_attributes WHERE id='" . $choice_option->attribute_id . "'")->row()->name; ?>:
												</label>
												<select class="form-select w-75"
														name="choice_options_<?= $choice_option->attribute_id; ?>" 
														id="choice_options_<?= $choice_option->attribute_id; ?>" 
														onchange="getPriceVariantDetails();">
													<option value="">Select <?= $this->db->query("SELECT name FROM app_attributes WHERE id='" . $choice_option->attribute_id . "'")->row()->name; ?></option>
													<?php foreach ($choice_option->values as $row) { ?>
														<option value="<?= $row; ?>"><?= $row; ?></option>
													<?php } ?>
												</select>
											</div>
										<?php } ?>
									<?php } ?>
								</form>

                            <div class="product-quantity">
                               <div class="quantity-wrapper">
									<div class="quantity" data-product-id="<?= $product['id']; ?>" data-price="<?= $stock->row()->price; ?>">
										<span class="minus">-</span>
										<span class="number"><?= $stock->row()->qty > 0 ? 1 : 0; ?></span>
										<span class="plus">+</span>
									</div>
								
								</div>
								<?php if ($stock->row()->qty > 0) { ?>
									<button class="shop-btn btn-cart">
										<span>
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M8.25357 3.32575C8.25357 4.00929 8.25193 4.69283 8.25467 5.37583C8.25576 5.68424 8.31536 5.74439 8.62431 5.74439C9.964 5.74603 11.3031 5.74275 12.6428 5.74603C13.2728 5.74767 13.7397 6.05663 13.9246 6.58104C14.2209 7.42098 13.614 8.24232 12.6762 8.25052C11.5919 8.25982 10.5075 8.25271 9.4232 8.25271C9.17714 8.25271 8.93107 8.25216 8.68501 8.25271C8.2913 8.2538 8.25412 8.29154 8.25412 8.69838C8.25357 10.0195 8.25686 11.3412 8.25248 12.6624C8.25029 13.2836 7.92603 13.7544 7.39891 13.9305C6.56448 14.2088 5.75848 13.6062 5.74863 12.6821C5.73824 11.7251 5.74645 10.7687 5.7459 9.81173C5.7459 9.41965 5.74754 9.02812 5.74535 8.63604C5.74371 8.30849 5.69012 8.2538 5.36204 8.25326C4.02235 8.25162 2.68321 8.25545 1.34352 8.25107C0.719613 8.24943 0.249902 7.93008 0.0710952 7.40348C-0.212153 6.57065 0.388245 5.75916 1.31017 5.74658C2.14843 5.73564 2.98669 5.74384 3.82495 5.74384C4.30779 5.74384 4.79062 5.74384 5.274 5.74384C5.72184 5.7433 5.7459 5.71869 5.7459 5.25716C5.7459 3.95406 5.74317 2.65096 5.74699 1.34786C5.74863 0.720643 6.0625 0.253102 6.58799 0.0704598C7.40875 -0.213893 8.21803 0.370671 8.25248 1.27349C8.25303 1.29154 8.25303 1.31013 8.25303 1.32817C8.25357 1.99531 8.25357 2.66026 8.25357 3.32575Z"
													fill="white" />
											</svg>
										</span>
										<span>Add to Cart</span>
									</button>
								<?php } else { ?>
									<button class="shop-btn btn-cart disabled" disabled style="background:#ccc; cursor:not-allowed;">
										<span>
											<svg width="14" height="14" viewBox="0 0 14 14" fill="none"
												xmlns="http://www.w3.org/2000/svg">
												<path
													d="M8.25357 3.32575C8.25357 4.00929 8.25193 4.69283 8.25467 5.37583C8.25576 5.68424 8.31536 5.74439 8.62431 5.74439C9.964 5.74603 11.3031 5.74275 12.6428 5.74603C13.2728 5.74767 13.7397 6.05663 13.9246 6.58104C14.2209 7.42098 13.614 8.24232 12.6762 8.25052C11.5919 8.25982 10.5075 8.25271 9.4232 8.25271C9.17714 8.25271 8.93107 8.25216 8.68501 8.25271C8.2913 8.2538 8.25412 8.29154 8.25412 8.69838C8.25357 10.0195 8.25686 11.3412 8.25248 12.6624C8.25029 13.2836 7.92603 13.7544 7.39891 13.9305C6.56448 14.2088 5.75848 13.6062 5.74863 12.6821C5.73824 11.7251 5.74645 10.7687 5.7459 9.81173C5.7459 9.41965 5.74754 9.02812 5.74535 8.63604C5.74371 8.30849 5.69012 8.2538 5.36204 8.25326C4.02235 8.25162 2.68321 8.25545 1.34352 8.25107C0.719613 8.24943 0.249902 7.93008 0.0710952 7.40348C-0.212153 6.57065 0.388245 5.75916 1.31017 5.74658C2.14843 5.73564 2.98669 5.74384 3.82495 5.74384C4.30779 5.74384 4.79062 5.74384 5.274 5.74384C5.72184 5.7433 5.7459 5.71869 5.7459 5.25716C5.7459 3.95406 5.74317 2.65096 5.74699 1.34786C5.74863 0.720643 6.0625 0.253102 6.58799 0.0704598C7.40875 -0.213893 8.21803 0.370671 8.25248 1.27349C8.25303 1.29154 8.25303 1.31013 8.25303 1.32817C8.25357 1.99531 8.25357 2.66026 8.25357 3.32575Z"
													fill="white" />
											</svg>
										</span>
										<span>Out of Stock</span>
									</button>
								<?php } ?>

                            </div>
                            <hr>

                            <div class="product-details">
                                <p class="category">Category : <span class="inner-text"><a href="<?= base_url(); ?>products/?category=<?= $category['slug']; ?>"><?= $category['name']; ?></a></span></p>
								<?php if ($stock->num_rows() == 1) { ?>
									<p class="sku">SKU : <span class="inner-text"><?= $stock->row()->sku; ?></span></p>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--------------- products-info-end--------------->

    <!--------------- products-details-section--------------->
    <section class="product product-description">
        <div class="container">
            <div class="product-detail-section">
                <nav>
                    <div class="nav nav-tabs nav-item" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Description</button>
                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review"
                            type="button" role="tab" aria-controls="nav-review" aria-selected="false">Reviews</button>
                    </div>
                </nav>
                <div class="tab-content tab-item" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0" data-aos="fade-up">
                        <div class="product-intro-section">
                            <?= $product['description']; ?>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab"
                        tabindex="0">
                        <div class="product-review-section" data-aos="fade-up">
                            <h5 class="intro-heading">Reviews</h5>

                            <div class="review-wrapper">
                                <div class="wrapper">
                                    <div class="wrapper-aurthor">
                                      
                                        <?php 
											// Fetch rating (0–5) and reviews
											$rating = $product['rating']; 
											$reviews = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows();

											// Round rating to 1 decimal place
											$ratingFormatted = number_format($rating, 1); 
										?>
										<div class="ratings flex items-center gap-1">
											<span class="stars flex">
												<?php for ($i = 1; $i <= 5; $i++): ?>
													<svg width="15" height="15" viewBox="0 0 15 15" fill="none"
														xmlns="http://www.w3.org/2000/svg">
														<path
															d="M7.5 0L9.18386 5.18237H14.6329L10.2245 8.38525L11.9084 13.5676L7.5 10.3647L3.09161 13.5676L4.77547 8.38525L0.367076 5.18237H5.81614L7.5 0Z"
															fill="<?= ($i <= floor($rating)) ? '#FFA800' : '#E0E0E0'; ?>" />
													</svg>
												<?php endfor; ?>
											</span>
											<span>(<?= $ratingFormatted; ?>)</span>
											<a href="#" class="rating-reviews ml-2">(<?= $reviews; ?> Reviews)</a>
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
    <!--------------- products-details-end--------------->

    <!--------------- weekly-section--------------->
    <section class="product weekly-sale product-weekly footer-padding">
        <div class="container">
            <div class="section-title">
                <h5>Best Sell in this Week</h5>
            </div>
            <div class="weekly-sale-section">
                <div class="row g-4">
					<?php
						$new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,4")->result_array();
						foreach ($new_arrivals as $row) {
						$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
						$review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
						$filled = round($row['rating']);
						if ($stocks->num_rows() > 1) {
							$lp = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
						} else {
							$lp = $stocks->row();
						}
						$show_old = ($lp && $lp->discount > 0);
						$display_price = ($show_old) ? $lp->discount : ($lp ? $lp->price : 0);
						$old_price = $lp ? $lp->price : 0;
						$pct_off = ($show_old && $old_price > 0) ? round(($old_price - $display_price) / $old_price * 100) : 0;
					?>
					<div class="col-lg-3 col-sm-6">
						<div class="product-card-new">
							<div class="pc-image-wrap">
								<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
									<img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>">
								</a>
								<?php if ($pct_off > 0) { ?><span class="pc-badge-off"><?= $pct_off; ?>% OFF</span><?php } ?>
							</div>
							<div class="pc-body">
								<div class="pc-rating">
									<div class="pc-stars">
										<?php for ($s = 1; $s <= 5; $s++) { ?>
										<i class="fa fa-star<?= ($s <= $filled) ? '' : ($s - 0.5 <= $row['rating'] ? '-half-o' : '-o'); ?>"></i>
										<?php } ?>
									</div>
									<span class="pc-review-count"><?= $review_count; ?> Reviews</span>
								</div>
								<div class="pc-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></div>
								<div class="pc-price-row">
									<span class="pc-price">£<?= $display_price; ?></span>
									<?php if ($show_old) { ?><span class="pc-old-price">£<?= $old_price; ?></span><?php } ?>
									<?php if ($pct_off > 0) { ?><span class="pc-pct-off"><?= $pct_off; ?>% OFF</span><?php } ?>
								</div>
								<div class="pc-fast-delivery">
									<span class="pc-fd-fast">Fast</span>
									<span class="pc-fd-label">Delivery</span>
								</div>
							</div>
						</div>
					</div>
					<?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!--------------- weekly-section-end--------------->
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" />

<script>
	function getVariantDetails() {
		$(".preloader").show();
		var formdata = $("#choice_options_form_variant").serialize();

		formdata += '&product_id=' + $("#product_id").val();

		$.ajax({
			type: "POST",
			url: '<?= base_url(); ?>products/get_sku_combination/',
			dataType: 'json',
			data: formdata,
			success: function(obj) {
				console.log(obj);
				$(".preloader").hide();
				if (obj.status != -1) {
					if (obj.status == 1) {
						// Show SKU + stock only after variant is selected
						$("#product_sku").show();
						$("#product_stock").show();

						$("#product_sku").html("SKU : <span>" + obj.sku + "</span>");

						if (obj.discount > 0) {
							$("#product-price").html("<del class='old-price'>£ " + obj.price + "</del> <ins class='new-price'>£ " + obj.discount + "</ins>");
						} else {
							$("#product-price").html("<ins class='new-price'>£ " + obj.price + "</ins>");
						}

						// ✅ Update stock availability dynamically
						if (obj.qty < 10) {
							$("#stock_text").css("color", "red").text(obj.qty + " left in stock");
						} else {
							$("#stock_text").css("color", "green").text(obj.qty + " left in stock");
						}

						// Update image if variant has one
						if (obj.image != null && obj.image != '') {
							$("#thumbdiv").find("img").attr('src', '<?= base_url(); ?>uploads/products/' + obj.image);
						}
					} else {
						$("#product_sku").hide();
						$("#product_stock").hide();
						alert('Error while getting details, please try again later.');
						location.reload();
					}
				}

			},
			error: function() {
				$(".preloader").hide();
				alert('Unable to load variant details. Please try again.');
			}
		});
	}

	function getPriceVariantDetails() {
		$(".preloader").show();
		var formdata = $("#choice_options_form_price").serialize();

		formdata += '&product_id=' + $("#product_id").val();

		$.ajax({
			type: "POST",
			url: '<?= base_url(); ?>products/get_sku_combination/',
			dataType: 'json',
			data: formdata,
			success: function(obj) {
				console.log(obj);
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
						$("#product_sku").hide();
						$('#choice_options_form_price').trigger("reset");
						$('#choice_options_form_price select').trigger("change");
						alert('Error from getting details, try again later.');
						location.reload();
					}
				}
			},
			error: function() {
				$(".preloader").hide();
				alert('Unable to load variant details. Please try again.');
			}
		});
	}

Fancybox.bind("[data-fancybox='gallery']", {
  Thumbs: false,
  Toolbar: { display: ["zoom", "close"] },
});
</script>

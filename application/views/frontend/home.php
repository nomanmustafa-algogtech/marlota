<!--------------- hero-section --------------->
<section id="hero" class="hero hero-two">
	<div class="container">
		<div class="hero-section-two">
			<div class="row g-5">
			<?php
			// Get first slider (latest one by sorting DESC)
			$slider1 = $this->db->query("SELECT * FROM app_sliders ORDER BY sorting DESC LIMIT 1")->row_array();

			// Get second slider (next one)
			$slider2 = $this->db->query("SELECT * FROM app_sliders ORDER BY sorting DESC LIMIT 1 OFFSET 1")->row_array();
			?>

			<!-- Left Slider -->
			<?php if (!empty($slider1)) { ?>
			<div class="col-lg-7">
				<div class="hero-left hero-wrapper-two" 
					style="background-image: url('<?= base_url(); ?>uploads/sliders/<?= $slider1['image']; ?>');
							background-size: cover;
							background-position: center;">
					<div class="wrapper-content">
						
							<h1 class="wrapper-title"><?= $slider1['title']; ?></h1>
							<h5 class="wrapper-details"><?= $slider1['subtitle']; ?></h5>
							<p><?= $slider1['text']; ?></p>
							<a href="<?= $slider1['link']; ?>" class="shop-btn">
								<?= $slider1['button_title']; ?>
								<span>
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.6667 13.3333L15 9.99992M15 9.99992L11.6667 6.66658M15 9.99992L5 9.99992"
											stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</span>
							</a>

					</div>
				</div>
			</div>
			<?php } ?>

			<!-- Right Slider -->
			<?php if (!empty($slider2)) { ?>
			<div class="col-lg-5">
				<div class="hero-right hero-wrapper-two" 
					style="background-image: url('<?= base_url(); ?>uploads/sliders/<?= $slider2['image']; ?>');
							background-size: cover;
							background-position: center;">
					<div class="wrapper-content" data-aos="zoom-in" data-aos-duration="500">

							<h2 class="wrapper-title"><?= $slider2['title']; ?></h2>
							<h5 class="wrapper-details"><?= $slider2['subtitle']; ?></h5>
							<a href="<?= $slider2['link']; ?>" class="shop-btn">
								<?= $slider2['button_title']; ?>
								<span>
									<svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M11.6667 13.3333L15 9.99992M15 9.99992L11.6667 6.66658M15 9.99992L5 9.99992"
											stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
									</svg>
								</span>
							</a>
					</div>
				</div>
			</div>
			<?php } ?>


			</div>
		</div>

	</div>
</section>
<!--------------- hero-section-end --------------->

<!--------------- category-section--------------->
<section class="product-category product-category-two">
	<div class="container">
		<div class="section-title">
			<h5>Our Categories</h5>
			
		</div>
		<div class="category-section category-section-two">
			<?php
			$categories = $this->db->query("SELECT * FROM app_categories WHERE level = 0");
			foreach ($categories->result_array() as $row) {
				// Ensure there is an image and a name for the category
				if (!empty($row['image']) && !empty($row['name'])) {
			?>
						<div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
							<a href="<?= base_url(); ?>products/?category=<?= $row['slug']; ?>">
							<div class="wrapper-img">
								<img src="<?= base_url(); ?>uploads/categories/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" />
							</div>
							<div class="wrapper-info">
								<a href="<?= base_url(); ?>products/?category=<?= $row['slug']; ?>" class="wrapper-details"><?= $row['name']; ?></a>
							</div>
						</a>
						</div>
			<?php }
			} ?>
		</div>
	</div>
</section>
<!--------------- category-section-end--------------->

<!--------------- arrival-section--------------->
<section class="product arrival arrival-two">
	<div class="container">
		<div class="section-title">
			<h5>NEW ARRIVALS</h5>
			<a href="<?= base_url("products/"); ?>" class="view">View All</a>
		</div>
		<div class="arrival-section">
			<div class="row g-5">
				<?php
				$new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,20")->result_array();
				foreach ($new_arrivals as $row) {
					$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
					$words = explode(' ', $row['name']);
					$shortName = implode(' ', array_slice($words, 0, 7)); // 8 words max
					$productName = $shortName . (count($words) > 7 ? '...' : '');
				?>
					<div class="col-lg-3 col-sm-6">
						<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
							<div class="product-wrapper product-wrapper-two" data-aos="fade-up">
								<div class="product-img">
									<img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="product-img" />

								</div>
								<div class="product-info">
									<?php
												$rating = $row['rating']; // rating value 0–5
												$reviews = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows();
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
													<span class="ml-1">(<?= $ratingFormatted; ?>)</span>
													<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews ml-2">
														(<?= $reviews; ?> Reviews)
													</a>
												</div>
									<div class="product-description">
										<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="product-details"> <?= $productName; ?> </a>


										<?php if ($stocks->num_rows() > 1) {
											// Multiple stock variations
											$low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
											if ($low_price->discount > 0) { ?>
												<div class="price">
													<span class="price-cut">£<?= $low_price->price; ?></span>
													<span class="new-price">£<?= $low_price->discount; ?></span>
												</div>
											<?php } else { ?>
												<div class="price">
													<span class="new-price">£<?= $low_price->price; ?></span>
												</div>
											<?php } ?>

											<?php } else {
											// Single stock variation
											$singleStock = $stocks->row();  // ✅ use this instead of $low_price
											if ($singleStock->discount > 0) { ?>
												<div class="price">
													<span class="price-cut">£<?= $singleStock->price; ?></span>
													<span class="new-price">£<?= $singleStock->discount; ?></span>
												</div>
											<?php } else { ?>
												<div class="price">
													<span class="new-price">£<?= $singleStock->price; ?></span>
												</div>
											<?php } ?>
										<?php } ?>


									</div>
								</div>
								<div class="product-cart-btn">
									<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="product-btn">Add To Cart</a>
								</div>
							</div>
						</a>
					</div>

				<?php } ?>
			</div>
		</div>
	</div>
</section>
<!--------------- arrival-section-end--------------->


<!--------------- weekly-section--------------->
<section class="product weekly-sale weekly-sale-two">
	<div class="container">


		<div class="style-section style-section-two">
			<div class="row gy-4 gx-5 gy-lg-0">
				<div class="col-lg-6">
					<div class="product-wrapper wrapper-one" data-aos="fade-right">
						<div class="wrapper-info">
							<span class="wrapper-subtitle">NEW STYLE</span>
							<h4 class="wrapper-details">Get 65% Offer <span class="wrapper-inner-title">& Make New</span> Fusion.</h4>
						
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="product-wrapper wrapper-two" data-aos="fade-up">
						<div class="wrapper-info">
							<span class="wrapper-subtitle">Mega OFFER</span>
							<h4 class="wrapper-details">
								Make your New
								<span class="wrapper-inner-title">Styles with Our</span>
								Products
							</h4>
						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--------------- weekly-section-end--------------->

<!--------------- flash-section--------------->
<section class="product best-product best-product-two">
	<div class="container">
		<div class="section-title">
			<h5>Top Selling Prodcuts</h5>
			<a href="<?= base_url("products/"); ?>" class="view">View All</a>
		</div>
		<div class="best-product-section">
			<div class="row g-4">
				<?php
				$new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' ORDER by id DESC LIMIT 0,12")->result_array();
				// echo 'new_arrivals: <pre>' .print_r($new_arrivals,true). '</pre>'; die;
				foreach ($new_arrivals as $row) {
					$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
					
					// echo 'Data: <pre>' .print_r($stocks,true). '</pre>'; 
					$words = explode(' ', $row['name']);
					$shortName = implode(' ', array_slice($words, 0, 4)); // 8 words max
					$productName = $shortName . (count($words) > 4 ? '...' : '');
				?>

					<div class="col-xl-3 col-md-4">
						<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
							<div class="product-wrapper product-wrapper-two" data-aos="fade-up">
								<div class="product-img">
									<img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="product-img" />
								</div>
								<div class="product-info">
									<?php
									$rating = $row['rating']; // rating value 0–5
									$reviews = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows();
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
										<span class="ml-1">(<?= $ratingFormatted; ?>)</span>
										<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews ml-2">
											(<?= $reviews; ?> Reviews)
										</a>
									</div>
									<div class="product-description">
										<a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="product-details"> <?= $productName; ?> </a>

										<?php 
										if ($stocks->num_rows() > 1) {
											// ✅ Multiple stock variations
											$low_price = $this->db->query("
												SELECT price, discount 
												FROM app_product_stocks 
												WHERE product_id = '{$row['id']}' 
												ORDER BY price ASC 
												LIMIT 1
											")->row();

											if ($low_price) {
												if (!empty($low_price->discount) && $low_price->discount > 0) { ?>
													<div class="price">
														<span class="price-cut">£<?= $low_price->price; ?></span>
														<span class="new-price">£<?= $low_price->discount; ?></span>
													</div>
												<?php } else { ?>
													<div class="price">
														<span class="new-price">£<?= $low_price->price; ?></span>
													</div>
												<?php }
											}

										} elseif ($stocks->num_rows() == 1) {
											// ✅ Single stock variation
											$singleStock = $stocks->row();

											if (!empty($singleStock->discount) && $singleStock->discount > 0) { ?>
												<div class="price">
													<span class="price-cut">£<?= $singleStock->price; ?></span>
													<span class="new-price">£<?= $singleStock->discount; ?></span>
												</div>
											<?php } else { ?>
												<div class="price">
													<span class="new-price">£<?= $singleStock->price; ?></span>
												</div>
											<?php }

										} else {
											// ✅ No stock at all
											echo '<div class="price"><span class="new-price">Out of Stock</span></div>';
										}
										?>
									</div>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</section>
<!--------------- flash-section-end--------------->

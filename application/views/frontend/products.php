    <!--------------- products-sidebar-section--------------->
    <section class="product product-sidebar footer-padding">
    	<div class="container">
    		<div class="row g-5">
    			<div class="col-lg-3">
    				<div class="sidebar" data-aos="fade-right">
    					<div class="sidebar-section">
    						<div class="sidebar-wrapper">
    							<h5 class="wrapper-heading">Product Categories</h5>
    							<div class="sidebar-item">
    								<ul class="sidebar-list">
    									<?php
										if ($this->input->get('category')) {
											$category = $this->db->query("SELECT * FROM app_categories WHERE slug = '{$_GET['category']}'");
											if ($category->num_rows() > 0) {
												$category = $category->row_array();
												$check_sub = $this->db->query("SELECT * FROM app_categories where parent_id = '{$category['id']}'");
												if ($check_sub->num_rows() > 0) {
													$categories = $check_sub->result_array();
												} else {
													$categories = $this->db->query("SELECT * FROM app_categories WHERE level='{$category['level']}' && parent_id='{$category['parent_id']}'")->result_array();
												}
											} else {
												$categories = $this->db->query("SELECT * FROM app_categories WHERE level=0")->result_array();
											}
										} else {
											$categories = $this->db->query("SELECT * FROM app_categories WHERE level=0")->result_array();
										}
										foreach ($categories as $row0) {  ?>
    										<li>
    											<a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>"> <label for="mobile"><?= $row0['name']; ?></label></a>
    										</li>
    									<?php } ?>
    								</ul>
    							</div>
    						</div>
    						<hr>
    					</div>
    				</div>
    			</div>
    			<div class="col-lg-9">
    				<div class="product-sidebar-section" data-aos="fade-up">
    					<div class="row g-5">
    						<div class="col-lg-12">
    							<div class="product-sorting-section">
    								<div class="result">
    									<span class="product-sort">Sort by:</span>
    									<select name="orderby" class="form-control" onchange="optionselect('orderby', this.value);">
    										<option value="default" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'default') {
																		echo 'selected';
																	} ?>>Default sorting</option>
    										<option value="popularity" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'popularity') {
																			echo 'selected';
																		} ?>>Sort by popularity</option>
    										<option value="date" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'date') {
																		echo 'selected';
																	} ?>>Sort by latest</option>
    										<option value="price_low" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'price_low') {
																			echo 'selected';
																		} ?>>Sort by pric: low to high</option>
    										<option value="price_high" <?php if (isset($_GET['orderby']) && $_GET['orderby'] == 'price_high') {
																			echo 'selected';
																		} ?>>Sort by price: high to low</option>
    									</select>
    								</div>
    								<div class="toolbox-right">
    									<div class="toolbox-item toolbox-show select-box">
    										<select name="count" class="form-control" onchange="optionselect('count', this.value);">
    											<option value="50" <?php if (isset($_GET['count']) && $_GET['count'] == 50) {
																		echo 'selected';
																	} ?>>Show 50</option>
    											<option value="100" <?php if (isset($_GET['count']) && $_GET['count'] == 100) {
																		echo 'selected';
																	} ?>>Show 100</option>
    											<option value="200" <?php if (isset($_GET['count']) && $_GET['count'] == 200) {
																		echo 'selected';
																	} ?>>Show 200</option>
    										</select>
    									</div>
    								</div>
    							</div>
    						</div>
    						<?php if (count($products) == 0) { ?>
    							<p style="color:red; text-align:center;">No products found with this criteria</p>
    						<?php } ?>
    						<?php
							foreach ($products as $product) {
								$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'");
								$category = $this->db->query("SELECT * FROM app_categories WHERE id = '{$product['category_id']}'")->row_array();
								$words = explode(' ', $product['name']);
								$shortName = implode(' ', array_slice($words, 0, 7)); // 8 words max
								$productName = $shortName . (count($words) > 7 ? '...' : '');
							?>

    							<div class="col-lg-4 col-sm-6">
									<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>">
										<div class="product-wrapper" data-aos="fade-up">
											<div class="product-img">
												<img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>" alt="<?= $product['name']; ?>">

											</div>
											<div class="product-info">
												<?php
												$rating = $product['rating']; // rating value 0–5
												$reviews = $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows();
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
													<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="rating-reviews ml-2">
														(<?= $reviews; ?> Reviews)
													</a>
												</div>

												<div class="product-description">
													<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="product-details"><?= $productName; ?>
													</a>
													<?php if ($stocks->num_rows() > 1) {
														// Multiple stock variations
														$low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price ASC")->row();
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
												<a href="cart.html" class="product-btn">Add To Cart</a>
											</div>
										</div>
									</a>
    							</div>
    						<?php } ?>
    						<div class="toolbox toolbox-pagination justify-content-between">
    							<p class="showing-info mb-2 mb-sm-0">
    								Showing<span><?= $offset; ?>-<?php $showingTotal = $pageno * $per_page;
																	if ($showingTotal > $total_rows) {
																		$showingTotal = $total_rows;
																	}
																	echo $showingTotal; ?> of <?= $total_rows; ?></span>Products
    							</p>

    							<ul class="pagination">
    								<li class="prev <?php if ($pageno <= 1) {
														echo 'disabled';
													} ?>">
    									<a href="<?php if ($pageno <= 1) {
														echo '#';
													} else {
														echo "?" . $this->Base_model->remove_url_query($_SERVER['QUERY_STRING'], 'pageno') . "&pageno=" . ($pageno - 1);
													} ?>" aria-label="Previous" tabindex="-1" aria-disabled="true">
    										<i class="w-icon-long-arrow-left"></i>Prev
    									</a>
    								</li>
    								<li class="next <?php if ($pageno >= $total_pages) {
														echo 'disabled';
													} ?>">
    									<a href="<?php if ($pageno >= $total_pages) {
														echo '#';
													} else {
														echo "?" . $this->Base_model->remove_url_query($_SERVER['QUERY_STRING'], 'pageno') . "&pageno=" . ($pageno + 1);
													} ?>" aria-label="Next">
    										Next<i class="w-icon-long-arrow-right"></i>
    									</a>
    								</li>
    							</ul>
    						</div>


    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>
    <!--------------- products-sidebar-section-end--------------->
    <script>
    	function optionselect(key, value) {
    		console.log("<?= $this->Base_model->remove_url_query($_SERVER['QUERY_STRING'], '"+key+"'); ?>");
    		if (key == 'count') {
    			window.location.href = "<?= base_url(); ?>products/?<?= $this->Base_model->remove_url_query($_SERVER['QUERY_STRING'], 'count'); ?>&" + key + "=" + value;
    		}

    		if (key == 'orderby') {
    			window.location.href = "<?= base_url(); ?>products/?<?= $this->Base_model->remove_url_query($_SERVER['QUERY_STRING'], 'orderby'); ?>&" + key + "=" + value;
    		}

    	}
    </script>

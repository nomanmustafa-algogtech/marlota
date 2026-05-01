    <!--------------- products-sidebar-section--------------->
	<section class="product product-sidebar footer-padding marlota-products-section" style="background:#fff;">
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
								<div class="col-12">
									<p style="color:red; text-align:center;">No products found with this criteria</p>
								</div>
							<?php } ?>
    						<?php
							foreach ($products as $product) {
								$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'");
								$words = explode(' ', $product['name']);
								$shortName = implode(' ', array_slice($words, 0, 7)); // 8 words max
								$productName = $shortName . (count($words) > 7 ? '...' : '');

									if ($stocks->num_rows() > 1) {
										$stockRow = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price ASC")->row();
									} else {
										$stockRow = $stocks->row();
									}

									$showOldPrice = ($stockRow && $stockRow->discount > 0);
									$displayPrice = $showOldPrice ? $stockRow->discount : ($stockRow ? $stockRow->price : 0);
									$oldPrice = $stockRow ? $stockRow->price : 0;
									$pctOff = ($showOldPrice && $oldPrice > 0) ? round((($oldPrice - $displayPrice) / $oldPrice) * 100) : 0;

									$rating = (float) $product['rating'];
									$reviews = $this->db->query("SELECT COUNT(*) AS total FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->row()->total;
									$filled = round($rating);
							?>

								<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-4">
									<div class="product-card-new product-card-listing" data-aos="fade-up">
										<div class="pc-image-wrap">
											<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>">
												<img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>" alt="<?= $product['name']; ?>">
											</a>
											<?php if ($pctOff > 0) { ?><span class="pc-badge-off"><?= $pctOff; ?>% OFF</span><?php } ?>
										</div>
										<div class="pc-body">
											<div class="pc-rating">
												<div class="pc-stars">
													<?php for ($i = 1; $i <= 5; $i++) { ?>
														<i class="fa fa-star<?= ($i <= $filled) ? '' : ($i - 0.5 <= $rating ? '-half-o' : '-o'); ?>"></i>
													<?php } ?>
												</div>
												<span class="pc-review-count"><?= $reviews; ?> Reviews</span>
											</div>
											<div class="pc-name">
												<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>"><?= $productName; ?></a>
											</div>
											<div class="pc-price-row">
												<span class="pc-price">£<?= $displayPrice; ?></span>
												<?php if ($showOldPrice) { ?><span class="pc-old-price">£<?= $oldPrice; ?></span><?php } ?>
												<?php if ($pctOff > 0) { ?><span class="pc-pct-off"><?= $pctOff; ?>% OFF</span><?php } ?>
											</div>
											<div class="pc-fast-delivery">
												<span class="pc-fd-fast">Fast</span>
												<span class="pc-fd-label">Delivery</span>
											</div>
										</div>
									</div>
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

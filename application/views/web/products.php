<style>
	.product-details {
		width: 580px;
	}

	@media only screen and (max-width: 575.98px) {
		.product-details {
			width: 320px;
		}
	}
</style>
<main class="main">
	<!-- Start of Breadcrumb -->
	<nav class="breadcrumb-nav">
		<div class="container">
			<ul class="breadcrumb bb-no">
				<li><a href="<?= base_url(); ?>">Home</a></li>
				<li><a href="#">Shop</a></li>
			</ul>
		</div>
	</nav>
	<!-- End of Breadcrumb -->

	<!-- Start of Page Content -->
	<div class="page-content">
		<div class="container">




			<!-- Start of Shop Content -->
			<div class="shop-content row gutter-lg mb-10">
				<!-- Start of Sidebar, Shop Sidebar -->
				<aside class="sidebar shop-sidebar sticky-sidebar-wrapper sidebar-fixed">
					<!-- Start of Sidebar Overlay -->
					<div class="sidebar-overlay"></div>
					<a class="sidebar-close" href="#"><i class="close-icon"></i></a>


					<!-- Start of Sidebar Content -->
					<div class="sidebar-content scrollable">
						<!-- Start of Sticky Sidebar -->
						<div class="sticky-sidebar">
							<div class="filter-actions">
								<label>Filter :</label>
								<a href="#" class="btn btn-dark btn-link filter-clean">Clean All</a>
							</div>
							<style>
								.widget-collapsible .toggle-btn::before,
								.widget-collapsible .toggle-btn::after {
									content: "";
									position: absolute;
									border-top: 2px solid #fff;
								}
							</style>
							<!-- Start of Collapsible widget -->
							<div class="widget widget-collapsible">
								<h3 class="widget-title" style="color: #fff;background: #bc8c59; border-radius: 5px;padding: 10px;"><span>Related Categories</span></h3>
								<ul class="widget-body filter-items search-ul">
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
										<li style="background: #871919;
											color: white;
											border-radius: 5px;
											padding: 10px;margin-top: 5px;">
									<a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>" style="padding: 0px;"><?= $row0['name']; ?></a></li>
									<?php } ?>
								</ul>
							</div>

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
							<!-- Start of Shop Main Content -->
							<div class="main-content">
								<nav class="toolbox sticky-toolbox sticky-content fix-top sidebar-fixed">
									<div class="toolbox-left">
										<a href="#" class="btn btn-primary btn-outline btn-rounded left-sidebar-toggle 
                                    btn-icon-left d-block d-lg-none"><i
												class="w-icon-category"></i><span>Filters</span></a>
										<div class="toolbox-item toolbox-sort select-box text-dark">
											<label>Sort By :</label>
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
								</nav>
								<div class="product-wrapper row cols-md-1 cols-xs-2 cols-1">
									<?php if (count($products) == 0) { ?>
										<p style="color:red; text-align:center;">No products found with this criteria</p>
									<?php } ?>
									<?php
									foreach ($products as $product) {
										$stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'");
										$category = $this->db->query("SELECT * FROM app_categories WHERE id = '{$product['category_id']}'")->row_array(); ?>
										<div class="card mb-2">
											<div class="card-body">
												<div class="product product-list product-select">
													<figure class="product-media">
														<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>">
															<img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>" alt="<?= $product['name']; ?>" style="width:300px; height:270px" />
														</a>
														<!--<div class="product-action-vertical">-->
														<!--    <a href="#" class="btn-product-icon btn-quickview w-icon-search"-->
														<!--        title="Quick View"></a>-->
														<!--</div>-->
													</figure>
													<div class="product-details">
														<div class="product-cat">
															<a href="<?= base_url(); ?>products/?category=<?= $category['slug']; ?>"><?= $category['name']; ?></a>
														</div>
														<h4 class="product-name">
															<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>"><?= $product['name']; ?></a>
														</h4>
														<div class="ratings-container">
															<div class="ratings-full">
																<span class="ratings" style="width: <?= ($product['rating'] * 100 / 5); ?>%;"></span>
																<span class="tooltiptext tooltip-top"></span>
															</div>
															<a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$product['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
														</div>
														<?php if ($stocks->num_rows() > 1) {
															$low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}' ORDER BY price asc")->row();

														?>
															<div class="product-price">
																<?php if ($low_price->discount > 0) { ?>
																	<del class="old-price">£ <?= $low_price->price; ?></del>
																	<ins class="new-price">£ <?= $low_price->discount; ?></ins>
																<?php } else { ?>
																	<ins class="new-price">£ <?= $low_price->price; ?></ins>
																<?php } ?>
															</div>
														<?php } else { ?>
															<div class="product-price">
																<?php if ($stocks->row()->discount > 0) { ?>
																	<del class="old-price">£ <?= $stocks->row()->price; ?></del>
																	<ins class="new-price">£ <?= $stocks->row()->discount; ?></ins>
																<?php } else { ?>
																	<ins class="new-price">£ <?= $stocks->row()->price; ?></ins>
																<?php } ?>
															</div>
														<?php } ?>
														<ul class="product-desc">
															<li>Customer Support Assistance</li>
															<li>10 Days free returns</li>
															<li>Return collection from doorstep</li>
															<?php
															$text = $this->Base_model->plainText($product['description']);
															$length = strlen($text);
															if ($length > 300) {
																$text = substr(strip_tags($text), 0, 300) . '....';
															}
															// echo $text;
															?>
														</ul>
														<!--<div class="product-action">-->
														<!--    <?php if ($stocks->num_rows() > 1) { ?>-->
														<!--    <a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="btn-product btn-cart"-->
														<!--        title="Select Options"><i class="w-icon-cart"></i>Select Options</a>-->
														<!--    <? } else { ?>-->
														<!--    <a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="btn-product btn-cart"-->
														<!--        title="Add to Cart"><i class="w-icon-cart"></i>Add to Cart</a>-->
														<!--    <?php } ?>-->
														<!--<a href="#" class="btn-product-icon btn-wishlist w-icon-heart"-->
														<!--    title="Add to wishlist"></a>-->
														<!--<a href="#" class="btn-product-icon btn-compare w-icon-compare"-->
														<!--    title="Compare"></a>-->
														<!--</div>-->
													</div>
												</div>
											</div>
										</div>


									<?php } ?>


								</div>
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
										<!--<li class="page-item ">-->
										<!--    <a class="page-link" href="#">1</a>-->
										<!--</li>-->
										<!--<li class="page-item">-->
										<!--    <a class="page-link" href="#">2</a>-->
										<!--</li>-->
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
							<!-- End of Shop Main Content -->
						</div>
						<!-- End of Shop Content -->
					</div>
			</div>
			<!-- End of Page Content -->
</main>

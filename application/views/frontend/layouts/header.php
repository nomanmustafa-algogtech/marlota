
<?php
defined('BASEPATH') or exit('No direct script access allowed');
if (!isset($_COOKIE["hideNewsletterPopup"])) {
    setcookie("hideNewsletterPopup", "true", time() + (86400 * 30000), "/");
}
if (!isset($_COOKIE["session_id"])) {
    $session_id = $this->Base_model->randomString(64);
    setcookie("session_id", $session_id, time() + (86400 * 3000), "/");
    $_COOKIE["session_id"] = $session_id;
}
$settingsd = $this->db->select("*")->from('app_settings')->get()->result_array();
foreach ($settingsd as $row) {
    $settings[$row['name']] = $row['value'];
}
if ($this->session->userdata('user_loggedin')) {
    $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array();
}
$controller = $this->uri->segment(1);
$function  = $this->uri->segment(2);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />

	<meta name="title" content="<?php echo $this->title; ?>">
    <meta property="og:title" content="<?php echo $this->title; ?>" />
    <meta name="description" content="Martola Ltd: UK's best online wholesale & dropshipping store with 10+ Thousand products at resounding discounts.">


    <meta name="keywords" content="Martola, Martola.co.uk, dropshipping in uk, ecommerce in uk, pakistan, uk websites, iphones, samsung, mobiles, computers, laptops, free delivery, computer accessories, mobile accessories, cosmetic, stationaries, dry fruits, baby toys, etc">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Martola.co.uk">
    <meta http-equiv="content-language" content="en">
	<meta name="csrf-token-name" content="<?= $this->security->get_csrf_token_name(); ?>">
	<meta name="csrf-token" content="<?= $this->security->get_csrf_hash(); ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="<?=base_url();?>weblibrary/images/homepage-one/icon.png" />

        <!--title  -->
        <title><?php echo $this->title;  ?></title>
       <?php
			foreach ($css as $_css){
				?>
				<link href="<?php echo $_css ?>" rel="stylesheet">
				<?php
			}
			if(!empty($view_css)){
				foreach ($view_css as $_view_css){
						?>

				<link href="<?php echo $_view_css ?>" rel="stylesheet">
				<?php
				}
			}
		?>
		  <script src="https://www.paypal.com/sdk/js?client-id=AaRV8Iy5gFgolnsgwdFavMobrNBWK8SJVHEpeN204MjBqGgiib3f_uDUG-hD5rCc6skSUpvIC_5Zoikb&currency=GBP&disable-funding=credit,card"></script>
    		<script src="https://unpkg.com/imask"></script>
		<style>
			.cart-counter{
				position: absolute;
				right: -7px;
				top: -11px;
				background: #bc8c59;
				color: #000000;
				border-radius: 11px;
				width: 18px;
				text-align: center;
				font-size: 12px;
			}
			.header-search-btn form {
				display: flex;
				align-items: center;
				max-width: 400px; /* optional */
			}

			.header-input {
				flex: 1;
				padding: 10px;
				border: 1px solid #ddd;
				border-right: none;
				font-size: 14px;
				outline: none;
			}
		</style>

    </head>

    <body class="body-two">
        <!--------------- header-section --------------->
        <header id="header" class="header header-two">
            <div class="header-center-section d-none d-lg-block">
                <div class="container">
                    <div class="header-center">
                        <div class="logo">
                            <a href="<?= base_url(); ?>">
                                <img width="120" src="<?php echo base_url(); ?>uploads/settings/<?php echo $this->settings['site_logo']; ?>" alt="<?php echo $settings['site_title']; ?>" />
                            </a>
                        </div>

                        <div class="header-search-btn">
							<form action="<?= base_url(); ?>products/" method="get">
								<input class="header-input" type="text" name="search" 
									value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" 
									placeholder="Search" required />
								<button type="submit" class="shop-btn"><span>Search</span></button>
							</form>
						</div>

                        <div class="header-cart-items">
              			<?php
                        // Initialize cart variables
						$items = [];
						$subtotal = 0;

						// Detect if user is logged in
						$isLoggedIn = $this->session->userdata('user_loggedin') ? true : false;

						// ----------------------------
						// 1. Logged-in user cart
						// ----------------------------
						if ($isLoggedIn) {

							$user_id = (int) $this->session->userdata('user_id');

							$this->db->reset_query(); // Reset Query Builder

							$items = $this->db
								->select('c.id AS cart_id, c.product_id, c.qty, c.price, p.name, p.slug, p.thumbnail_img')
								->from('app_cart c')
								->join('app_products p', 'p.id = c.product_id', 'left')
								->where('c.user_id', $user_id)
								->get()
								->result_array();

						// ----------------------------
						// 2. Guest user cart (session-based)
						// ----------------------------
						} else {

							$guest_cart = $this->session->userdata('guest_cart') ?? [];

							if (!empty($guest_cart)) {

								$product_ids = array_column($guest_cart, 'product_id');

								$this->db->reset_query(); // Reset Query Builder

								$products = $this->db
									->select('id, name, slug, thumbnail_img')
									->from('app_products')
									->where_in('app_products.id', $product_ids) // IMPORTANT: avoid ambiguity
									->get()
									->result_array();

								// Re-index products by ID
								$products = array_column($products, null, 'id');

								foreach ($guest_cart as $key => $row) {
									if (isset($products[$row['product_id']])) {
										$items[] = array_merge(
											$row,
											$products[$row['product_id']],
											['row_key' => $key] // Needed for delete/update
										);
									}
								}
							}
						}

						// ----------------------------
						// 3. Calculate subtotal
						// ----------------------------
						$subtotal = 0;
						foreach ($items as $item) {
							$subtotal += $item['qty'] * $item['price'];
						}

						$cart_count = count($items);
                        ?>
                        <div class="header-user">
								<?php if ($this->session->userdata('user_loggedin')) { ?>
                                <a title="User/Account" href="<?php echo base_url()."user/account" ?>">
									<span>User/Account</span>
                                    <span> 
                                        <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M20.66 19.729C20.5683 18.043 20.106 16.4886 19.2849 15.1176C18.2726 13.4237 16.8776 12.1244 15.1359 11.2475C14.7453 11.0522 14.546 10.9645 14.0558 10.7772L13.6014 10.6138L14.1634 10.1833C15.2156 9.38621 16.0087 8.08689 16.2798 6.70387C16.3635 6.28936 16.3714 5.22918 16.2997 4.78278C16.1323 3.77043 15.6261 2.70227 14.9446 1.92507C14.1036 0.976485 12.9119 0.30291 11.6763 0.079713C11.4651 0.0398565 10.8194 0 10.4209 0C10.2734 0 10.2216 0.00398565 10.2056 0.0079713H10.2016C10.1658 0.011957 10.094 0.0239139 10.0064 0.0358709H9.99439C9.92265 0.0438422 9.84692 0.0557991 9.7712 0.0677561C8.83457 0.195297 7.6867 0.73336 6.92146 1.41092C5.94099 2.27581 5.25944 3.50339 5.0482 4.78278C4.97247 5.22918 4.98443 6.28936 5.06813 6.70387C5.33915 8.08689 6.1323 9.38621 7.18451 10.1833L7.74649 10.6138L7.29212 10.7772C6.80189 10.9645 6.6026 11.0522 6.21201 11.2475C4.47028 12.1244 3.07132 13.4237 2.06295 15.1176C1.23792 16.4926 0.775581 18.043 0.683911 19.729L0.667969 20H0.92305H1.86366H19.4802H20.1618H20.6759L20.66 19.729ZM6.23194 4.98605C6.40731 3.92188 6.95334 2.95735 7.77439 2.25986C8.58746 1.57035 9.61576 1.19171 10.668 1.19171C10.9031 1.19171 11.1423 1.21164 11.3774 1.24751C13.8286 1.64607 15.5065 3.95775 15.112 6.39299C14.9366 7.45715 14.3906 8.42168 13.5695 9.11917C12.7565 9.80869 11.7282 10.1873 10.6759 10.1873C10.4408 10.1873 10.2016 10.1674 9.96649 10.1315C7.51532 9.72898 5.83736 7.42128 6.23194 4.98605ZM3.21081 15.5281C4.39854 13.7146 5.98084 12.4751 7.92185 11.8414C8.83855 11.5424 9.76323 11.391 10.672 11.391C11.5807 11.391 12.5054 11.5424 13.4221 11.8414C15.3631 12.4751 16.9494 13.7146 18.1331 15.5281C18.715 16.4169 19.1813 17.6963 19.3766 18.8721H1.96729C2.16259 17.6963 2.62891 16.4169 3.21081 15.5281Z"
                                                fill="black"
                                            />
                                        </svg>
                                    </span>
                                </a>
								<?php } else { ?>
									<a title="Login" href="<?php echo base_url()."user/login" ?>">
										<span>
											<svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
												<path
													d="M20.66 19.729C20.5683 18.043 20.106 16.4886 19.2849 15.1176C18.2726 13.4237 16.8776 12.1244 15.1359 11.2475C14.7453 11.0522 14.546 10.9645 14.0558 10.7772L13.6014 10.6138L14.1634 10.1833C15.2156 9.38621 16.0087 8.08689 16.2798 6.70387C16.3635 6.28936 16.3714 5.22918 16.2997 4.78278C16.1323 3.77043 15.6261 2.70227 14.9446 1.92507C14.1036 0.976485 12.9119 0.30291 11.6763 0.079713C11.4651 0.0398565 10.8194 0 10.4209 0C10.2734 0 10.2216 0.00398565 10.2056 0.0079713H10.2016C10.1658 0.011957 10.094 0.0239139 10.0064 0.0358709H9.99439C9.92265 0.0438422 9.84692 0.0557991 9.7712 0.0677561C8.83457 0.195297 7.6867 0.73336 6.92146 1.41092C5.94099 2.27581 5.25944 3.50339 5.0482 4.78278C4.97247 5.22918 4.98443 6.28936 5.06813 6.70387C5.33915 8.08689 6.1323 9.38621 7.18451 10.1833L7.74649 10.6138L7.29212 10.7772C6.80189 10.9645 6.6026 11.0522 6.21201 11.2475C4.47028 12.1244 3.07132 13.4237 2.06295 15.1176C1.23792 16.4926 0.775581 18.043 0.683911 19.729L0.667969 20H0.92305H1.86366H19.4802H20.1618H20.6759L20.66 19.729ZM6.23194 4.98605C6.40731 3.92188 6.95334 2.95735 7.77439 2.25986C8.58746 1.57035 9.61576 1.19171 10.668 1.19171C10.9031 1.19171 11.1423 1.21164 11.3774 1.24751C13.8286 1.64607 15.5065 3.95775 15.112 6.39299C14.9366 7.45715 14.3906 8.42168 13.5695 9.11917C12.7565 9.80869 11.7282 10.1873 10.6759 10.1873C10.4408 10.1873 10.2016 10.1674 9.96649 10.1315C7.51532 9.72898 5.83736 7.42128 6.23194 4.98605ZM3.21081 15.5281C4.39854 13.7146 5.98084 12.4751 7.92185 11.8414C8.83855 11.5424 9.76323 11.391 10.672 11.391C11.5807 11.391 12.5054 11.5424 13.4221 11.8414C15.3631 12.4751 16.9494 13.7146 18.1331 15.5281C18.715 16.4169 19.1813 17.6963 19.3766 18.8721H1.96729C2.16259 17.6963 2.62891 16.4169 3.21081 15.5281Z"
													fill="black"
												/>
											</svg>
										</span>
									</a>

								<?php } ?>
                            </div>
                            <div class="header-cart">
                                <a href="<?= base_url('cart'); ?>" class="cart-item">
                                    <span>
										<?php if ($cart_count > 0) { ?>
											<p class="cart-counter"><?= $cart_count; ?></p>
										<?php } ?>
                                        <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M16.8248 8.1772C16.6964 7.84626 16.4023 7.81766 14.9567 7.81766H13.7555V7.2947C13.7555 6.48165 13.6395 5.91374 13.3579 5.32949C12.8484 4.2713 11.9951 3.5318 10.8892 3.1886C10.3508 3.02517 9.5472 2.95572 9.05844 3.02926C7.70399 3.24172 6.54836 4.09562 5.96019 5.31315C5.67439 5.90966 5.55842 6.48165 5.55842 7.2947V7.82175H4.35308C2.90751 7.82175 2.61343 7.85035 2.48502 8.19354C2.41875 8.41008 1.79744 13.0637 1.53235 15.0697C1.3004 16.8184 1.08501 18.469 0.927617 19.711C0.654242 21.8519 0.662526 21.8846 0.67081 21.9214V21.9255C0.708089 22.0644 1.07673 22.428 1.18857 22.5342L1.67318 23H17.6117L17.9721 22.6854C18.1336 22.5424 18.668 22.0562 18.668 21.8152C18.668 21.6517 16.8579 8.27117 16.8248 8.1772ZM17.3591 21.5046C17.3549 21.5332 17.3218 21.619 17.2638 21.6803L17.181 21.7702H2.13295L1.91756 21.5414L2.76668 15.2863C3.06491 13.0596 3.33 11.1189 3.4874 9.95855C3.55781 9.45193 3.59095 9.19453 3.60752 9.06788C4.16669 9.06379 6.61049 9.0597 9.65075 9.0597H15.6981L15.7064 9.10465C15.7727 9.4315 17.3301 21.141 17.3591 21.5046ZM6.80517 7.82175V7.35598C6.80517 7.04139 6.84659 6.6083 6.89215 6.40811C7.13653 5.38669 7.96908 4.5573 9.00873 4.29173C9.44365 4.1855 10.1561 4.22228 10.591 4.37753H10.5951C11.0508 4.5287 11.4235 4.77384 11.7673 5.14972C12.3224 5.74623 12.5088 6.28145 12.5088 7.27018V7.82175H6.80517Z"
                                                fill="black"
                                            />
                                        </svg>
										
                                    </span>
                                </a>
								<?php if (!empty($items)) { ?>
								<div class="cart-submenu">
									<div class="cart-wrapper-item">
										<?php foreach ($items as $item): 
											$line_total = $item['price'] * $item['qty'];
											$words = explode(' ', $item['name']);
											$shortName = implode(' ', array_slice($words, 0, 5));
											$productName = $shortName . (count($words) > 5 ? '...' : '');
										?>
										<div class="wrapper">
											<div class="wrapper-item">
												<div class="wrapper-img">
													<img src="<?= base_url('uploads/products/'.$item['thumbnail_img']); ?>" alt="<?= $item['name']; ?>">
												</div>
												<div class="wrapper-content">
													<a href="<?= base_url('products/view/'.$item['slug']); ?>">
														<h5 class="wrapper-title"><?= $productName; ?></h5>
													</a>
													<p class="new-price">£<?= number_format($line_total, 2); ?></p>
												</div>
											</div>
											<span class="close-btn">
												<?php if ($isLoggedIn) { ?>
													<a href="<?= base_url('cart/deleteCart/'.$item['cart_id']); ?>">✕</a>
												<?php } else { ?>
													<a href="<?= base_url('cart/deleteGuestItem/'.$item['row_key']); ?>">✕</a>
												<?php } ?>
											</span>
										</div>
										<?php endforeach; ?>
									</div>
									<div class="cart-wrapper-section">
										<div class="wrapper-subtotal">
											<h5>Subtotal</h5>
											<h5>£<?= number_format($subtotal, 2); ?></h5>
										</div>
										<div class="cart-btn">
											<a href="<?= base_url('cart'); ?>" class="shop-btn view-btn">View Cart</a>
											<a href="<?= base_url('checkout'); ?>" class="shop-btn checkout-btn">Checkout</a>
										</div>
									</div>
								</div>
								<?php } ?>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

            <nav class="mobile-menu mobile-menu-two d-block d-lg-none">
                <div class="mobile-menu-header d-flex justify-content-between align-items-center">
                    <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                        <span>
                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="14" height="1" fill="#1D1D1D" />
                                <rect y="8" width="14" height="1" fill="#1D1D1D" />
                                <rect y="4" width="10" height="1" fill="#1D1D1D" />
                            </svg>
                        </span>
                    </button>
                    <a href="<?=base_url();?>" class="mobile-header-logo">
                        <img width="100" src="<?php echo base_url(); ?>uploads/settings/<?php echo $this->settings['site_logo']; ?>" alt="logo" />
                    </a>
                    <a href="<?= base_url('cart'); ?>" class="header-cart cart-item">
                        <span>
                            <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16.8248 8.1772C16.6964 7.84626 16.4023 7.81766 14.9567 7.81766H13.7555V7.2947C13.7555 6.48165 13.6395 5.91374 13.3579 5.32949C12.8484 4.2713 11.9951 3.5318 10.8892 3.1886C10.3508 3.02517 9.5472 2.95572 9.05844 3.02926C7.70399 3.24172 6.54836 4.09562 5.96019 5.31315C5.67439 5.90966 5.55842 6.48165 5.55842 7.2947V7.82175H4.35308C2.90751 7.82175 2.61343 7.85035 2.48502 8.19354C2.41875 8.41008 1.79744 13.0637 1.53235 15.0697C1.3004 16.8184 1.08501 18.469 0.927617 19.711C0.654242 21.8519 0.662526 21.8846 0.67081 21.9214V21.9255C0.708089 22.0644 1.07673 22.428 1.18857 22.5342L1.67318 23H17.6117L17.9721 22.6854C18.1336 22.5424 18.668 22.0562 18.668 21.8152C18.668 21.6517 16.8579 8.27117 16.8248 8.1772ZM17.3591 21.5046C17.3549 21.5332 17.3218 21.619 17.2638 21.6803L17.181 21.7702H2.13295L1.91756 21.5414L2.76668 15.2863C3.06491 13.0596 3.33 11.1189 3.4874 9.95855C3.55781 9.45193 3.59095 9.19453 3.60752 9.06788C4.16669 9.06379 6.61049 9.0597 9.65075 9.0597H15.6981L15.7064 9.10465C15.7727 9.4315 17.3301 21.141 17.3591 21.5046ZM6.80517 7.82175V7.35598C6.80517 7.04139 6.84659 6.6083 6.89215 6.40811C7.13653 5.38669 7.96908 4.5573 9.00873 4.29173C9.44365 4.1855 10.1561 4.22228 10.591 4.37753H10.5951C11.0508 4.5287 11.4235 4.77384 11.7673 5.14972C12.3224 5.74623 12.5088 6.28145 12.5088 7.27018V7.82175H6.80517Z"
                                    fill="black"
                                />
                                <circle cx="17.668" cy="7" r="7" fill="#bc8c59" />
                                <path
                                    d="M17.6716 10.1087C17.1666 10.1065 16.7351 9.97337 16.3772 9.70916C16.0192 9.44496 15.7454 9.06037 15.5558 8.5554C15.3662 8.05043 15.2714 7.44212 15.2714 6.73047C15.2714 6.02095 15.3662 5.41477 15.5558 4.91193C15.7476 4.40909 16.0224 4.02557 16.3804 3.76136C16.7405 3.49716 17.1709 3.36506 17.6716 3.36506C18.1723 3.36506 18.6016 3.49822 18.9596 3.76456C19.3175 4.02876 19.5913 4.41229 19.7809 4.91513C19.9727 5.41584 20.0686 6.02095 20.0686 6.73047C20.0686 7.44425 19.9738 8.05362 19.7841 8.55859C19.5945 9.06143 19.3207 9.44602 18.9628 9.71236C18.6048 9.97656 18.1744 10.1087 17.6716 10.1087ZM17.6716 9.25533C18.1147 9.25533 18.461 9.03906 18.7103 8.60653C18.9617 8.17401 19.0874 7.54865 19.0874 6.73047C19.0874 6.18714 19.0299 5.72798 18.9148 5.35298C18.8019 4.97585 18.6389 4.69034 18.4258 4.49645C18.2149 4.30043 17.9635 4.20241 17.6716 4.20241C17.2305 4.20241 16.8843 4.41974 16.6329 4.8544C16.3814 5.28906 16.2547 5.91442 16.2525 6.73047C16.2525 7.27592 16.309 7.73722 16.4219 8.11435C16.537 8.48935 16.7 8.77379 16.9109 8.96768C17.1218 9.15945 17.3754 9.25533 17.6716 9.25533Z"
                                    fill="white"
                                />
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
                    <div class="offcanvas-body">
                        <div class="header-top">
                            <div class="header-cart">
                        
                            </div>
                            <div class="shop-btn">
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                        </div>
                        <div class="header-input">
							<form action="<?= base_url(); ?>products/" method="get">
								<input class="header-input" type="text" name="search" 
									value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" 
									placeholder="Search" required />
								<button type="submit" class="shop-btn"><span>Search</span></button>
							</form>

                            <!-- <input type="text" placeholder="Search...." />
                            <span>
                                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.9708 16.4151C12.5227 17.4021 10.9758 17.9723 9.27353 18.0062C5.58462 18.0802 2.75802 16.483 1.05056 13.1945C-1.76315 7.77253 1.33485 1.37571 7.25086 0.167548C12.2281 -0.848249 17.2053 2.87895 17.7198 7.98579C17.9182 9.95558 17.5566 11.7939 16.5852 13.5061C16.4512 13.742 16.483 13.8725 16.6651 14.0553C18.2412 15.6386 19.8112 17.2272 21.3735 18.8244C22.1826 19.6513 22.2058 20.7559 21.456 21.4932C20.7697 22.1678 19.7047 22.1747 18.9764 21.4793C18.3623 20.8917 17.7774 20.2737 17.1796 19.6688C16.118 18.5929 15.0564 17.5153 13.9708 16.4151ZM2.89545 9.0364C2.91692 12.4172 5.59664 15.1164 8.91967 15.1042C12.2384 15.092 14.9138 12.3493 14.8889 8.98505C14.864 5.63213 12.1826 2.92508 8.89047 2.92857C5.58204 2.93118 2.87397 5.68958 2.89545 9.0364Z"
                                        fill="black"
                                    ></path>
                                </svg>
                            </span> -->
                        </div>

                        <div class="category-dropdown">
                            <ul class="category-list">
								<?php
								$cat0 = $this->db->query("SELECT * FROM app_categories WHERE level=0 ")->result_array();

								foreach ($cat0 as $row0) {
									// Check if there are products in this category
									$products_count = $this->db->query("SELECT COUNT(*) as count FROM app_products WHERE category_id IN (SELECT id FROM app_categories WHERE id = '{$row0['id']}' OR parent_id = '{$row0['id']}')")->row()->count;
									if (count($cat0) > 0) { // Display category only if it has products
								?>
                                <li class="category-list-item">
                                    <a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>">
                                        <div class="dropdown-item d-flex justify-content-between align-items-center">
                                            <div class="dropdown-list-item d-flex">
                                                <span class="dropdown-text"> <?= $row0['name']; ?> </span>
                                            </div>
                                            <div class="drop-down-list-icon">
                                                <span>
                                                    <svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect x="1.5" y="0.818359" width="5.78538" height="1.28564" transform="rotate(45 1.5 0.818359)" />
                                                        <rect x="5.58984" y="4.90918" width="5.78538" height="1.28564" transform="rotate(135 5.58984 4.90918)" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
								<?php } } ?>
                               
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="header-bottom d-lg-block d-none">
                <div class="container">
                    <div class="header-nav">
                        <div class="header-category-menu">
                            <div class="category-menu-section position-relative">
                                <div class="empty position-fixed" onclick="tooglmenu()"></div>
                                <button class="dropdown-btn" onclick="tooglmenu()">
                                    <div class="dropdown-btn-icon">
                                        <span class="dropdown-icon">
                                            <svg width="14" height="9" viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect width="14" height="1" fill="#1D1D1D" />
                                                <rect y="8" width="14" height="1" fill="#1D1D1D" />
                                                <rect y="4" width="10" height="1" fill="#1D1D1D" />
                                            </svg>
                                        </span>
                                        <span class="list-text"> All Categories </span>
                                    </div>
                                    <span>
                                        <svg width="9" height="5" viewBox="0 0 9 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect x="8.18359" y="0.910156" width="5.78538" height="1.28564" transform="rotate(135 8.18359 0.910156)" fill="#1D1D1D"></rect>
                                            <rect x="4.08984" y="5" width="5.78538" height="1.28564" transform="rotate(-135 4.08984 5)" fill="#1D1D1D"></rect>
                                        </svg>
                                    </span>
                                </button>
                                <div class="category-dropdown position-absolute" id="subMenu">
                                    <ul class="category-list">

									    <?php
										$cat0 = $this->db->query("SELECT * FROM app_categories WHERE level=0 ")->result_array();

										foreach ($cat0 as $row0) {
											// Check if there are products in this category
											$products_count = $this->db->query("SELECT COUNT(*) as count FROM app_products WHERE category_id IN (SELECT id FROM app_categories WHERE id = '{$row0['id']}' OR parent_id = '{$row0['id']}')")->row()->count;
											if (count($cat0) > 0) { // Display category only if it has products
										?>
											<li class="category-list-item">
												<a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>">
													<div class="dropdown-item">
														<div class="dropdown-list-item">
															<span class="dropdown-text"> <?= $row0['name']; ?> </span>
														</div>
														<div class="drop-down-list-icon">
															<span>
																<svg width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
																	<rect x="1.5" y="0.818359" width="5.78538" height="1.28564" transform="rotate(45 1.5 0.818359)" fill="#1D1D1D" />
																	<rect x="5.58984" y="4.90918" width="5.78538" height="1.28564" transform="rotate(135 5.58984 4.90918)" fill="#1D1D1D" />
																</svg>
															</span>
														</div>
													</div>
												</a>
											</li>
										<?php } ?>
										<?php } ?>
                                   
                                    </ul>
                                </div>
                            </div>
                            <div class="header-nav-menu">
                                <ul class="menu-list">
                                    <li>
                                        <a href="<?= base_url(); ?>">
                                            <span class="list-text">Home</span>
                                        </a>
                                    </li>
                                 
                                    <li>
                                        <a href="<?php echo base_url()."web/about" ?>">
                                            <span class="list-text">About</span>
                                        </a>
                                    </li>
									<li>
										<a href="<?= base_url("products/"); ?>">
											<span class="list-text" style="color:red; font-weight:bold;">SALE</span>
										</a>
									</li>
  
                                    <li>
                                        <a href="<?php echo base_url()."web/contact" ?>">
                                            <span class="list-text">Contact</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--------------- header-section-end --------------->

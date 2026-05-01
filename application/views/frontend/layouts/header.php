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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title><?php echo $this->title;  ?></title>

    <meta name="title" content="<?php echo $this->title; ?>">
    <meta property="og:title" content="<?php echo $this->title; ?>" />
    <meta name="description" content="Marlota Limited: UK's trusted source for premium packaging, labels, and office essentials.">

    <meta name="keywords" content="marlota, marlota.co.uk, packaging uk, labels uk, office supplies uk, ecommerce packaging, coffee cups, food containers, a4 paper">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Marlota Limited">
    <meta http-equiv="content-language" content="en">
    <meta name="yandex-verification" content="a34af17d7460b942" />
    <meta name="p:domain_verify" content="514da1df306e614aeff379d9ded71a24" />

    <meta property="og:type" content="Ecommerce Website" />
    <meta property="og:url" content="<?= base_url(); ?>" />
    <meta property="og:image" content="<?= base_url(); ?>uploads/product-img-banner.jpeg" />
    <meta property="og:description" content="Marlota Limited: Premium packaging, labels, and office essentials delivered fast across the UK." />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>uploads/settings/<?= $settings['site_icon']; ?>">

    <style>
        .sidebarmenu {
            height: 120vh;
            width: 0;
            position: absolute;
            z-index: 1000;
            top: 0;
            left: 0;
            background-color: #2D1B69;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebarmenu a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 16px;
            color: rgba(255,255,255,.75);
            display: block;
            transition: 0.3s;
        }

        .sidebarmenu a:hover {
            color: #D4A017;
        }

        .closebtn {
            color: #FFFFFF !important;
            cursor: pointer;
            position: absolute;
            top: 0;
            right: 5px;
            font-size: 36px;
            margin-left: 50px;
        }

        .customcart {
            position: absolute;
            background-color: transparent;
            color: #2D1B69;
            right: -17px;
            top: 7px;
            font-weight: 600;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            font-style: normal;
            z-index: 1;
            font-family: Poppins, sans-serif;
            font-size: 18px;
            line-height: 29px;
            text-align: center;
        }

        @media (max-width: 576px) {
            .customcart {
                right: -14px !important;
            }
        }

        #main {
            transition: margin-left .5s;
        }

        @media screen and (max-height: 450px) {
            .sidebarmenu a {
                font-size: 18px;
            }
        }
    </style>

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: {
                families: ['Poppins:400,500,600,700,800']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '<?= base_url(); ?>webfiles/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <link rel="preload" href="<?= base_url(); ?>webfiles/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url(); ?>webfiles/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url(); ?>webfiles/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= base_url(); ?>webfiles/fonts/wolmart87d5.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <?php $this->load->view('frontend/layouts/layouts.css.php'); ?>

    <script src="https://www.paypal.com/sdk/js?client-id=AaRV8Iy5gFgolnsgwdFavMobrNBWK8SJVHEpeN204MjBqGgiib3f_uDUG-hD5rCc6skSUpvIC_5Zoikb&currency=GBP&disable-funding=credit,card"></script>
    <script src="https://unpkg.com/imask"></script>
</head>

<body class="<?php if (uri_string() == 'user/account' || uri_string() == 'user/referrals' || uri_string() == 'user/orders' || uri_string() == 'user/orderstemp') {
                    echo 'my-account';
                } else {
                    echo 'home';
                } ?>">
    <style>
        .product-desc p {
            margin: 0px;
        }

        .preloader {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 99999999;
            opacity: 0.6;
        }

        #preloader-logo {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

        .spinner {
            width: 80px;
            height: 80px;
            border: 2px solid #f3f3f3;
            border-top: 3px solid #2D1B69;
            border-radius: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            animation: spin 1s infinite ease;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to   { transform: rotate(360deg); }
        }

        .submenu li:hover {
            color: #000;
            background: #ccc;
        }

        #category option {
            color: #000;
        }

        ::placeholder {
            color: black;
            opacity: 0.4;
        }
    </style>
    <div class="preloader" style="display:none;">
        <div class="spinner"></div>
    </div>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header marlota-header">
            <!-- White Navbar -->
            <nav class="navbar navbar-expand-lg" style="background:#fff; border-bottom:1px solid #eee; padding:12px 0;">
                <div class="container d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <a href="<?= base_url(); ?>" class="logo text-decoration-none">
                        <img src="<?= base_url(); ?>uploads/settings/<?=$this->settings['site_logo'];?>"
                             alt="<?= $settings['site_title']; ?>"
                             style="height:50px; width:auto;" />
                    </a>

                    <!-- Desktop Nav Links -->
                    <ul class="navbar-nav d-none d-lg-flex flex-row align-items-center gap-4 mb-0">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" class="nav-link fw-500" style="color:#1a1a2e;">Home</a>
                        </li>
                        <li class="nav-item has-megamenu">
                            <a href="<?= base_url('products'); ?>" class="nav-link fw-500 megamenu-trigger" style="color:#1a1a2e;">
                                Products <i class="fa fa-chevron-down" style="font-size:11px;margin-left:3px;"></i>
                            </a>
                            <!-- MEGA MENU PANEL -->
                            <div class="megamenu-panel">
                                <div class="megamenu-inner">
                                    <?php
                                    $mega_cats = $this->db->query("SELECT * FROM app_categories WHERE level=0 ORDER BY name ASC")->result_array();
                                    foreach ($mega_cats as $mcat) {
                                        $mega_subs = $this->db->query("SELECT * FROM app_categories WHERE level=1 AND parent_id='{$mcat['id']}' ORDER BY name ASC")->result_array();
                                    ?>
                                    <div class="megamenu-col">
                                        <a href="<?= base_url(); ?>products/?category=<?= $mcat['slug']; ?>" class="megamenu-cat-title"><?= $mcat['name']; ?></a>
                                        <ul class="megamenu-sublist">
                                            <?php foreach ($mega_subs as $msub) { ?>
                                            <li><a href="<?= base_url(); ?>products/?category=<?= $msub['slug']; ?>"><?= $msub['name']; ?></a></li>
                                            <?php } ?>
                                            <li class="megamenu-see-all"><a href="<?= base_url(); ?>products/?category=<?= $mcat['slug']; ?>">See All <?= $mcat['name']; ?></a></li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('about'); ?>" class="nav-link fw-500" style="color:#1a1a2e;">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('contact'); ?>" class="nav-link fw-500" style="color:#1a1a2e;">Contact Us</a>
                        </li>
                        <!-- Account -->
                        <?php if ($this->session->userdata('user_loggedin')) { ?>
                            <li class="nav-item">
                                <a href="<?= base_url('user/account'); ?>" class="nav-link fw-500" style="color:#1a1a2e;">
                                    <i class="fa fa-user" style="color:#2D1B69;"></i> My Account
                                </a>
                            </li>
                        <?php } else { if (uri_string() != 'user/register') { ?>
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link fw-500 login sign-in-click" style="color:#1a1a2e;">
                                    <i class="fa fa-user" style="color:#2D1B69;"></i> Sign In
                                </a>
                            </li>
                        <?php } } ?>
                        <!-- Cart -->
                        <?php
                        if ($this->session->userdata('user_loggedin')) {
                            $user_id = $this->session->userdata('user_id');
                            $cart = $this->db->query("SELECT * FROM app_cart where user_id = '$user_id'")->result_array();
                        } else {
                            $session_id = $_COOKIE['session_id'];
                            $cart = $this->db->query("SELECT * FROM app_cart where session_id = '$session_id'")->result_array();
                        }
                        ?>
                        <li class="nav-item">
                            <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-4">
                                <div class="cart-overlay"></div>
                                <a href="#" class="cart-toggle label-down link nav-link" style="color:#1a1a2e; position:relative;">
                                    <i class="fa fa-shopping-cart" style="font-size:18px;"></i>
                                    <span class="customcart"><?= count($cart); ?></span>
                                    <span class="cart-label" style="margin-left:8px;">Cart</span>
                                </a>
                                <div class="dropdown-box">
                                    <div class="cart-header">
                                        <span>Shopping Cart</span>
                                        <a href="#" class="btn-close">Close <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                    <div class="products" style="overflow-y: auto;overflow-x: hidden;">
                                        <?php
                                        $total = 0;
                                        foreach ($cart as $row) {
                                            $total += $row['qty'] * $row['price'];
                                            $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
                                        ?>
                                            <div class="product product-cart">
                                                <div class="product-detail">
                                                    <a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>" class="product-name"><?= $product['name']; ?></a>
                                                    <div class="price-box">
                                                        <span class="product-quantity"><?= $row['qty']; ?></span>
                                                        <span class="product-price">£ <?= $row['price']; ?></span>
                                                    </div>
                                                </div>
                                                <figure class="product-media">
                                                    <a href="<?= base_url(); ?>products/view/<?= $product['slug']; ?>">
                                                        <img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>" alt="<?= $product['name']; ?>" height="84" width="94" />
                                                    </a>
                                                </figure>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="cart-total">
                                        <label>Subtotal:</label>
                                        <span class="price">£ <?= $total; ?></span>
                                    </div>
                                    <div class="cart-action">
                                        <a href="<?= base_url(); ?>cart" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                        <a href="<?= base_url(); ?>checkout" class="btn btn-primary btn-rounded">Checkout</a>
                                    </div>
                                </div>
                                <!-- End of Dropdown Box -->
                            </div>
                        </li>
                        <!-- Shop Now CTA -->
                        <li class="nav-item ms-2">
                            <a href="<?= base_url('products'); ?>" class="btn-shop-now">Shop Now</a>
                        </li>
                    </ul>

                    <!-- Mobile: cart + hamburger -->
                    <div class="d-flex d-lg-none align-items-center gap-3">
                        <!-- Cart icon for mobile -->
                        <div class="dropdown cart-dropdown cart-offcanvas">
                            <div class="cart-overlay"></div>
                            <a href="#" class="cart-toggle link" style="color:#2D1B69; position:relative; font-size:24px;">
                                <i class="fa fa-shopping-cart"></i>
                                <span style="position:absolute;top:-6px;right:-10px;background:#D4A017;color:#fff;border-radius:50%;width:18px;height:18px;font-size:10px;display:flex;align-items:center;justify-content:center;font-weight:700;"><?= count($cart); ?></span>
                            </a>
                        </div>
                        <!-- Categories button -->
                        <button class="navbar-toggler-marlota" onclick="openNav()" title="Browse Categories">
                            &#9776;
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Sidebar Category Menu -->
            <div id="mySidebar" class="sidebarmenu">
                <span class="closebtn" onclick="closeNav()">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
                        <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
                    </svg>
                </span>
                <?php
                $cat0 = $this->db->query("SELECT * FROM app_categories WHERE level=0 ")->result_array();

                foreach ($cat0 as $row0) {
                    $products_count = $this->db->query("SELECT COUNT(*) as count FROM app_products WHERE category_id IN (SELECT id FROM app_categories WHERE id = '{$row0['id']}' OR parent_id = '{$row0['id']}')")->row()->count;
                    if (count($cat0) > 0) {
                ?>
                        <div class="widget widget-collapsible m-2">
                            <h3 class="widget-title collapsed" style="color:#fff; background:rgba(255,255,255,.12); border-radius:5px; padding:10px;">
                                <span><?= $row0['name']; ?></span><span class="toggle-btn"></span>
                            </h3>
                            <?php
                            $cat28 = $this->db->query("SELECT * FROM app_categories WHERE level=1 && parent_id = '{$row0['id']}'")->result_array();
                            if (count($cat28) > 0) { ?>
                                <ul class="widget-body filter-items search-ul" style="display: none;">
                                    <?php foreach ($cat28 as $row1) { ?>
                                        <li style="background:rgba(212,160,23,.15); color:white; border-radius:5px; padding:10px; margin-top:5px;">
                                            <a href="<?= base_url(); ?>products/?category=<?= $row1['slug']; ?>"><?= $row1['name']; ?></a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } else {
                                echo '<ul class="widget-body filter-items search-ul" style="display:none;"><li style="background:rgba(255,255,255,.1);color:white;border-radius:5px;padding:10px;margin-top:5px;">N/A</li></ul>';
                            } ?>
                        </div>
                <?php } ?>
                <?php } ?>
            </div>

            <script>
                function openNav() {
                    document.getElementById("mySidebar").style.width = "320px";
                    document.getElementById("main").style.marginLeft = "320px";
                }

                function closeNav() {
                    document.getElementById("mySidebar").style.width = "0";
                    document.getElementById("main").style.marginLeft = "0";
                }
            </script>

        </header>
        <!-- End of Header -->

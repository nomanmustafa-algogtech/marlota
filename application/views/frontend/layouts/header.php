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
        /* ---- Mobile Sidebar ---- */
        .sidebarmenu {
            height: 100vh;
            width: 0;
            position: fixed;
            z-index: 99999;
            top: 0;
            left: 0;
            background: #3a1b76;
            overflow-x: hidden;
            overflow-y: auto;
            transition: width 0.32s ease;
            box-shadow: 4px 0 24px rgba(0,0,0,0.38);
        }

        /* Overlay backdrop */
        #sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 99998;
        }
        #sidebar-overlay.active { display: block; }

        /* Close button */
        .sb-close-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255,255,255,0.15);
            border: none;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
            padding: 0;
        }
        .sb-close-btn:hover { background: rgba(255,255,255,0.28); }

        /* Logo area */
        .sb-logo {
            padding: 16px 16px 12px;
            border-bottom: 1px solid rgba(255,255,255,0.12);
            margin-bottom: 6px;
        }

        /* Main nav links */
        .sb-nav { padding: 0 8px; }
        .sb-nav-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            color: rgba(255,255,255,0.88) !important;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            text-decoration: none !important;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }
        .sb-nav-link:hover { background: rgba(255,255,255,0.12); color: #C9A646 !important; }
        .sb-nav-link .fa { width: 18px; text-align: center; font-size: 14px; color: #C9A646; }

        /* Cart badge inside nav */
        .sb-cart-badge {
            margin-left: auto;
            background: #C9A646;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        /* Divider */
        .sb-divider {
            height: 1px;
            background: rgba(255,255,255,0.12);
            margin: 6px 8px;
        }

        /* Shop Now button */
        .sb-shop-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 8px;
            padding: 11px 16px;
            background: #C9A646;
            color: #fff !important;
            font-size: 14px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-decoration: none !important;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .sb-shop-btn:hover { background: #a87d2e; color: #fff !important; }
        .sb-shop-btn .fa { font-size: 14px; }

        /* Section label */
        .sb-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            font-family: 'Poppins', sans-serif;
            padding: 8px 20px 4px;
            margin: 0;
        }

        /* Category item */
        .sb-cat-item { border-bottom: 1px solid rgba(255,255,255,0.07); }
        .sb-cat-row {
            display: flex;
            align-items: center;
            padding: 0 8px;
        }
        .sb-cat-link {
            flex: 1;
            padding: 10px 12px;
            color: rgba(255,255,255,0.85) !important;
            font-size: 14px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            text-decoration: none !important;
            transition: color 0.2s;
        }
        .sb-cat-link:hover { color: #C9A646 !important; }

        /* Toggle chevron */
        .sb-toggle-btn {
            background: none;
            border: none;
            color: rgba(255,255,255,0.45);
            font-size: 12px;
            padding: 8px 10px;
            cursor: pointer;
            transition: transform 0.25s, color 0.2s;
            line-height: 1;
        }
        .sb-toggle-btn.open { transform: rotate(180deg); color: #C9A646; }

        /* Subcategory list */
        .sb-sublist {
            display: none;
            list-style: none;
            padding: 2px 8px 8px 24px;
            margin: 0;
        }
        .sb-sublist.open { display: block; }
        .sb-sub-link {
            display: block;
            padding: 7px 10px;
            font-size: 13px;
            color: rgba(255,255,255,0.68) !important;
            font-family: 'Poppins', sans-serif;
            text-decoration: none !important;
            border-radius: 6px;
            transition: background 0.2s, color 0.2s;
        }
        .sb-sub-link:hover { background: rgba(255,255,255,0.1); color: #C9A646 !important; }
        .sb-sub-all { color: #C9A646 !important; font-weight: 600; }

        /* Cart counter on desktop */
        .customcart {
            position: absolute;
            background-color: transparent;
            color: #5A2D82;
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
            .customcart { right: -14px !important; }
        }
        #main { transition: margin-left .5s; }
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
            border-top: 3px solid #5A2D82;
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
            <!-- Top Announcement Bar -->
            <div class="top-announcement-bar">
                <div class="top-announcement-track">
                    <span class="top-announcement-item">🚚 FREE UK DELIVERY ON ALL ORDERS</span>
                    <span class="top-announcement-sep">•</span>
                    <span class="top-announcement-item">⚡ SAME‑DAY DISPATCH BEFORE 4PM</span>
                    <span class="top-announcement-sep">•</span>
                    <span class="top-announcement-item">🏗️ FREE NEXT‑DAY PALLET DELIVERIES</span>
                    <span class="top-announcement-sep">•</span>
                    <span class="top-announcement-item">🚚 FREE UK DELIVERY ON ALL ORDERS</span>
                    <span class="top-announcement-sep">•</span>
                    <span class="top-announcement-item">⚡ SAME‑DAY DISPATCH BEFORE 4PM</span>
                    <span class="top-announcement-sep">•</span>
                    <span class="top-announcement-item">🏗️ FREE NEXT‑DAY PALLET DELIVERIES</span>
                    <span class="top-announcement-sep">•</span>
                </div>
            </div>
            <style>
                .top-announcement-bar {
                    background: #3a1b76;
                    color: #fff;
                    font-family: 'Poppins', sans-serif;
                    font-size: 12px;
                    font-weight: 600;
                    letter-spacing: 0.5px;
                    text-transform: uppercase;
                    overflow: hidden;
                    white-space: nowrap;
                    padding: 8px 0;
                }
                .top-announcement-track {
                    display: inline-block;
                    animation: marquee-scroll 28s linear infinite;
                }
                .top-announcement-item {
                    display: inline-block;
                    padding: 0 24px;
                }
                .top-announcement-sep {
                    display: inline-block;
                    color: #C9A646;
                    font-size: 14px;
                    vertical-align: middle;
                }
                @keyframes marquee-scroll {
                    0%   { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
            </style>
            <!-- White Navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container d-flex align-items-center justify-content-between">
                    <!-- Logo -->
                    <a href="<?= base_url(); ?>" class="logo text-decoration-none">
                        <img src="<?= base_url(); ?>uploads/settings/<?=$this->settings['site_logo'];?>"
                             alt="<?= $settings['site_title']; ?>"
                             class="header-logo-fixed" />
                    </a>

                    <!-- Desktop Nav Links -->
                    <ul class="navbar-nav d-none d-lg-flex flex-row align-items-center gap-4 mb-0">
                        <li class="nav-item">
                            <a href="<?= base_url(); ?>" class="nav-link fw-500">Home</a>
                        </li>
                        <li class="nav-item has-megamenu">
                            <a href="javascript:void(0);" class="nav-link fw-500 megamenu-trigger">
                                Products <i class="fa fa-chevron-down mega-trigger-icon"></i>
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
                            <a href="<?= base_url('web/about'); ?>" class="nav-link fw-500">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('web/contact'); ?>" class="nav-link fw-500">Contact Us</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="<?= base_url('products'); ?>" class="btn-shop-now">Shop Now</a>
                        </li>

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

                        <!-- Right Side Icons: User + Cart -->
                        <li class="nav-item ms-2">
                            <?php if ($this->session->userdata('user_loggedin')) { ?>
                                <a href="<?= base_url('user/account'); ?>" class="nav-link header-icon-link" title="My Account">
                                    <span class="header-icon-wrap">
                                        <i class="fa fa-user header-user-icon"></i>
                                    </span>
                                </a>
                            <?php } else { ?>
                                <a href="<?= base_url('user/login'); ?>" class="nav-link sign-in-click header-icon-link" title="Sign In">
                                    <span class="header-icon-wrap">
                                        <i class="fa fa-user header-user-icon"></i>
                                    </span>
                                </a>
                            <?php } ?>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('cart'); ?>" class="nav-link header-icon-link header-cart-link" title="Cart">
                                <i class="fa fa-shopping-cart header-cart-icon"></i>
                                <span class="customcart"><?= count($cart); ?></span>
                            </a>
                        </li>

                        
                    </ul>

                    <!-- Mobile: cart + hamburger -->
                    <div class="d-flex d-lg-none align-items-center gap-3">
                        <!-- Cart icon for mobile -->
                        <div class="dropdown cart-dropdown cart-offcanvas">
                            <div class="cart-overlay"></div>
                            <a href="#" class="cart-toggle link mobile-cart-link">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="mobile-cart-count"><?= count($cart); ?></span>
                            </a>
                        </div>
                        <!-- Categories button -->
                        <button class="navbar-toggler-marlota" onclick="openNav()" title="Browse Categories">
                            &#9776;
                        </button>
                    </div>
                </div>
            </nav>

            <!-- Overlay backdrop -->
            <div id="sidebar-overlay" onclick="closeNav()"></div>

            <!-- Sidebar Category Menu -->
            <div id="mySidebar" class="sidebarmenu">

                <!-- Close button -->
                <button class="sb-close-btn" onclick="closeNav()" aria-label="Close menu">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="white" width="20" height="20" viewBox="0 0 50 50">
                        <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
                    </svg>
                </button>

                <!-- Logo inside sidebar -->
                <div class="sb-logo">
                    <a href="<?= base_url(); ?>">
                        <img src="<?= base_url(); ?>uploads/settings/<?= $this->settings['site_logo']; ?>" alt="Marlota" style="height:44px;filter:brightness(0) invert(1);">
                    </a>
                </div>

                <!-- Main nav links -->
                <nav class="sb-nav">
                    <a href="<?= base_url(); ?>" class="sb-nav-link">
                        <i class="fa fa-home"></i> Home
                    </a>
                    <a href="<?= base_url('web/about'); ?>" class="sb-nav-link">
                        <i class="fa fa-info-circle"></i> About Us
                    </a>
                    <a href="<?= base_url('web/contact'); ?>" class="sb-nav-link">
                        <i class="fa fa-envelope"></i> Contact Us
                    </a>
                    <?php if ($this->session->userdata('user_loggedin')): ?>
                    <a href="<?= base_url('user/account'); ?>" class="sb-nav-link">
                        <i class="fa fa-user"></i> My Account
                    </a>
                    <?php else: ?>
                    <a href="<?= base_url('user/login'); ?>" class="sb-nav-link">
                        <i class="fa fa-sign-in"></i> Sign In
                    </a>
                    <?php endif; ?>
                    <a href="<?= base_url('cart'); ?>" class="sb-nav-link">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="sb-cart-badge"><?= count($cart); ?></span>
                    </a>
                </nav>

                <div class="sb-divider"></div>

                <!-- Shop Now button -->
                <a href="<?= base_url('products'); ?>" class="sb-shop-btn">
                    <i class="fa fa-tags"></i> Shop All Products
                </a>

                <div class="sb-divider"></div>

                <!-- Categories heading -->
                <p class="sb-section-label">Browse Categories</p>

                <!-- Category list with expandable subcategories -->
                <?php
                $sb_cats = $this->db->query("SELECT * FROM app_categories WHERE level=0 ORDER BY name ASC")->result_array();
                foreach ($sb_cats as $i => $row0):
                    $sb_subs = $this->db->query("SELECT * FROM app_categories WHERE level=1 AND parent_id='{$row0['id']}' ORDER BY name ASC")->result_array();
                ?>
                <div class="sb-cat-item">
                    <!-- Category row: link + toggle if has subs -->
                    <div class="sb-cat-row">
                        <a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>" class="sb-cat-link">
                            <?= $row0['name']; ?>
                        </a>
                        <?php if (!empty($sb_subs)): ?>
                        <button class="sb-toggle-btn" onclick="sbToggle(this)" aria-label="Expand">
                            <i class="fa fa-chevron-down"></i>
                        </button>
                        <?php endif; ?>
                    </div>
                    <?php if (!empty($sb_subs)): ?>
                    <ul class="sb-sublist">
                        <li><a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>" class="sb-sub-link sb-sub-all">All <?= $row0['name']; ?></a></li>
                        <?php foreach ($sb_subs as $row1): ?>
                        <li><a href="<?= base_url(); ?>products/?category=<?= $row1['slug']; ?>" class="sb-sub-link"><?= $row1['name']; ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>

            </div>

            <script>
                function openNav() {
                    var w = Math.min(320, window.innerWidth - 40);
                    document.getElementById("mySidebar").style.width = w + "px";
                    document.getElementById("sidebar-overlay").classList.add("active");
                    document.body.style.overflow = "hidden";
                }

                function closeNav() {
                    document.getElementById("mySidebar").style.width = "0";
                    document.getElementById("sidebar-overlay").classList.remove("active");
                    document.body.style.overflow = "";
                }

                function sbToggle(btn) {
                    var sublist = btn.closest('.sb-cat-item').querySelector('.sb-sublist');
                    var isOpen = sublist.classList.contains('open');
                    // Close all open sublists
                    document.querySelectorAll('.sb-sublist.open').forEach(function(el) { el.classList.remove('open'); });
                    document.querySelectorAll('.sb-toggle-btn.open').forEach(function(el) { el.classList.remove('open'); });
                    // Toggle clicked
                    if (!isOpen) {
                        sublist.classList.add('open');
                        btn.classList.add('open');
                    }
                }

                document.addEventListener('DOMContentLoaded', function () {
                    if (window.innerWidth < 992) return;

                    var header = document.querySelector('.marlota-header');
                    var navbar = document.querySelector('.marlota-header .navbar');
                    var panels = document.querySelectorAll('.megamenu-panel');

                    function positionPanels() {
                        if (!navbar && !header) return;
                        var rect = (header || navbar).getBoundingClientRect();
                        var panelTop = Math.max(0, Math.round(rect.bottom));
                        panels.forEach(function(p) {
                            p.style.top = panelTop + 'px';
                        });
                    }

                    positionPanels();
                    window.addEventListener('scroll', positionPanels);
                    window.addEventListener('resize', positionPanels);

                    var megaItems = document.querySelectorAll('.has-megamenu');
                    megaItems.forEach(function (item) {
                        var closeTimer;

                        function openMenu() {
                            clearTimeout(closeTimer);
                            positionPanels();
                            item.classList.add('menu-open');
                        }

                        function closeMenu() {
                            closeTimer = setTimeout(function () {
                                item.classList.remove('menu-open');
                            }, 160);
                        }

                        item.addEventListener('mouseenter', openMenu);
                        item.addEventListener('mouseleave', closeMenu);
                        item.addEventListener('focusin', openMenu);
                        item.addEventListener('focusout', closeMenu);
                    });
                });
            </script>

        </header>
        <!-- End of Header -->

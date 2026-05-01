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
    <meta name="description" content="Oxijan Ltd: UK's best online wholesale & dropshipping store with 10+ Thousand products at resounding discounts.">


    <meta name="keywords" content="oxijan, oxijan.co.uk, dropshipping in uk, ecommerce in uk, pakistan, uk websites, iphones, samsung, mobiles, computers, laptops, free delivery, computer accessories, mobile accessories, cosmetic, stationaries, dry fruits, baby toys, etc">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Oxijan.co.uk">
    <meta http-equiv="content-language" content="en">
    <meta name="yandex-verification" content="a34af17d7460b942" />
    <meta name="p:domain_verify" content="514da1df306e614aeff379d9ded71a24" />

    <meta property="og:type" content="Ecommerce Website" />
    <meta property="og:url" content="<?= base_url(); ?>" />
    <meta property="og:image" content="<?= base_url(); ?>uploads/product-img-banner.jpeg" />
    <meta property="og:description" content="Oxijan Ltd: UK's best online wholesale & dropshipping store with 10+ Thousand products at resounding discounts." />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url(); ?>uploads/settings/<?= $settings['site_icon']; ?>">

    <style>
        /*body {*/
        /*    font-family: "Lato", sans-serif;*/
        /*}*/

        .sidebarmenu {
            height: 120vh;
            width: 0;
            position: absolute;
            z-index: 1000;
            top: 0;
            left: 0;
            background-color: #095473;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidebarmenu a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 16px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidebarmenu a:hover {
            color: #f1f1f1;
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

        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #3d3d3d;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
        }

        .openbtn:hover {
            background-color: #444;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
        @media screen and (max-height: 450px) {
            /* .sidebarmenu {
                padding-top: 15px;
            } */

            .sidebarmenu a {
                font-size: 18px;
            }

            .customcart {
                right: 50px;
                top: 7px;
            }
          
        }
        @media (max-width: 576px) {
            .header-logo{
                width: 135px !important;
            }
            .customcart {
                right: -14px !important;
            }
            .openbtn {
                font-size: 14px !important;
            }
            .my-account-header{
                display: none !important;
            }
            .login-user-icon{ 
                
                padding-right: 0px !important; 
            }
        }


        .customcart {
            position: absolute;
            background-color: transparent;
            color: white;
            right: -17px;
            top: 7px;
            font-weight: 500;
            width: 1.9rem;
            height: 1.9rem;
            border-radius: 50%;
            font-style: normal;
            z-index: 1;
            font-family: Poppins, sans-serif;
            font-size: 1.1rem;
            line-height: 1.8rem;
            text-align: center;
        }
        .header-logo{
            width: 250px;
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
    <?php $this->load->view('web/includes/layouts.css.php'); ?>

    <!--<script src="https://www.paypal.com/sdk/js?client-id=AbNWYyU7Samt_O1IprFfk_MvUx6jx5h3sHULWClxGaTXEjBUaUa9Beeh8070szC_7uHYw7ob4arRzeC-&currency=GBP&disable-funding=credit,card"></script>-->
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
            border-top: 3px solid #2489CE;
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
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .submenu li:hover {
            color: #000;
            background: #ccc;
        }

        #category option {
            color: #000;
        }

        ::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: black;
            opacity: 0.4;
            /* Firefox */
        }
    </style>
    <div class="preloader" style="display:none;">
        <div class="spinner"></div>

    </div>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header ">
            <style>
                .search-mobile .input-wrapper {
                    display: -webkit-box;
                    display: -ms-flexbox;
                    display: flex;
                    -webkit-box-align: center;
                    -ms-flex-align: center;
                    align-items: center;
                    width: 100%;

                }

                .search-mobile .input-wrapper .form-control::placeholder {
                    /* Chrome, Firefox, Opera, Safari 10.1+ */
                    color: #ffffff5c;
                }

                .search-mobile .input-wrapper .form-control {
                    min-height: 4rem;
                    padding-top: 0.9rem;
                    padding-bottom: 0.8rem;
                    color: #e7a93c;
                    border: 1px solid;
                    border-color: #e7a93c;
                    border-right: 0;
                    background-color: transparent;
                    font-size: 1.2rem;
                    border-radius: 0.3rem 0 0 0.3rem;
                }

                .search-mobile .input-wrapper .btn-search {
                    padding: 0;
                    min-width: 4.8rem;
                    background-color: transparent;
                    color: #e7a93c;
                    font-size: 2rem;
                    -ms-flex-item-align: stretch;
                    -ms-grid-row-align: stretch;
                    align-self: stretch;
                    border: 1px solid #e7a93c;
                    border-left: 0;
                    border-radius: 0 0.3rem 0.3rem 0;
                }



                @media screen and (min-width: 900px) {
                    /*.logo{*/
                    /*    margin-top: -30px;*/
                    /*} */
                }

                @media screen and (max-width: 479px) {
                    .header-middle {
                        padding-top: 1.2rem;
                    }

                    .search-mobile {
                        display: block !important;
                    }

                }

                .header-middle {
                    padding-top: 20px;
                    padding-bottom: 20px;
                }

                .search-mobile {
                    padding-top: 1rem;
                    padding-bottom: 1rem;
                }

                .category-menu .megamenu {
                    min-width: unset;
                    width: 100%;
                }

                .header-middle {
                    background-color: #871919 !important;
                }
				.header-logo {
					width: 160px !important;
				}
            </style>
            <!-- End of Header Top -->



            <div class="header-middle row ">
                <div class="container " style="justify-content:space-between;">
                    <div class="header-leftx mr-md-4">
                        <button class="openbtn" onclick="openNav()">☰ Categories</button>
                    </div>
                    <a href="<?= base_url(); ?>" class="logo ml-lg-0">
                        <img class="header-logo" src="<?= base_url(); ?>uploads/settings/<?=$this->settings['site_logo'];?>" alt="<?= $settings['site_title']; ?>"  />

                    </a>
                    <div class="header-rightx d-flex mt-3">
                        <?php
                        if ($this->session->userdata('user_loggedin')) {
                            $user_id = $this->session->userdata('user_id');
                            $cart = $this->db->query("SELECT * FROM app_cart where user_id = '$user_id'")->result_array();
                        } else {
                            $session_id = $_COOKIE['session_id'];
                            $cart = $this->db->query("SELECT * FROM app_cart where session_id = '$session_id'")->result_array();
                        }
                        ?>
                        <?php if ($this->session->userdata('user_loggedin')) { ?>
                            <h5><a href="<?= base_url('user/account'); ?>" class="login sign-in-click m-4" style="color: white !important;"><b class="my-account-header" style="font-weight: 20px;">My Account &nbsp; </b> <i  style="font-size: 2.6rem; padding-right: 10px;" class="fas fa-user login-user-icon"></i></a></h5>
                            <?php } else {
                            if (uri_string() != 'user/register') { ?>
                                <h5><a href="javascript:void(0)" class="login sign-in-click" style="color: white !important;">
                                    <b style="font-weight: 20px;font-size:larger; display:none">Register or Sign in &nbsp; </b><i style="font-size: 2.6rem; padding-right: 10px;" class="fas fa-user"> </i></a></h5>
                        <?php }
                        } ?>
                        <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-4">

                            <div class="cart-overlay"></div>
                            <a href="#" class="cart-toggle label-down link" style="color: white !important;">
                                <i class="w-icon-cart">

                                </i>
                                <span class="customcart"><?= count($cart); ?></span>
                                <span class="cart-label">Cart</span>
                            </a>
                            <div class="dropdown-box">
                                <div class="cart-header">
                                    <span>Shopping Cart</span>
                                    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
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
                                                    <img src="<?= base_url(); ?>uploads/products/<?= $product['thumbnail_img']; ?>" alt="<?= $product['name']; ?>" height="84"
                                                        width="94" />
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
                                    <a href="<?= base_url(); ?>checkout" class="btn btn-primary  btn-rounded">Checkout</a>
                                </div>
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>





                </div>
            </div>

            <div id="mySidebar" class="sidebarmenu" style="background-color: #bc8c59  !important; justify-content: center; ">
                <span class="closebtn" onclick="closeNav()"><svg xmlns="http://www.w3.org/2000/svg" fill="white" x="0px" y="0px" width="30" height="30" viewBox="0 0 50 50">
                        <path d="M 9.15625 6.3125 L 6.3125 9.15625 L 22.15625 25 L 6.21875 40.96875 L 9.03125 43.78125 L 25 27.84375 L 40.9375 43.78125 L 43.78125 40.9375 L 27.84375 25 L 43.6875 9.15625 L 40.84375 6.3125 L 25 22.15625 Z"></path>
                    </svg></span>
                <?php
                $cat0 = $this->db->query("SELECT * FROM app_categories WHERE level=0 ")->result_array();

                foreach ($cat0 as $row0) {
                    // Check if there are products in this category
                    $products_count = $this->db->query("SELECT COUNT(*) as count FROM app_products WHERE category_id IN (SELECT id FROM app_categories WHERE id = '{$row0['id']}' OR parent_id = '{$row0['id']}')")->row()->count;
                    if (count($cat0) > 0) { // Display category only if it has products
                ?>

                        <div class="widget widget-collapsible m-2">
                            <h3 class="widget-title collapsed" style="color: #fff;background: #3d3d3d; border-radius: 5px;padding: 10px;"><span><?= $row0['name']; ?></span><span class="toggle-btn"></span></h3>

                            <!--<a href="<?= base_url(); ?>products/?category=<?= $row0['slug']; ?>"><?= $row0['name']; ?></a>-->
                            <?php
                            $cat28 = $this->db->query("SELECT * FROM app_categories WHERE level=1 && parent_id = '{$row0['id']}'")->result_array();

                            // $cat28 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '28'")->result_array();
                            if (count($cat28) > 0) { ?>
                                <ul class="widget-body filter-items search-ul" style="display: none;">

                                    <?php foreach ($cat28 as $row1) {
                                    ?>
                                        <li style="background: #871919; color: white; border-radius: 5px; padding: 10px;margin-top: 5px;"><a href="<?= base_url(); ?>products/?category=<?= $row1['slug']; ?>"><?= $row1['name']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            <?php } else {
                                echo '<ul class="widget-body filter-items search-ul" style="display: none;"><li style="background: #00415b; color: white; border-radius: 5px; padding: 10px;margin-top: 5px;">N/A</li></ul>';
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


            <div class="header-middle search-mobile" style="display:none">
                <div class="container">
                    <form action="<?= base_url(); ?>products/" method="get" class="input-wrapper">
                        <input type="text" class="form-control" name="search" autocomplete="off" value="<?php if (isset($_GET['search'])) {
                                                                                                            echo $_GET['search'];
                                                                                                        } ?>" placeholder="Search"
                            required />
                        <button class="btn btn-search" type="submit">
                            <i class="w-icon-search"></i>
                        </button>
                    </form>
                </div>
                <div class="container" style="justify-content: center;margin-top: 10px;">
                    <a href="#" class="mobile-menu-toggle" style="font-size:17px;background: #e7a93c;padding: 10px;border-radius: 5px;color: #00415b;" aria-label="menu-toggle">
                        Browse Categories
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="swiper-wrapper" style="display: flex; align-items: center; background-color: #e5e6e4 !important;" id="swiper-wrapper-103f867d751e7a805" aria-live="polite">
                <div class="col-6 col-md-6 col-lg-3 swiper-slide icon-box icon-box-side text-dark swiper-slide-active" role="group" aria-label="1 / 4" style="justify-center: center; width: 265px;">
                    <span class="icon-box-icon icon-shipping">
                        <i class="w-icon-truck"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title mb-1 ls-normal">Customer Support Assistance</h4>
                        <p class="text-default">Dedicated Customer Support</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 swiper-slide icon-box icon-box-side text-dark swiper-slide-next" role="group" aria-label="2 / 4" style="width: 265px;">
                    <span class="icon-box-icon icon-payment">
                        <i class="w-icon-bag"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title mb-1 ls-normal">Secure Payment</h4>
                        <p class="text-default">We ensure secure payment</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 swiper-slide icon-box icon-box-side text-dark icon-box-money" role="group" aria-label="3 / 4" style="width: 265px;">
                    <span class="icon-box-icon icon-money">
                        <i class="w-icon-money"></i>
                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title mb-1 ls-normal">Money Back Guarantee</h4>
                        <p class="text-default">Money back within 10 days</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-3 swiper-slide icon-box icon-box-side text-dark icon-box-money" role="group" aria-label="4 / 4" style="width: 265px;">
                    <span class="icon-box-icon icon-money">
                        <!-- <img src="webfiles/images/whatsapp-logo-variant.png" alt="Whatsapp Support" style="width:38px" /> -->
                        <img src="<?php echo base_url('webfiles/images/whatsapp-logo-variant.png'); ?>" alt="Whatsapp Support" style="width:38px" />

                    </span>
                    <div class="icon-box-content">
                        <h4 class="icon-box-title mb-1 ls-normal">Customer Support</h4>
                        <p class="text-default">+44 7862 130262</p>
                    </div>
                </div>
            </div>
            </div>
            <!-- End of Header Middle -->
            <style>
                .menu>li>a {
                    font-size: 12px;
                }

                .menu li a {
                    /*padding: 10px 0 10px 0;*/
                    font-size: 12px;
                }
            </style>

        </header>

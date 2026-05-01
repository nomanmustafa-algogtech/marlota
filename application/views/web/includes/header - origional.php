<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_COOKIE["hideNewsletterPopup"])) {
    setcookie("hideNewsletterPopup", "true", time() + (86400 * 30000), "/");
}
if(!isset($_COOKIE["session_id"])) {
    $session_id = $this->Base_model->randomString(64);
    setcookie("session_id", $session_id, time() + (86400 * 3000), "/");
    $_COOKIE["session_id"] = $session_id;
}
$settingsd = $this->db->select("*")->from('app_settings')->get()->result_array();
foreach($settingsd as $row){
    $settings[$row['name']] = $row['value'];
}
if($this->session->userdata('user_loggedin')){
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
    <meta name="p:domain_verify" content="514da1df306e614aeff379d9ded71a24"/>

    <meta property="og:type" content="Ecommerce Website" />
    <meta property="og:url" content="<?=base_url();?>" />
    <meta property="og:image" content="<?=base_url();?>uploads/product-img-banner.jpeg" />
    <meta property="og:description" content="Oxijan Ltd: UK's best online wholesale & dropshipping store with 10+ Thousand products at resounding discounts." />
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?=base_url();?>uploads/settings/<?=$settings['site_icon'];?>">

    

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700,800'] }
        };
        (function (d) {
            var wf = d.createElement('script'), s = d.scripts[0];
            wf.src = '<?=base_url();?>webfiles/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>
    
    <link rel="preload" href="<?=base_url();?>webfiles/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?=base_url();?>webfiles/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?=base_url();?>webfiles/vendor/fontawesome-free/webfonts/fa-brands-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?=base_url();?>webfiles/fonts/wolmart87d5.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php $this->load->view('web/includes/layouts.css.php'); ?>
    
    <!--<script src="https://www.paypal.com/sdk/js?client-id=AbNWYyU7Samt_O1IprFfk_MvUx6jx5h3sHULWClxGaTXEjBUaUa9Beeh8070szC_7uHYw7ob4arRzeC-&currency=GBP&disable-funding=credit,card"></script>-->
    <script src="https://www.paypal.com/sdk/js?client-id=AaRV8Iy5gFgolnsgwdFavMobrNBWK8SJVHEpeN204MjBqGgiib3f_uDUG-hD5rCc6skSUpvIC_5Zoikb&currency=GBP&disable-funding=credit,card"></script>
    <script src="https://unpkg.com/imask"></script>
</head>

<body class="<?php if(uri_string() == 'user/account' || uri_string() =='user/referrals' || uri_string() =='user/orders' || uri_string() =='user/orderstemp') {echo 'my-account'; }else{ echo 'home'; }?>" >
    <style>
        .product-desc p{
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
.submenu li:hover{
    color:#000;
    background:#ccc;
}
#category option{
    color:#000;
}
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
  color: black;
  opacity: 0.4; /* Firefox */
}
</style>
<div class="preloader" style="display:none;">
        <div class="spinner"></div>
        
</div>
    <div class="page-wrapper">
        <!-- Start of Header -->
        <header class="header ">
            <div class="header-top">
                <div class="container">
                  
                    
                    
                    <div class="header-left">
                        
                  <div class="contact-info" style="
    display: flex;
        align-items: center;


">
      <i class="fas fa-envelope"></i>&nbsp;<a class="phone-number ls-50" href="mailto:info@oxijan.co.uk">info@oxijan.co.uk</a>

        
       
        
        
     &nbsp;&nbsp;&nbsp;
                        <span class="delimiter">|</span>  &nbsp;&nbsp;&nbsp;
        <i class="fas fa-phone"></i> &nbsp;
        <a href="tel:<?=$settings['site_phone'];?>" class="phone-number ls-50"><?=$settings['site_phone'];?></a>
    </div>
</div>

                    
                    
                    <div class="header-right" style="
   

">
                        
        
                     <div class="header-right">
                         
                  
                       
                        <!--<a href="<?=base_url();?>web/contact" class="d-lg-show">CONTACT US</a> &nbsp;&nbsp;&nbsp;<span class="delimiter">|</span>-->
                        <!--  <a href="<?=base_url('blogs');?>" class="d-lg-show">CHECKOUT</a> &nbsp;&nbsp;&nbsp;<span class="delimiter">|</span>-->
                        <!--<a href="<?=base_url('contact');?>" class="d-lg-show">MY ACCOUNT</a>&nbsp;&nbsp;&nbsp; <span class="delimiter">|</span>-->
                        
                        
                        
                        
                         <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
        </div>
                        
   
                        
                    </div>
                </div>
            </div>
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
            
            .search-mobile .input-wrapper .form-control::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
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
              .search-mobile{
                  display:block !important;
              }
              
            }
            .search-mobile{
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            .category-menu .megamenu {
                    min-width: unset;
                    width: 100%;
                }
            </style>
            <!-- End of Header Top -->
            
            
            
            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                    
                          <a href="<?=base_url();?>" class="logo ml-lg-0">
                            <img src="<?=base_url();?>uploads/settings/<?=$settings['site_logo'];?>" alt="<?=$settings['site_title'];?>" width="144" height="55" />
                        </a>
                        
                        <?php 
function getOptions($row, $level){
    $html = '';
    if(isset($_GET['search']) && isset($_GET['category']) && $_GET['category'] == $row['slug']){
        if($level==0){ 
        $html .= '<option value="'.$row['slug'].'" selected>'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['slug'].'" selected>&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    }else{
        if($level==0){ 
        $html .= '<option value="'.$row['slug'].'">'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['slug'].'">&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    }
    
    return $html;
}
?>
                        <form method="get" action="<?=base_url();?>products/"
                            class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                            <div class="select-box">
                                <select id="category" name="category">
                                    <option value="">All Categories</option>
                                    <?php
                                    
                                    
                                    foreach($this->Base_model->getAll('app_categories', '*') as $row){
                                                                        
                                                                        if($row['level']==0){
                                                                            echo getOptions($row, $row['level'], $sn);
                                                                            foreach($this->Base_model->getAll('app_categories', '*') as $row1){
                                                                                
                                                                                if($row1['level']==1 && $row1['parent_id'] == $row['id']){ 
                                                                                    echo getOptions($row1, $row1['level'], $sn);
                                                                                    
                                                                                }
                                                                                
                                                                            } 
                                                                                
                                                                        } 
                                                                    
                                                                    }?>
                                    
                                    
                                </select>
                            </div>
                            <input type="text" class="form-control" name="search" id="search" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="Search in..." minlength="3"
                                required />
                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                            </button>
                        </form>
                        <?php if($this->session->userdata('user_loggedin')){ ?>
                        <a href="<?=base_url('user/account');?>" class=""><i
                                class="w-icon-account"></i>My Account</a>
                        <?php }else{
                        if(uri_string() != 'user/register'){?>
                        
                        <a href="javascript:void(0)" class="login sign-in-click" style=" border: 1px solid #095473;
       padding: 7px 2% 7px 2%;
    border-radius: 2.5rem;"><i
                                class=""></i><b style="font-weight: 20px;">Account &nbsp; <i class="fas fa-user"></i></b></b></a>&nbsp;&nbsp;&nbsp;
                        <!--<span class="delimiter">|</span>-->
    <!--                    <a href="javascript:void(0)" class="ml-0 login register-click" style="border: 1px solid #095473;-->
    <!--   padding: 7px 2% 7px 2%;-->
    <!--border-radius: 2.5rem;">REGISTER</a>-->
                        <?php }} ?>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                            
                            <!--<a href="tel:#" class="w-icon-call"></a>-->
                            <!--<div class="call-info d-lg-show">-->
                            <!--    <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">-->
                            <!--        <a href="javascript:void(0);" class="text-capitalize">Call Us Now</a> :</h4>-->
                            <!--    <a href="tel:<?=$settings['site_phone'];?>" class="phone-number font-weight-bolder ls-50"><?=$settings['site_phone'];?></a>-->
                            <!--</div>-->
                            
                            
                        </div>
                     
     

    
                        <!--<a class="wishlist label-down link" href="<?=base_url();?>user/store_request">
                        <!--    <i class="w-icon-shipping"></i>-->
                        <!--    <span class="wishlist-label">Selling</span>-->
                        <!--</a>-->
                         <?php
                                    if($this->session->userdata('user_loggedin')){
                                        $user_id = $this->session->userdata('user_id');
                                        $cart = $this->db->query("SELECT * FROM app_cart where user_id = '$user_id'")->result_array();
                                    }else{
                                        $session_id = $_COOKIE['session_id'];
                                        $cart = $this->db->query("SELECT * FROM app_cart where session_id = '$session_id'")->result_array();
                                    } 
                                    
                                   
                                    
                                    ?>
                        <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>
                            <a href="#" class="cart-toggle label-down link">
                                <i class="w-icon-cart">
                                    <span class="cart-count"><?=count($cart);?></span>
                                </i>
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
                                    foreach($cart as $row){
                                    $total += $row['qty']*$row['price'];
                                    $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
                                    ?>
                                    <div class="product product-cart">
                                        <div class="product-detail">
                                            <a href="<?=base_url();?>products/view/<?=$product['slug'];?>" class="product-name"><?=$product['name'];?></a>
                                            <div class="price-box">
                                                <span class="product-quantity"><?=$row['qty'];?></span>
                                                <span class="product-price">£ <?=$row['price'];?></span>
                                            </div>
                                        </div>
                                        <figure class="product-media">
                                            <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
                                                <img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img'];?>" alt="<?=$product['name'];?>" height="84"
                                                    width="94" />
                                            </a>
                                        </figure>
                                       
                                    </div>
                                    <?php } ?>
                                </div>

                                <div class="cart-total">
                                    <label>Subtotal:</label>
                                    <span class="price">£ <?=$total;?></span>
                                </div>

                                <div class="cart-action">
                                    <a href="<?=base_url();?>cart" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
                                    <a href="<?=base_url();?>checkout" class="btn btn-primary  btn-rounded">Checkout</a>
                                </div>
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>
                    
                    
                    
                    
                    
                </div>
            </div>
            
                <div class="header-bottom sticky-content fix-top sticky-header <? if(uri_string() == ''){ echo '';} ?>">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <nav class="main-nav">
                              
                                
                         <ul class="menu">
    <?php 
    $cat0 = $this->db->query("SELECT t2.* FROM app_categories t2 WHERE t2.level=0 && (SELECT COUNT(*) FROM  app_categories t1 WHERE t1.parent_id = t2.id) > -1 ORDER BY (SELECT COUNT(*) FROM  app_categories t1 WHERE t1.parent_id = t2.id) DESC LIMIT 0,6")->result_array();
    
    foreach($cat0 as $row0) {
        // Check if there are products in this category
        $products_count = $this->db->query("SELECT COUNT(*) as count FROM app_products WHERE category_id IN (SELECT id FROM app_categories WHERE id = '{$row0['id']}' OR parent_id = '{$row0['id']}')")->row()->count;
        if($products_count > 0) { // Display category only if it has products
    ?>
        <li>
            <a href="<?=base_url();?>products/?category=<?=$row0['slug']; ?>"><?=$row0['name']; ?></a>
            <?php 
            $cat1 = $this->db->query("SELECT * FROM app_categories WHERE level=1 && parent_id = '{$row0['id']}'")->result_array();
            if(count($cat1) > 0) { ?>
                
            <?php } ?>
        </li>
    <?php } ?>
    <?php } ?>
    <!------------ Jobs Lots Menu ------------>
    <li style="background-color: red !important; marign: 3px;">
            <a href="<?=base_url();?>products/?category=jobs-lots">Jobs Lots</a>
            <?php 
            $cat28 = $this->db->query("SELECT * FROM app_categories WHERE parent_id = '28'")->result_array();
            if(count($cat28) > 0) { ?>
                <ul>
                    <?php foreach($cat28 as $row1){  
                        // Check if there are products in this subcategory
                        // Display subcategory only if it has products
                    ?>
                            <li>
                                <a href="<?=base_url();?>products/?category=<?=$row1['slug']; ?>"><?=$row1['name']; ?></a>
                                
                            </li>
                    <?php } ?>
                </ul>
            <?php }else{
                echo "<ul><li>N/A</li></ul>";
            }?>
        </li>
</ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="header-middle search-mobile" style="display:none">
                <div class="container">
                     <form action="<?=base_url();?>products/" method="get" class="input-wrapper">
                        <input type="text" class="form-control" name="search" autocomplete="off" value="<?php if(isset($_GET['search'])){ echo $_GET['search']; } ?>" placeholder="Search"
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
            
            <!-- End of Header Middle -->
<style>
.menu > li > a {
    font-size: 12px;
}
.menu li a {
    /*padding: 10px 0 10px 0;*/
    font-size: 12px;
}
    
</style>
        
        </header>
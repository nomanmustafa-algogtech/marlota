<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_id = $this->session->userdata('admin_id');
$permissions_allow = $this->session->userdata('permissions_allow');
?>
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title><?php echo $this->title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="icon" type="image/png" href="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>">
        <link rel="shortcut icon" type="image/png" href="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>">

		<!-- App css -->
	    <?php $this->load->view('admin/includes/layouts.css.php'); ?>
	    
	    <style>
.select2-container--default.select2-container--disabled .select2-selection--single {
    cursor: default;
}
.select2-dropdown {
    border: 1px solid #ced4d9;
	border-bottom: 1px solid #2a2f4e;
}
.select2-container--default .select2-results__option[aria-selected=true] {
}
.select2-container--default .select2-selection--single {
    border: 1px solid #ced4d9;
    border-radius: 4px;
	height: 36px;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #5a5c61;
    line-height: 28px;
	padding-top: 2px;
}
.imagePreview {
    width: 150px;
    height: 150px;
    background-position: center center;
  background-image:url(<?=base_url();?>adminfiles/images/no-image.jpg);
  background-color:#fff;
    background-size: cover;
  background-repeat:no-repeat;
    display: inline-block;
 border: 1px #e5e8eb solid;
}
.btn-upload
{
  display:block;
  border-radius:0px;
  /*box-shadow:0px 4px 6px 2px rgba(0,0,0,0.2);*/
  width: 150px;
  margin-top:-5px;
}
.imgUp
{
  margin-bottom:15px;
}
tr.footable-empty > td {
    font-size: 20px;
    position: relative;
    padding-top: 20px;
    text-align:center;
}

/*tr.footable-empty > td:before {*/
/*    content: "\f105";*/
    /*font-family: "Line Awesome Free";*/
/*    font-weight: 900;*/
/*    position: absolute;*/
/*    left: 50%;*/
/*    top: 20px;*/
/*    font-size: 60px;*/
/*    opacity: 0.5;*/
/*    transform: translate(-50%, 0px);*/
/*}*/
.bootstrap-tagsinput .badge {
    margin: 2px 5px;
    color: #fff;
    background: #3bafda;
}

</style>

    </head>

    <body class="loading">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <div class="navbar-custom">
                <div class="container-fluid">
    
                    <ul class="list-unstyled topnav-menu float-end mb-0">

                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
    
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="<?=base_url();?>adminfiles/images/users/avatar-1.jpg" alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    <?=$this->session->userdata('user_name');?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
    
                                <!-- item-->
                                <a href="<?=base_url('vendors/home/my_account');?>" class="dropdown-item notify-item">
                                    <i class="ri-account-circle-line"></i>
                                    <span>My Account</span>
                                </a>

                                <!-- item-->
                                <a href="<?=base_url('vendors/home/change_password');?>" class="dropdown-item notify-item">
                                    <i class="ri-settings-3-line"></i>
                                    <span>Change Password</span>
                                </a>

                                <!-- item-->
                                

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="<?=base_url('vendors/home/logout');?>" class="dropdown-item notify-item">
                                    <i class="ri-logout-box-line"></i>
                                    <span>Logout</span>
                                </a>
    
                            </div>
                        </li>
    
                    </ul>

                    <!-- LOGO -->
                    <div class="logo-box">

                        <a href="<?=base_url('vendors');?>" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>" alt="" height="24">
                            </span>
                            <span class="logo-lg">
                                <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_logo'];?>" alt="" height="20">
                            </span>
                        </a>
                    </div>
    
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <!-- Mobile menu toggle (Horizontal Layout)-->
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>   
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <!-- LOGO -->
                <div class="logo-box">
                   
                    <a href="<?=base_url('vendors');?>" class="logo logo-light text-center">
                        <span class="logo-sm">
                            <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_logo'];?>" alt="" height="45">
                        </span>
                    </a>
                </div>

                <div class="h-100" data-simplebar>

                  

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">
                            
                            <li>
                                <a href="<?=base_url('vendors/home');?>">
                                    <i class="ri-message-2-line"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="#products" data-bs-toggle="collapse" aria-expanded="false" aria-controls="products">
                                    <i class="ri-shopping-cart-2-line"></i>
                                    <span> Products </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="products">
                                    <ul class="nav-second-level">
                                        
                                        <li><a href="<?=base_url('vendors/products/add_new');?>">Add New Product</a></li>
                                        <li><a href="<?=base_url('vendors/products/');?>">All Products</a></li>
                                        <li><a href="<?=base_url('vendors/products/attributes');?>">Attributes</a></li>
                                        
                                       
                                    </ul>
                                </div>
                            </li>
                            
                            <!--<li>
                                <a href="#sales" data-bs-toggle="collapse" aria-expanded="false" aria-controls="sales">
                                    <i class="ri-money-dollar-box-line"></i>
                                    <span> Sales </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sales">
                                    <ul class="nav-second-level">
                                        
                                        <li><a href="<?=base_url('vendors/orders/new_orders');?>">New Orders</a></li>
                                        <li><a href="<?=base_url('vendors/orders/processing_orders');?>">Processing Orders</a></li>
                                        <li><a href="<?=base_url('vendors/orders/out_for_delivery');?>">Out for Delivery</a></li>
                                        <li><a href="<?=base_url('vendors/orders/all_orders');?>">All Orders</a></li>
                                        
                                       
                                    </ul>
                                </div>
                            </li>-->

                           
                            
                            <li>
                                <a href="<?=base_url('vendors/home/logout');?>">
                                    <i class="ri-logout-box-r-line"></i>
                                    <span> Logout </span>
                                </a>
                            </li>
                            
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

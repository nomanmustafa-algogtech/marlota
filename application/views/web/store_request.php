<?php
if(isset($_SESSION['vendor_id'])){
    redirect(base_url('vendors'));
    exit;
}
?>
<main class="main login-page">
           

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li>Login/Register (Vendor)</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class="page-content">
                <div class="container">
                    <div class="login-popup" style="max-width: 80rem;">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li class="nav-item">
                                    <a href="#sign-in-vendor" class="nav-link">Login Vendor Account</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#sign-up-vendor" class="nav-link active">Create Vendor Account</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <?=$this->CI->flash_message();?>
                                <div class="tab-pane" id="sign-in-vendor">
                                    
                                    <form id="sign-up-vendor-form" method="post" action="<?=base_url();?>vendors/authentication">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Email <span style="color:red">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Password <span style="color:red">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-checkbox d-flex align-items-center justify-content-between">
                                                    <a href="<?=base_url();?>vendors/authentication/reset_password" >Forgot your password?</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        
                                        <button type="submit" name="login" id="btnLogin" class="btn btn-primary">Login</button>
                                    </form>
                                </div>
                                <div class="tab-pane active" id="sign-up-vendor">
                                    
                                    <form id="sign-up-vendor-form" method="post" action="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Store Name <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="store_name" id="store_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Owner Name <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="owner_name" id="owner_name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Store Type <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="store_type" id="store_type" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email <span style="color:red">*</span></label>
                                                    <input type="email" class="form-control" name="email" id="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password <span style="color:red">*</span></label>
                                                    <input type="password" class="form-control" name="password" id="password" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="phone" id="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <label>City <span style="color:red">*</span></label>
                                                    <select class="form-control" name="city" id="city" required>
                                                        <? include('includes/cities.php');?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address <span style="color:red">*</span></label>
                                                    <input type="text" class="form-control" name="address" id="address" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <p>Your personal data will be used to support your experience 
                                            throughout this website, to manage access to your account, 
                                            and for other purposes described in our <a href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary">privacy policy</a>.</p>
                                        <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                            <input type="checkbox" class="custom-checkbox" id="agree-register" name="agree" required="">
                                            <label for="agree" class="font-size-md">I agree to the <a  href="<?=base_url();?>privacy_policy" target="_blank" class="text-primary font-size-md">privacy policy</a></label>
                                        </div>
                                        <button type="submit" name="register" id="btnRegister" class="btn btn-primary">Submit Your Request</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
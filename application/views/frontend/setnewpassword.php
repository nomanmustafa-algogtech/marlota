<main class="main login-page">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li>New Password</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->
            <div class="page-content">
                <div class="container">
                    <div class="login-popup">
                        <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li class="nav-item active">
                                    <a href="#new-password" class="nav-link">New Password</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="new-password">
                                    <p style="color:red;text-align:center">Please choose your own password to secure your account.</p>
                                    <?=$this->CI->flash_message();?>
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label>New Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="newpassword" id="newpassword" required>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label>Confirm Password <span style="color:red">*</span></label>
                                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" required>
                                        </div>
                                        <br>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

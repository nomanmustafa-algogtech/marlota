 <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        
                    
                                        <a href="<?=base_url();?>" class="logo text-center">
                                            <span class="logo-lg">
                                                <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>" alt="" height="52">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your email and phone no to reset your account password.</p>
                                </div>
                                <?=$this->CI->flash_message();?>
                                <form action="" method="post">

                                    <div class="mb-2">
                                        <label for="username" class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" required="" placeholder="Enter your registerd email">
                                    </div>

                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input class="form-control" type="text" name="phone" id="phone" required="" placeholder="Enter your registered phone">
                                    </div>

                                    

                                    <div class="d-grid mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Reset Password </button>
                                    </div>

                                </form>

                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
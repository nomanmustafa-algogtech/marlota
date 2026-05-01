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
                                                <img src="<?=base_url();?>uploads/settings/<?=$this->settings['site_icon'];?>" alt="" height="100">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your username and password to access admin panel.</p>
                                </div>
                                <?=$this->CI->flash_message();?>
                                <form action="" method="post">

                                    <div class="mb-2">
                                        <label for="username" class="form-label">Username</label>
                                        <input class="form-control" type="text" name="username" id="username" required="" placeholder="Enter your username">
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                            
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="d-grid mb-0 text-center">
                                        <button class="btn btn-primary" type="submit"> Log In </button>
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

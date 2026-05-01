<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Change Password</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
    
                                        <div class="row">
                                            <div class="col-12">
                                                <?=$this->CI->flash_message();?>
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" method="post">
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="old_password">Old Password</label>
                                                            <div class="col-md-6">
                                                                <input type="password" id="old_password" name="old_password" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="new_password">New Password</label>
                                                            <div class="col-md-6">
                                                                <input type="password" id="new_password" name="new_password" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="confirm_password">Confirm Password</label>
                                                            <div class="col-md-6">
                                                                <input type="password" id="confirm_password" name="confirm_password" class="form-control"required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <div class="col-md-8 text-end">
                                                                <button class="btn btn-primary waves-effect waves-light me-1" type="submit">
                                                                    Submit
                                                                </button>
                                                                <button type="reset" class="btn btn-secondary waves-effect">
                                                                    Cancel
                                                                </button>
                                                            </div>
                                                        </div>
    
                                                        
    
                                                    </form>
                                                </div>
                                            </div>
    
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div>
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?="&copy; 2014-".date('Y')." Ali Softtech. All Right Reserved"?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
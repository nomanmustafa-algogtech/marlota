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
                                    <h4 class="page-title">Add User</h4>
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
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="role_id">Select Role</label>
                                                            <div class="col-md-6">
                                                                <select class="select2 form-control" name="role_id" id="role_id" required>
                												    <option value="">Select Roles</option>
                												    <?php foreach($roles as $role){ ?>
                												        <option value="<?=$role['id'];?>" ><?=$role['name'];?></option>
                												    <?php } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="fullname">Full Name</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="fullname" name="fullname" class="form-control" placeholder="e.g Mian Ali" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="username">Username</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="username" name="username" class="form-control" placeholder="e.g mianalise" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="email">Email</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="email" name="email" class="form-control" placeholder="e.g info@alisofttech.com" required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="password">Password</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="password" name="password" class="form-control" placeholder="e.g JA7^%@$3" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="phone">Phone</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="phone" name="phone" class="form-control" placeholder="e.g +92 300 1234567">
                                                            </div>
                                                        </div>
                                                     
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="image">Image</label>
                                                            <div class="col-md-3 imgUp">
                                                                <div class="imagePreview"></div>
                                                                <label class="btn btn-upload btn-primary">
										    			            Upload<input type="file" class="uploadFile img" name="profile_pic" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
				                                                </label>
                                                            </div>
                                                        </div>
                                                       
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <div class="text-end">
                                                                <input class="btn btn-primary waves-effect waves-light me-1" type="submit" name="submit" value="Submit">
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
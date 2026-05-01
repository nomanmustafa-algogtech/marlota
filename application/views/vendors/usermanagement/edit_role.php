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
                                    <h4 class="page-title">Edit Role</h4>
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
                                                            <label class="col-md-2 col-form-label" for="name">Role Name</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="name" name="name" class="form-control" value="<?=$role['name']; ?>" placeholder="e.g Administrator" required>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="mb-2 row">
                                                             <?php 
                                                             $perms = explode(',', $role['permissions']);
                                                            $permissions = $this->db->query("select * from app_permissions order by name asc")->result_array();
                                                            foreach($permissions as $perm){ ?>
                                                            <div class="col-3">
                                                                <div class="form-group">
                                                                <label><?php echo $perm['name']; ?> : </label> <input name="perm[]"  type="checkbox" class="float-right" value="<?php echo $perm['id']; ?>" <?php if(in_array($perm['id'], $perms)){echo 'checked'; } ?>>
                                                                </div>
                                                            </div>
                                                            <?php } ?>
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
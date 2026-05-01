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
                                    <h4 class="page-title">Add Zone</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <?=$this->CI->flash_message();?>
                            </div>
                        </div>                   
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="zone_id">Zones </label>
                                                               <select name="zone_id" id="zone_id" class="form-control select2" required>
                                                                   <option value="">Select Zone</option>
                                                                   <?php foreach($zones as $row){ ?>
                                                                        <option value="<?=$row['id'];?>" <?php if(isset($_GET['zone_id']) && $row['id'] == $_GET['zone_id']){ echo 'selected'; } ?>><?=$row['name'];?></option>
                                                                   <?php } ?>
                                                               </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="name">Area Name </label>
                                                                <input type="text" id="name" name="name" class="form-control" value="" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <div class="text-end">
                                                                <input class="btn btn-primary waves-effect waves-light me-1" type="submit" name="submit" value="Save">
                                                            </div>
                                                        </div>
    
                                                        
    
                                                    </form>
                                                </div>
                                            </div>
    
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div>
                            <div class="col-2"></div>
                        </div> <!-- end row --> 
                        
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
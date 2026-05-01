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
                                    <h4 class="page-title">Add Payment</h4>
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
                                                            <label class="col-md-2 col-form-label" for="user_id">Select User</label>
                                                            <div class="col-md-6">
                                                                <select class="select2 form-control" name="user_id" id="user_id" required>
                												    <option value="">Select User</option>
                												    <?php foreach($users as $user){ ?>
                												        <option value="<?=$user['id'];?>" ><?=$user['full_name'];?> (<?=$user['email'];?>)</option>
                												    <?php } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="trx_id">Transection Id</label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="trx_id" name="trx_id" class="form-control" placeholder="e.g TRX-12345678910" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="amount">Amount</label>
                                                            <div class="col-md-6">
                                                                <input type="number" step="0.01" id="amount" name="amount" class="form-control" placeholder="e.g 100.25" required>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

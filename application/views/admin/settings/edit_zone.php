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
                                    <h4 class="page-title">Edit Zone</h4>
                                    
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
                                                                <label class="col-form-label" for="city_id">City </label>
                                                                
                                                                 <!--<select tabindex="1" class="select2 form-control mb-3 custom-select" style="width: 100%; height:36px;" name="fld_supplier_id" id="fld_supplier_id" onchange="updateValue()" required>-->
                                                <!--<option selected="selected" value="">Select Supplier</option>-->
												<?/*php
												if($supplier){
													foreach($supplier as $sup){
												?>
												<option value="<?= $sup['fld_id'];?>" data_set="<?= $sup['fld_supplier_name'];?>" <?php if($purchase['fld_supplier_id'] == $sup['fld_id']){ echo 'selected'; };?>><?= $sup['fld_supplier_name'];?></option>
												<?php } } */?>
                                        <!--</select>-->
    
                                                               <select name="city_id" id="city_id" class="form-control select2" required disabled>
                                                                   <option value="">Select City</option>
                                                                   <?php if($cities){
                                                                    foreach($cities as $row){ ?>
                                                                        <option value="<?=$row['id'];?>" data_set="<?= $row['name'];?>" <?php if($city_id == $row['id']){ echo 'selected'; } ?>><?=$row['name'];?></option>
                                                                   <?php }} ?>
                                                               </select>
                                                               <!--<input type="text" class="form-control" value="<?//=$check_zone->city_id;?>">-->
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="name">Zone Name </label>
                                                                <input type="text" id="name" name="name" class="form-control" value="<?=$zone['name'];?>" placeholder="" required>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

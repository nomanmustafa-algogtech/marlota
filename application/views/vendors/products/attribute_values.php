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
                                    <h4 class="page-title">Attributes Values</h4>
                                    
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
                            <div class="col-7">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <h4 class="card-title">Values </h4>
                                        <table  class="table dt-responsive nowrap w-100 basic-datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">#</th>
                                                                    <th width="70%">Values</th>
                                                                    <th width="20%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                if($attribute_values){
                                                                foreach($attribute_values as $row){
                                                                    // $role = $this->db->select("*")->from("app_roles")->where('id', $row['role_id'])->get()->row_array();
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['value'];?></td>
                                                                    
                                                                   
                                                                    <td>
                                                                        
                                                                        <button type="button" onclick="window.location.href='<?=base_url();?>vendors/products/attribute_edit/value/<?=$row['id'];?>';" class="btn btn-success btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-edit-box-line"></i></button>
                                                                        <button type="button" onclick="if(confirm('Are you sure you want to delete this value?')){ window.location.href='<?=base_url();?>vendors/products/attribute_delete/value/<?=$row['id'];?>/?att_id=<?=$row['attribute_id'];?>'; }" class="btn btn-danger btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-delete-bin-line"></i></button>
                                                                        
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <?php }}else{ ?>
                                                                    <tr class="footable-empty"><td colspan="4"><i class="ri-spam-3-line" style="font-size:60px" aria-hidden="true"></i><br> Nothing Found</td></tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                        <!-- end accordion -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Add Value</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="name">Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="name" name="name" class="form-control" value="<?=$attribute['name'];?>" placeholder="e.g Size" readonly>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="value">Value</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="value" name="value" class="form-control" placeholder="e.g Small" required>
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
                            </div><!-- end col -->
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
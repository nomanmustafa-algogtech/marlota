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
                                    <h4 class="page-title">All Attributes</h4>
                                    
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
                                        <h4 class="card-title">Attributes </h4>
                                        <table  class="table dt-responsive nowrap w-100 basic-datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">#</th>
                                                                    <th width="25%">Name</th>
                                                                    <th width="40%">Values</th>
                                                                    <th width="25%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                if($attributes){
                                                                foreach($attributes as $row){
                                                                    $values = $this->db->select("*")->from("app_attribute_values")->where('attribute_id', $row['id'])->get()->result_array();
                                                                    
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['name'];?></td>
                                                                    <td>
                                                                        <?php 
                                                                        foreach($values as $rowvalue){ ?>
                                                                            <span class="badge bg-secondary"><?=$rowvalue['value']; ?></span>
                                                                        <?php } ?>
                                                                    </td>
                                                                    
                                                                   
                                                                    <td>
                                                                        <button type="button" onclick="window.location.href='<?=base_url();?>vendors/products/attribute_values/<?=$row['id'];?>';" class="btn btn-primary btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-settings-2-line"></i></button>
                                                                        <button type="button" onclick="window.location.href='<?=base_url();?>vendors/products/attribute_edit/name/<?=$row['id'];?>';" class="btn btn-success btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-edit-box-line"></i></button>
                                                                        <button type="button" onclick="if(confirm('Are you sure you want to delete this attribute?')){ window.location.href='<?=base_url();?>vendors/products/attribute_delete/name/<?=$row['id'];?>'; }" class="btn btn-danger btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-delete-bin-line"></i></button>
                                                                        
                                                                        
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
                                    <h4 class="card-title">Add Attribute</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            <label class="col-md-2 col-form-label" for="name">Name</label>
                                                            <div class="col-md-12">
                                                                <input type="text" id="name" name="name" class="form-control" placeholder="e.g Size" required>
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
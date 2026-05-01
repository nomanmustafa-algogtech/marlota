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
                                    <h4 class="page-title">All Suppliers</h4>
                                    
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
                                        <h4 class="card-title">Suppliers </h4>
                                        <table  class="table dt-responsive nowrap w-100 basic-datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">#</th>
                                                                    <th width="10%">Logo</th>
                                                                    <th width="20%">Name</th>
                                                                    <th width="20%">Phone</th>
                                                                    <th width="20%">Email</th>
                                                                    <th width="20%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                if($suppliers){
                                                                foreach($suppliers as $row){
                                                                    // $role = $this->db->select("*")->from("app_roles")->where('id', $row['role_id'])->get()->row_array();
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$row['id'];?></td>
                                                                    <td><img src="<?=base_url();?>uploads/suppliers/<?=$row['logo'];?>" style="height: 30px;" /></td>
                                                                    <td><?=$row['name'];?></td>
                                                                    <td><?=$row['phone'];?></td>
                                                                    <td><?=$row['email'];?></td>
                                                                    
                                                                    
                                                                   
                                                                    <td>
                                                                       
                                                                        <button type="button" onclick="window.location.href='<?=base_url();?>admin/products/edit_supplier/<?=$row['id'];?>';" class="btn btn-success btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-edit-box-line"></i></button>
                                                                        <button type="button" onclick="if(confirm('Are you sure you want to delete this supplier?')){ window.location.href='<?=base_url();?>admin/products/supplier_delete/<?=$row['id'];?>'; }" class="btn btn-danger btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-delete-bin-line"></i></button>
                                                                        
                                                                        
                                                                    </td>
                                                                </tr>
                                                                <?php }}else{ ?>
                                                                    <tr class="footable-empty"><td colspan="6"><i class="ri-spam-3-line" style="font-size:60px" aria-hidden="true"></i><br> Nothing Found</td></tr>
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
                                    <h4 class="card-title">Add Supplier</h4>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="name">Name </label>
                                                                <input type="text" id="name" name="name" class="form-control" placeholder="e.g John" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           <div class="col-md-12">
                                                                 <label class="col-form-label" for="phone">Phone</label>
                                                                <input type="text" id="phone" name="phone" class="form-control" placeholder="+44 434 434 4333">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           <div class="col-md-12">
                                                                 <label class="col-form-label" for="email">Email</label>
                                                                <input type="email" id="email" name="email" class="form-control" placeholder="info@email.com">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="logo">Logo (120x120)</label>
                                                                <input type="file" class="form-control" name="logo" id="logo" required>
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
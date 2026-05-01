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
                                    <h4 class="page-title">User List</h4>
                                    <div class="page-title-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/usermanagement/add_user');?>'">
                                               <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add User
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">

                                        <table  class="table dt-responsive nowrap w-100 basic-datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">Sn</th>
                                                                    <th>Name</th>
                                                                    <th>Username</th>
                                                                    <th>Email</th>
                                                                    <th>Role</th>
                                                                    <th width="15%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($users as $row){
                                                                    $role = $this->db->select("*")->from("app_roles")->where('id', $row['role_id'])->get()->row_array();
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['fullname'];?></td>
                                                                    <td><?=$row['username'];?></td>
                                                                    <td><?=$row['email'];?></td>
                                                                    <td><?=$role['name'];?></td>
                                                                    
                                                                   
                                                                    <td>
                                                                        <button type="button" onclick="window.location.href='<?=base_url('admin/usermanagement/edit_user/'.$row['id']);?>'" class="btn btn-primary btn-xs waves-effect waves-light">Edit</button>
                                                                        
                                                                        <a href="<?=base_url('admin/usermanagement/delete_user/'.$row['id']);?>" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm('Are you sure you want to delete this role?')">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                        <!-- end accordion -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
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
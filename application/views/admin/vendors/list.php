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
                                    <h4 class="page-title">Store List</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">

                                        <table  class="table dt-responsive nowrap w-100 basic-datatable" id="datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">Sn</th>
                                                                    <th>Store Name</th>
                                                                    <th>Owner Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>City</th>
                                                                    <th>Created Date</th>
                                                                    <th width="7%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($vendors as $row){
                                                                    
                                                                $sn++ ;?>
                                                                <tr>
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['store_name'];?></td>
                                                                    <td><?=$row['owner_name'];?></td>
                                                                    <td><?=$row['email'];?></td>
                                                                    <td><?=$row['phone'];?></td>
                                                                    <td><?=$row['city'];?></td>
                                                                    <td><?=date('Y-m-d', strtotime($row['created_date']));?></td>
                                                                    <td>
                                                                        <a href="<?=base_url();?>admin/vendors/vendors_products/<?=$row['id'];?>"  class="btn btn-info btn-xs waves-effect waves-light"><i class ="fa fa-eye" title="View Products"></i></a>
                                                                        <a href="<?=base_url();?>admin/vendors/delete/<?=$row['id'];?>" onclick="return confirm('Are you sure you want to delete this store. After Deletion all products will be unlisted.')" class="btn btn-danger btn-xs waves-effect waves-light"><i class ="fa fa-trash" title="Delete Store"></i></a>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

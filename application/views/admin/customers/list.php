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
                                    <h4 class="page-title">Customer List</h4>
                                    
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
                                                                    <th>Full Name</th>
                                                                    <th>Email</th>
                                                                    <th>Phone</th>
                                                                    <th>Country</th>
                                                                    <th>Balance</th>
                                                                    <th>Created Date</th>
                                                                    <!--<th width="7%">Action</th>-->
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($customers as $row){
                                                                    
                                                                $sn++ ;?>
                                                                <tr>
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['id'];?> - <?=$row['full_name'];?></td>
                                                                    <td><?=$row['email'];?></td>
                                                                    <td><?=$row['phone'];?></td>
                                                                    <td><?=$row['country'];?></td>
                                                                    <td><?=$row['balance'];?></td>
                                                                    <td><?=date('Y-m-d', strtotime($row['created_date']));?></td>
                                                                    
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

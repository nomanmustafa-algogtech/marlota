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
                                    <h4 class="page-title">Payment List</h4>
                                    <div class="page-title-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/payments/add_payment');?>'">
                                               <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Payment
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
                                                                    <th>Date/Time</th>
                                                                    <th>Customer</th>
                                                                    <th>Trx Id</th>
                                                                    <th>Amount</th>
                                                                    <th>Method</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($payments as $row){
                                                                    $user = $this->db->select("*")->from("app_users")->where('id', $row['user_id'])->get()->row_array();
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=date('d/M Y H:i', strtotime($row['datetime']));?></td>
                                                                    <td><?=$user['full_name'];?><br><?=$user['email'];?></td>
                                                                    <td><?=$row['trx_id'];?></td>
                                                                    <td><?=$row['amount'];?></td>
                                                                    <td><?if($row['method']==1){echo'Cash on Delivery';}elseif($row['method']==2){echo'Credit Card';}elseif($row['method']==3){echo'Paypal';}?></td>
                                                                    
                                                                   
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

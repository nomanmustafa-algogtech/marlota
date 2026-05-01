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
                                    <h4 class="page-title">Visitors Logs</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        <style>
            table {
            	word-wrap:break-word;
            	width:100%;
            	table-layout:fixed;
            }
        </style>
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">

                                        <table  class="table  w-100 basic-datatable" id="datatable">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%">Sn</th>
                                                                    <th width="15%">Date/Time</th>
                                                                    <th width="10%">Ip Address</th>
                                                                    <th width="20%">Page Url</th>
                                                                    <th width="20%">Ref Url</th>
                                                                    <th width="30%">Agent</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($history as $row){
                                                                    
                                                                $sn++ ;?>
                                                                <tr>
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=date('d/m/Y H:i', strtotime($row['created_date']));?></td>
                                                                    <td><?=$row['user_ip_address'];?></td>
                                                                    <td><?=$row['page_url'];?></td>
                                                                    <td><?=$row['referrer_url'];?></td>
                                                                    <td><?=$row['user_agent'];?></td>
                                                                    
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
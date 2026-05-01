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
                                    <h4 class="page-title">Zone List</h4>
                                    <div class="page-title-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/settings/add_zone');?><?php if($this->input->get('city_id')){ echo '?city_id='.$this->input->get('city_id');} ?>'">
                                               <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Zone
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

                                        <table  class="table dt-responsive nowrap w-100 basic-datatable" id="products_table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">Sn</th>
                                                                    <th>Zone Name</th>
                                                                    <th>City Name</th>
                                                                    <th width="20%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                foreach($zones as $row){
                                                                    $city = $this->db->query("SELECT * FROM app_cities WHERE id = '{$row['city_id']}'")->row_array();
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['name'];?></td>
                                                                    <td><?=$city['name'];?></td>
                                                                    <td>
                                                                        
                                                                        <a  href="<?=base_url();?>admin/settings/areas/?zone_id=<?=$row['id'];?>" class="btn btn-success btn-xs waves-effect waves-light">Areas</a>
                                                                        <?php if($row['status'] == 1){ ?>
                                                                        <a href="<?=base_url('admin/settings/disable_zone/'.$row['id'].'/'.$row['city_id']);?>" class="btn btn-danger btn-xs waves-effect waves-light">Disable</a>
                                                                        <?php }else{ ?>
                                                                        <a href="<?=base_url('admin/settings/enable_zone/'.$row['id'].'/'.$row['city_id']);?>" class="btn btn-primary btn-xs waves-effect waves-light">Enable</a>
                                                                        <?php } ?>
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
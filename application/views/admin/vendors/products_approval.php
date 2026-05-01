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
                                    <h4 class="page-title">Products Approval</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">

                                        <table  class="table basic-datatable" id="products_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%">Sn</th>
                                                                        <th>Image</th>
                                                                        <th>Store</th>
                                                                        <th>Name</th>
                                                                        <!--<th>Unit Price</th>-->
                                                                        <th>Category</th>
                                                                        <th width="15%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                                <tbody class="row_position">
                                                                    <?php 
                                                                    $sn = 0;
                                                                    foreach($products as $row){
                                                                        $cat = $this->db->select("*")->from("app_categories")->where('id', $row['category_id'])->get()->row_array();
                                                                        $store = $this->db->select("*")->from("app_vendors")->where('id', $row['vendor_id'])->get()->row_array();
                                                                    $sn++ ;?>
                                                                    <tr id="<?php echo $row['id']; ?>">
                                                                        <td><?=$sn;?></td>
                                                                        <td><img src="<?=base_url();?>uploads/products/<?=$row['thumbnail_img'];?>" style="width:50px;height:50px;" /></td>
                                                                        <td><?=$store['store_name'];?></td>
                                                                        <td><?=$row['name'];?></td>
                                                                        <!--<td><?//$row['unit_price'];?></td>-->
                                                                        <td><?=$cat['name'];?></td>
                                                                        <td>
                                                                            <a href="<?=base_url();?>admin/products/edit/<?=$row['id'];?>" target="_blank" class="btn btn-primary btn-xs waves-effect waves-light">View</a>
                                                                            <a href="<?=base_url();?>admin/vendors/approve_product/<?=$row['id'];?>" class="btn btn-success btn-xs waves-effect waves-light">Approve</a>
                                                                            
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

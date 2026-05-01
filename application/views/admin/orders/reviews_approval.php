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
                                    <h4 class="page-title">Reviews Approval</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">
   <style>
            table {
            	word-wrap:break-word;
            	width:100%;
            	table-layout:fixed;
            }
        </style>
                                        <table  class="table w-100 basic-datatable" id="datatable">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="7%">Sn</th>
                                                                        <th >Product/Order</th>
                                                                        <th >User</th>
                                                                        <th >Rating(%)</th>
                                                                        <th >Comment</th>
                                                                        <th width="5%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                                <tbody class="row_position">
                                                                    <?php 
                                                                    $sn = 0;
                                                                    foreach($reviews as $row){
                                                                        $products = $this->db->select("*")->from("app_product_stocks")->where('product_id', $row['product_id'])->get()->row_array();
                                                                        $product = $this->db->select("*")->from("app_products")->where('id', $row['product_id'])->get()->row_array();
                                                                        $user = $this->db->select("*")->from("app_users")->where('id', $row['user_id'])->get()->row_array();
                                                                    $sn++ ;?>
                                                                    <tr id="<?php echo $row['id']; ?>">
                                                                        <td><?=$sn;?></td>
                                                                        <td>Product : <a href="<?=base_url();?>products/view/<?=$product['slug'];?>" target="_blank"><?=$products['sku'];?></a><br>Order # <?=date('y' , strtotime($row['created_date']));?><?=$row['order_id'];?></td>
                                                                        <td><?=$user['full_name'];?><br><?=$user['phone'];?></td>
                                                                        <td><?=round($row['rating']*100/5);?> %</td>
                                                                        <td><?=$row['comment'];?></td>
                                                                        <td>
                                                                            
                                                                            <a href="<?=base_url();?>admin/orders/approve_review/<?=$row['id'];?>" class="btn btn-success btn-xs waves-effect waves-light">Approve</a>
                                                                            
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

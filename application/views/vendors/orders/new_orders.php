<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <form action="" method="post">
                            
                        
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">New Orders</h4>
                                        <!--<div class="page-title-right">-->
                                        <!--    <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/products/add_new');?>'">-->
                                        <!--           <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Product-->
                                        <!--    </button>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="row" style="margin-bottom:10px">
                                    <div class="col-12">
                                        <?=$this->CI->flash_message();?>
                                    </div>
                                    <div class="col-12" style="display:flex;justify-content: right;">
                                        
                                        <select id="charCount" class="form-control" style="width:40%; margin-left:10px; margin-right:10px" name="status" required>
                                            <option value="">Select Status</option>
                                            
                                            <option value="1">In Prepration</option>
                                            <option value="11">Return for refund</option>
                                            <option value="12">Not Delivered</option>
                                            <option value="13">Cancelled by Customer</option>
                                            <option value="14">Out of Stock</option>
                                            <option value="15">Lost/Stolen</option>
                                            
                                        </select>
                                        <button type="submit" class="btn btn-primary" style="float:right;margin-right:10px">Submit</button>
                                        <button type="button" class="btn btn-primary" style="float:right">Select All <input type="checkbox" id="select_all"/></button>
                                    </div>
                                    <div class="col-12">
                                        <p>Selected Orders : <span id="ocount">0</span></p>
                                        <?php if(count($orders) < 1){ ?>
                                            <br>
                                            <div class="alert alert-danger">Order list is empty.</div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- end page title --> 
                            
                            <?php 
                            
                            foreach($orders as $order){
                            
                            $user = $this->db->query("SELECT * FROM app_users WHERE id='{$order['user_id']}'")->row_array();?>
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                        <div class="card-title" style="font-size: 20px;"><input type="checkbox" name="orderid[]" value="<?=$order['id'];?>"><?=date('y' , strtotime($order['created_date']));?> - Order # <?=$order['id'];?><br>
                                        <span style="font-size: 13px;color: black;font-weight: bold;">Date: <?=date('Y-m-d H:i', strtotime($order['created_date']));?><br>
                                        User: <?=$user['id']?> - <?=$user['full_name']?>(<?=$user['phone']?>)
                                        </span></div>
                                            <table  class="table dt-responsive nowrap w-100" id="orders_table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="10%">Image</th>
                                                                        <th width="67%">Product Details</th>
                                                                        <th width="10%">QTY</th>
                                                                        <th width="13%">Price</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                                <tbody class="row_position">
                                                                    <?php 
                                                                    $sn = 0;
                                                                    $order_details = $this->db->query("SELECT * FROM app_order_details where order_id = '{$order['id']}'")->result_array();
                                                                    foreach($order_details as $row){
                                                                        $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
                                                                    $sn++ ;?>
                                                                    <tr>
                                                                        <td><img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img'];?>" style="width:50px;height:50px;" /></td>
                                                                        <td>Title: <?=$product['name'];?><br>
                                                                        SKU: <?=$row['sku'];?> <?php foreach(json_decode($row['variant']) as $attr){
                                                                        echo "<br> ".$attr->name.": ".$attr->value;
                                                                        } ?></td>
                                                                        <td><?=$row['qty'];?></td>
                                                                        <td><?=$row['price'];?></td>
                                                                        
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
                        <?php } ?>
                        </form>
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
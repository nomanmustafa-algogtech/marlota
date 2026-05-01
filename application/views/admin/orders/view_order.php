<?php
$shipping_address = $this->db->select("*")->from('app_address')->where(array('id'=>$order['shipping_address']))->get()->row_array();
$order_details = $this->db->select("*")->from('app_order_details')->where(array('order_id'=>$order['id']))->get()->result_array();
?>
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
                                        <h4 class="page-title">View Order # <?=$order['id'];?></h4>
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
                                   
                                </div>
                            </div>
                            <!-- end page title --> 
                            
                           
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <form action="" method="post">
                                            <div class="card-body">
                                        

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mt-3">
                                                     <h5>Shipping Address</h5>
                                                    <address>
                                                        <?=$shipping_address['full_name'];?><br>
                                                        <?=$shipping_address['address'];?><br>
                                                        <?=$shipping_address['street'];?><br>
                                                        <?=$shipping_address['zipcode'];?>, <?=$shipping_address['city'];?>, <?=$shipping_address['country'];?><br>
                                                        <abbr title="Phone">P:</abbr> <?=$shipping_address['phone'];?><br>
                                                        <abbr title="Email">E:</abbr> <?=$shipping_address['email'];?>
                                                    </address>
                                                </div>

                                            </div><!-- end col -->
                                            <div class="col-md-4 offset-md-2">
                                                <div class="mt-3 float-end">
                                                    <p class="m-b-10"><strong>Order No. : </strong> <span class="float-end"><?=$order['id'];?> </span></p>
                                                    <p class="m-b-10"><strong>Order Date : </strong> <span class="float-end"> &nbsp;&nbsp;&nbsp;&nbsp; <?=date('d/M Y H:i', strtotime($order['created_date']));?></span></p>
                                                    <p class="m-b-10"><strong>Order Status : </strong> <span class="float-end">
                                                    <?php if($order['status'] == 0){ ?>
                                                    <span class="badge bg-danger" style="float:right">Pending/New Order</span>
                                                    <?php }elseif($order['status'] == 1){ ?>
                                                    <span class="badge bg-warning" style="float:right">In Prepration</span>
                                                    <?php }elseif($order['status'] == 2){ ?>
                                                    <span class="badge bg-primary" style="float:right">Out for Delivery</span>
                                                    <?php }elseif($order['status'] == 100){ ?>
                                                    <span class="badge bg-success" style="float:right">Delivered/Completed</span>
                                                    <?php }elseif($order['status'] == 11){ ?>
                                                    <span class="badge bg-secondary" style="float:right">Return for refund</span>
                                                    <?php }elseif($order['status'] == 12){ ?>
                                                    <span class="badge bg-secondary" style="float:right">Not Delivered</span>
                                                    <?php }elseif($order['status'] == 13){ ?>
                                                    <span class="badge bg-secondary" style="float:right">Cancelled by Customer</span>
                                                    <?php }elseif($order['status'] == 14){ ?>
                                                    <span class="badge bg-secondary" style="float:right">Out of Stock</span>
                                                    <?php }elseif($order['status'] == 15){ ?>
                                                    <span class="badge bg-secondary" style="float:right">Lost/Stolen</span>
                                                    <?php } ?>
                                                    </span></p>
                                                    
                                                    <p class="m-b-10"><strong>Payment Method : </strong> <span class="float-end"><?if($order['payment_method']==1){echo'Cash on Delivery';}elseif($order['payment_method']==2){echo'Credit Card';}elseif($order['payment_method']==3){echo'Paypal';}?></span></p>
                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->


                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4 table-centered">
                                                        <thead>
                                                        <tr><th>#</th>
                                                            <th>Item</th>
                                                            <th style="width: 10%">Qty</th>
                                                            <th style="width: 10%">Price</th>
                                                            <th style="width: 10%" class="text-end">Total</th>
                                                        </tr></thead>
                                                        <tbody>
                                                            
                                                            <?php $sn = 0;
                                                            $total_amount = 0;
                                                            foreach($order_details as $orderdt){
                                                                $total_amount += $orderdt['total_amount'];
                                                            $sn++;
                                                            $product = $this->db->select("*")->from("app_products")->where('id', $orderdt['product_id'])->get()->row_array();?>
                                                            <tr>
                                                                <td><?=$sn;?></td>
                                                                <td>Title: <?=$product['name'];?><br>
                                                                            SKU: <?=$orderdt['sku'];?> <?php foreach(json_decode($orderdt['variant']) as $attr){
                                                                            echo "<br> ".$attr->name.": ".$attr->value;
                                                                            } ?></td>
                                                                <td>
                                                                    <input type="hidden" name="orderdt_id[]" value="<?=$orderdt['id'];?>"?>
                                                                    <input class="form-control" type="number" name="qty[]" value="<?=$orderdt['qty'];?>"? <?php if($order['status']!=0){echo 'readonly';} ?>>
                                                                </td>
                                                                <td><?=$orderdt['price'];?></td>
                                                                <td class="text-end"><?=$orderdt['total_amount'];?></td>
                                                            </tr>
                                                            <?php } ?>

                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive -->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                     <div class="row">
                                            <div class="col-sm-6">
                                                <div class="clearfix pt-5">
                                                    
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-end">
                                                    <h3>Vat  : <?=$order['vat'];?></h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-12">
                                                <div class="float-end">
                                                    <h3>Shipping Amount : <?=$order['shipping_cost'];?></h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-12">
                                                <div class="float-end">
                                                    <h3>Total Amount : <?=$total_amount +$order['shipping_cost']+$order['vat'];?></h3>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="mt-4 mb-1">
                                            <div class="text-end d-print-none">
                                                <?php if($order['status']==0){ ?>
                                                    <a href="<?=base_url();?>admin/orders/view/<?=$order['id'];?>/1" class="btn btn-primary waves-effect waves-light">In Preparation</a>
                                                <?php } ?>
                                                <?php if($order['status']==1){ ?>
                                                    <a href="<?=base_url();?>admin/orders/view/<?=$order['id'];?>/2" class="btn btn-primary waves-effect waves-light">Out For Delivery</a>
                                                <?php } ?>
                                                <?php if($order['status']==2){ ?>
                                                    <a href="<?=base_url();?>admin/orders/view/<?=$order['id'];?>/100" class="btn btn-primary waves-effect waves-light">Delivered</a>
                                                <?php } ?>
                                                <?php if($order['status']==0){ ?>
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update Order</button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                        </form>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div> <!-- end col -->
                            </div> <!-- end row --> 
                        </form>
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

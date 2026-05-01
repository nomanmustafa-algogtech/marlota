 <? $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array(); ?>
 <style>
     @media only screen and (max-width: 600px) {
  .deliverydate {
    margin-top:10px;
  }
  .price {
    margin-top:10px;
    text-align:right;
  }
}
.dates{
    font-size: 12px !important;
    line-height: 1 !important;
}
.ordername{
    margin: 0px 0 .5rem;
}
.myorders{
    padding: 20px;
    box-shadow: 0 3px 6px rgb(0 0 0 / 16%), 0 3px 6px rgb(0 0 0 / 23%);
    margin-top: 5%;
}
.toolbox .toolbox-show select {
    padding-left: 1.3rem;
    padding-right: 2.8rem;
    width: 10.4rem;
}
 </style>
 <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Account</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="<?=base_url();?>">Home</a></li>
                        <li>My account</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                        <ul class="nav nav-tabs mb-6" role="tablist">
                            <li class="link-item">
                                <a href="<?=base_url();?>user/account">Dashboard</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/orders"  class="active">Orders</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/referrals">Referrals</a>
                            </li>
                            <li class="link-item">
                                <a href="<?=base_url();?>user/logout">Logout</a>
                            </li>
                        </ul>

                        <div class="tab-content mb-6">
                            <div class="tab-pane active in" id="account-orders">
                                <?=$this->CI->flash_message();?>
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-6">
                                        <div class="icon-box icon-box-side icon-box-light">
                                            <span class="icon-box-icon icon-orders">
                                                <i class="w-icon-orders"></i>
                                            </span>
                                            <div class="icon-box-content">
                                                <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <div class="toolbox" style="float:right;margin-right: 15px;">
                                            <div class="toolbox-item toolbox-show select-box">
                                                <select name="count" class="form-control">
                                                    <option value="9">Show 9</option>
                                                    <option value="12" selected="selected">Show 12</option>
                                                    <option value="24">Show 24</option>
                                                    <option value="36">Show 36</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 
                                <?/*php if(count($orders) > 0){ ?>
                                <table class="shop-table account-orders-table mb-6">
                                    <thead>
                                        <tr>
                                            <th class="order-id" style="text-align: left;">Order</th>
                                            <th class="order-date" style="text-align: left;">Date</th>
                                            <th class="order-status" style="text-align: left;">Status</th>
                                            <th class="order-total" style="text-align: right;">Total</th>
                                            <th class="order-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        foreach($orders as $row){ ?>
                                        <tr>
                                            <td class="order-id">#<?=$row['id'];?></td>
                                            <td class="order-date"><?=date('d/m/Y', strtotime($row['created_date']));?></td>
                                            <td class="order-status">
                                                <?php if($row['status'] == 0){ ?>
                                                    Pending/New Order
                                                    <?php }elseif($row['status'] == 1){ ?>
                                                    In Prepration
                                                    <?php }elseif($row['status'] == 2){ ?>
                                                    Out for Delivery
                                                    <?php }elseif($row['status'] == 100){ ?>
                                                    Delivered/Completed
                                                    <?php }elseif($row['status'] == 11){ ?>
                                                    Return for refund
                                                    <?php }elseif($row['status'] == 12){ ?>
                                                    Not Delivered
                                                    <?php }elseif($row['status'] == 13){ ?>
                                                    Cancelled by Customer
                                                    <?php }elseif($row['status'] == 14){ ?>
                                                    Out of Stock
                                                    <?php }elseif($row['status'] == 15){ ?>
                                                    Lost/Stolen
                                                    <?php } ?>
                                            </td>
                                            <td class="order-total" style="text-align: right;">
                                                <span class="order-price">Rs. <?=$row['total_amount'];?></span>
                                            </td>
                                            <td class="order-action" style="text-align: right;">
                                                <a href="<?=base_url();?>user/order/<?=$row['id'];?>"
                                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <a href="<?=base_url();?>" class="btn btn-dark btn-rounded btn-icon-right">Go Shop<i class="w-icon-long-arrow-right"></i></a>
                                <?php }else{ ?>
                                <div class="alert alert-error alert-inline show-code-action">You dont have any order placed yet.</div>
                                <?php } */?>
                                <div class="container">
                                    <?php 
                                        foreach($orders as $row){ ?>
                                                <div class="myorders">
                                        <h6 class="ordername">Order-Id: <?=date('y', strtotime($row['created_date'])).$row['id'];?></h6>
                                        <p class="dates">Placed on <?=date('d/M Y H:is', strtotime($row['created_date']));?></p>
                                        <hr>
                                        <?php
                                        $order_details = $this->db->query("SELECT * FROM app_order_details where order_id = '{$row['id']}'")->result_array();
                                        foreach($order_details as $orderdt){
                                        $product = $this->db->query("SELECT * FROM app_products where id = '{$orderdt['product_id']}'")->row_array();
                                        ?>
                                            <div class="row ">
                                        <div class="col-md-6">
                                            
                                            <div class="row">
                                                <div class="col-sm-3 col-3">
                                                    <img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img']; ?>" alt="<?=$product['name']; ?>" style="height:80px;width:80px;">
                                                </div>
                                                <div class="col-sm-9 col-9"><span><?=$product['name']; ?></span></div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-1 col-6" style="text-align:right;">
                                            <p>Qty x <span><?=$orderdt['qty']; ?></span></p>
                                        </div>
                                        <div class="col-md-3 col-6" style="text-align:center;">
                                            <?php if($orderdt['status'] == 0){ ?>
                                                <span class="bg-danger" style="color:#fff;padding: 5px;font-size:9px;"> Pending/New Order</span>
                                                <?php }elseif($orderdt['status'] == 1){ ?>
                                                 <span class="bg-warning" style="color:#fff;padding: 5px;font-size:9px;">In Prepration</span>
                                                <?php }elseif($orderdt['status'] == 2){ ?>
                                                 <span class="bg-primary" style="color:#fff;padding: 5px;font-size:9px;">Out for Delivery</span>
                                                <?php }elseif($orderdt['status'] == 100){ ?>
                                                <span class="bg-success" style="color:#fff;padding: 5px;font-size:9px;"> Delivered/Completed</span>
                                                <?php }elseif($orderdt['status'] == 11){ ?>
                                                 <span class="bg-secondary" style="color:#fff;padding: 5px;font-size:9px;">Return for refund</span>
                                                <?php }elseif($orderdt['status'] == 12){ ?>
                                                <span class="bg-secondary" style="color:#fff;padding: 5px;font-size:9px;"> Not Delivered</span>
                                                <?php }elseif($orderdt['status'] == 13){ ?>
                                                 <span class="bg-secondary" style="color:#fff;padding: 5px;font-size:9px;">Cancelled by Customer</span>
                                                <?php }elseif($orderdt['status'] == 14){ ?>
                                                 <span class="bg-secondary" style="color:#fff;padding: 5px;font-size:9px;">Out of Stock</span>
                                                <?php }elseif($orderdt['status'] == 15){ ?>
                                                 <span class="bg-secondary" style="color:#fff;padding: 5pxfont-size:9px;">Lost/Stolen</span>
                                            <?php } ?>
                                        </div>
                                       
                                        <div class="col-md-2 price">
                                            <p>Rs. <?=$orderdt['total_amount']; ?></p>
                                        </div>
                                        </div>
                                            <hr>
                                        <?php } ?>    
                                        <div class="col-md-12" style="text-align:right;">
                                            <span style="font-weight:bold;">Total Amount: Rs. <?=$row['total_amount'];?></span>
                                        </div>
                                        
                                      </div>
                                     <?php } ?>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
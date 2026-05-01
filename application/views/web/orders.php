 <?php $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array(); ?>
 <style>
     @media only screen and (max-width: 600px) {
  .deliverydate {
    margin-top:10px;
  }
  .price {
    margin-top:10px;
    text-align:right;
  }
  .tab-pane {
    font-size: 1rem;
    line-height: 1.3;
    padding: 1.3rem 0;
    color: #666;
}
.qty{
    display :none;
}
.tab-pane p {
    font-size: 1rem !important;
    line-height: 1.8 !important;
}
.textt{
    color: #fff;
    padding: 5px;
    font-size: 6px !important;
    border-radius: 5px !important;
}
.pname{
    margin-top:15px;
}
.batch{
    text-align:right !important;
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


.badge {
    display: inline-block;
    padding: 3px;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 5px;
}
.bg-secondary {
    background-color: #6c757d!important;
}
.bg-success {
    background-color: #1abc9c!important;
}
.bg-primary {
    background-color: #3bafda!important;
}
.bg-warning {
    background-color: #f7b84b!important;
}
.bg-danger {
    background-color: #f1556c!important;
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
                            <!--<li class="link-item">-->
                            <!--    <a href="<?=base_url();?>user/referrals">Referrals</a>-->
                            <!--</li>-->
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
                                <div class="container">
                                    
                                    <?php 
                                    if (count($orders) < 1){
                                        echo '<div class="alert alert-success alert-inline show-code-action">Your order list is empty.</div>';
                                    }
                                        foreach($orders as $row){ ?>
                                                <div class="myorders">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                            <h6 class="ordername">Order-Id: <?=date('y', strtotime($row['created_date'])).$row['id'];?></h6>
                                                            <p class="dates">Placed on <?=date('d/M Y H:is', strtotime($row['created_date']));?></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <?php if($row['status'] == 0){ ?>
                                                                <span class="textt bg-danger" style="color:#fff;padding: 5px;font-size:9px;float: right;"> Pending/New Order</span>
                                                                <?php }elseif($row['status'] == 1){ ?>
                                                                 <span class="textt bg-warning" style="color:#fff;padding: 5px;font-size:9px;float: right;">In Prepration</span>
                                                                <?php }elseif($row['status'] == 2){ ?>
                                                                 <span class="textt bg-primary" style="color:#fff;padding: 5px;font-size:9px;float: right;">Out for Delivery</span>
                                                                <?php }elseif($row['status'] == 100){ ?>
                                                                <span class="textt bg-success" style="color:#fff;padding: 5px;font-size:9px;float: right;"> Delivered/Completed</span>
                                                                <?php }elseif($row['status'] == 11){ ?>
                                                                 <span class="textt bg-secondary" style="color:#fff;padding: 5px;font-size:9px;float: right;">Return for refund</span>
                                                                <?php }elseif($row['status'] == 12){ ?>
                                                                <span class="textt bg-secondary" style="color:#fff;padding: 5px;font-size:9px;float: right;"> Not Delivered</span>
                                                                <?php }elseif($row['status'] == 13){ ?>
                                                                 <span class="textt bg-secondary" style="color:#fff;padding: 5px;font-size:9px;float: right;">Cancelled by Customer</span>
                                                                <?php }elseif($row['status'] == 14){ ?>
                                                                 <span class="textt bg-secondary" style="color:#fff;padding: 5px;font-size:9px;float: right;">Out of Stock</span>
                                                                <?php }elseif($row['status'] == 15){ ?>
                                                                 <span class="textt bg-secondary" style="color:#fff;padding: 5pxfont-size:9px;float: right;">Lost/Stolen</span>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                        
                                        
                                        <hr>
                                        <?php
                                        $order_details = $this->db->query("SELECT * FROM app_order_details where order_id = '{$row['id']}'")->result_array();
                                        foreach($order_details as $orderdt){
                                        $product = $this->db->query("SELECT * FROM app_products where id = '{$orderdt['product_id']}'")->row_array();
                                        ?>
                                            <div class="row ">
                                        <div class="col-md-7">
                                            
                                            <div class="row">
                                                <div class="col-sm-3 col-3">
                                                    <a href="<?=base_url();?>products/view/<?=$product['slug'];?>" target="_blank">
                                                        <img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img']; ?>" alt="<?=$product['name']; ?>" style="height:80px;width:80px;">
                                                    </a>
                                                </div>
                                                <div class="col-sm-9 col-9 pname "><a href="<?=base_url();?>products/view/<?=$product['slug'];?>" target="_blank"><span><?=$product['name']; ?></span></a></div>
                                            </div>
                                            
                                            
                                        </div>
                                        <div class="col-md-2 col-6" style="text-align:center;">
                                            <p><span class="qty">Qty</span> x <span><?=$orderdt['qty']; ?></span></p>
                                        </div>
                                        
                                       
                                        <div class="col-md-3 price" style="text-align:right">
                                            <p>£ <?=$orderdt['total_amount']; ?></p>
                                        </div>
                                        </div>
                                            <hr>
                                        <?php } ?> 
                                        <div class="row">
                                            <div class="col-md-6" style="text-align:left;">
                                                <span style="font-weight:bold;">Paid By: </span><?if($row['payment_method']==1){echo'Cash on Delivery';}elseif($row['payment_method']==2){echo'Credit Card';}elseif($row['payment_method']==3){echo'Paypal';}?>
                                            </div>
                                            <div class="col-md-6" style="text-align:right;">
                                                <span style="font-weight:bold;">Shipping Cost: £ <?=$row['shipping_cost'];?> </span>
                                            </div>
                                              <div class="col-md-12" style="text-align:right;">
                                                <span style="font-weight:bold;">VAT: £ <?=$row['vat'];?> </span>
                                            </div>
                                            <div class="col-md-12" style="text-align:right;">
                                                <span style="font-weight:bold;">Total Amount: £ <?=$row['total_amount']+$row['vat']+$row['shipping_cost'];?> </span>
                                            </div>
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

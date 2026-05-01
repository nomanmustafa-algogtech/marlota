<?php
$order = $this->db->query("SELECT * FROM app_orders WHERE id = '{$orderdt['order_id']}'")->row_array();
$shipping_address = $this->db->query("SELECT * FROM app_address where id = '{$order['shipping_address']}'")->row_array();
       $city = $this->db->query("SELECT * FROM app_cities where id = '{$shipping_address['city_id']}'")->row_array();
       $area = $this->db->query("SELECT * FROM app_areas where id = '{$shipping_address['area_id']}'")->row_array();
       $zone = $this->db->query("SELECT * FROM app_zones where id = '{$area['zone_id']}'")->row_array();
       ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<div class="container">
    <div class="panel panel-default mb-5">
        <div class="panel-heading">
            <div class="row">
                
                <div class="col-md-6 center">
                    <img src="https://beaters.pk/uploads/settings/logo_bottom_1642713009.png" alt="logo" class="" style="width:30%">
                </div>
                <div class="col-md-6 pull-left" style="text-align:right">
                    <strong>Order no : <?=date('y', strtotime($order['created_date'])).$order['id'];?></strong><br>
                    <strong>Shipping Cost : <?=$orderdt['shipping_cost'];?></strong><br>
                    <strong>Total Amount : <?=$orderdt['total_amount'];?></strong><br>
                    Created: <?=date('d/m/y H:i', strtotime($order['created_date']));?> <br>
                </div>
                
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-6 mb-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Address Details:
                    </div>
                    <div class="panel-body">
                      <address>
                        <strong><?=$shipping_address['full_name'];?></strong> <br>
                        <?=$shipping_address['address'];?><br>
                        <?=$shipping_address['street'];?><br>
                        <?=$city['name'];?><br>
                        <?=$area['name'];?><br>
                        <?=$shipping_address['phone'];?><br>
                        <?=$shipping_address['email'];?><br>
                        </address>
                    </div>
                </div>                
            </div>
            <div class="col-md-6 mb-3 text-right">
              <div class="panel panel-default">
                  <div class="panel-heading">
                    Product Details:
                  </div>
                  <div class="panel-body">
                    <?php 
                    // foreach($order_details as $item){
                        echo  $orderdt['sku'].' &nbsp;&nbsp;'.$orderdt['qty'].' x '.$orderdt['price'].'<br>';
                    // }
                    ?>
                  </div>
                </div>
            </div>
            <div class="col-md-12 mb-3" style="height:1px; border-bottom: 3px dotted #000;margin-bottom: 50px;margin-top: 40px;"></div> 
            <div class="col-md-12 mb-3" style="padding: 0px;margin-bottom:10px">
                <div class="panel panel-default" style="margin-bottom: 0px;">
                    <div class="panel-heading" >
                        <div class="row">
                
                            <div class="col-md-6 center">
                                <img src="https://beaters.pk/uploads/settings/logo_bottom_1642713009.png" alt="logo" class="" style="width:30%">
                            </div>
                            <div class="col-md-6 pull-left" style="text-align:right">
                                <strong>Order no : <?=date('y', strtotime($order['created_date'])).$order['id'];?></strong><br>
                                <strong>Shipping Cost : <?=$orderdt['shipping_cost'];?></strong><br>
                                <strong>Total Amount : <?=$orderdt['total_amount']; ?></strong><br>
                                Created: <?=date('d/m/y H:i', strtotime($order['created_date']));?> <br>
                            </div>
                            
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-md-6 mb-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Address Details:
                    </div>
                    <div class="panel-body">
                       <address>
                           <h3 style="margin:0px"><?=$zone['name'];?> / <?=$city['name'];?></h3>
                            <strong><?=$shipping_address['full_name'];?></strong> <br>
                            <?=$shipping_address['address'];?><br>
                            <?=$shipping_address['street'];?><br>
                            <?=$area['name'];?><br>
                            <?=$shipping_address['phone'];?><br>
                            <?=$shipping_address['email'];?><br>
                        </address>
                    </div>
                </div>                
            </div>
            <div class="col-md-6 mb-3 text-left">
              <div class="panel panel-default">
                  <div class="panel-heading">
                    Product Details:
                  </div>
                  <div class="panel-body">
                    <?php 
                    // foreach($order_details as $item){
                    $product = $this->db->query("SELECT * FROM app_products where id = '{$orderdt['product_id']}'")->row_array();
                    if($product['supplier_id'] > 0){ 
                        $supplier = $this->db->query("SELECT * FROM app_suppliers where id = '{$product['supplier_id']}'")->row_array();
                    }
                    ?>
                         <img src="<?=base_url();?>uploads/checkbox.png" style="width:15px" /> <?=$orderdt['sku']?> (<?=$orderdt['qty'];?>) <?php if($product['supplier_id'] > 0){  ?> / Supplier : <?=$supplier['name'];?> <?php } ?><br>
                    <?php //} ?>
                    <br>
                    <img src="<?=base_url();?>uploads/checkbox.png" style="width:15px" /> Order Packed <br>
                    <img src="<?=base_url();?>uploads/checkbox.png" style="width:15px" /> Passed To Beaters Express <br>
                    <img src="<?=base_url();?>uploads/checkbox.png" style="width:15px" /> Delivered To Customer <br>
                    
                    <br>
                    <br>
                    <p style="text-align:right">Customer Signature</p>
                </div>
            </div>
        </div>
    </div>
</div>
<p>Print Date & Time : <?=date('Y-m-d H:i:s');?></p>
</div>
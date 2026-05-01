<main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="<?=base_url();?>user/order/<?=$order['id']; ?>">Order # <?=$order['id']; ?></a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-12 pr-lg-0 mb-6">
                            <?=$this->CI->flash_message();?>
                            <?php $total = 0;
                            if(count($order_details) > 0){ ?>
                            <form action="<?=base_url();?>cart/updateCart" method="post">
                            <table class="shop-table cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-name"><span>Product</span></th>
                                        <th></th>
                                        <th class="product-price"><span>Price</span></th>
                                        <th class="product-quantity"><span>Quantity</span></th>
                                        <th class="product-subtotal"><span>Subtotal</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $total = 0;
                                    $sn=0;
                                    foreach($order_details as $row){
                                        $sn++;
                                    $total += $row['qty']*$row['price'];
                                    $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
                                    ?>
                                    <tr>
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
                                                    <figure>
                                                        <img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img'];?>" alt="<?=$product['name'];?>"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="product-name" >
                                            <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
                                                <?=$product['name'];?>
                                            </a>
                                            <p><?=$row['sku'];?></p>
                                            <?php if($order['status']==100){ ?>
                                            <div id="reviewbutton_<?=$sn; ?>">
                                                <?php 
                                                $user_id = $this->session->userdata('user_id');
                                                $check_review = $this->db->query("SELECT * FROM app_product_reviews WHERE user_id = '$user_id' && order_id = '{$order['id']}' && product_id = '{$row['product_id']}'")->num_rows();
                                                if($check_review == 0){ ?>
                                                <a href="javascript:void(0)" onclick="reviewproduct(<?=$sn; ?>, <?=$order['id']; ?>, <?=$row['product_id'];?>)" class="review-click">Write a Review</a>
                                                <?php } ?>
                                            </div>
                                            <?php } ?>
                                            
                                        </td>
                                        <td class="product-price" style="text-align:center"><span class="amount">£ <?=$row['price'];?></span></td>
                                        <td class="product-quantity" style="text-align:center"><?=$row['qty'];?></td>
                                        <td class="product-subtotal" style="text-align:center">
                                            <span class="amount" >£ <?=$row['qty']*$row['price'];?></span>
                                        </td>
                                    </tr>
                                    
                                    <?php } ?>
                                    <tr>
                                        <td colspan="4" style="text-align:right">Total Amount: </td>
                                        <td class="product-subtotal" style="text-align:center">
                                            <span class="amount" >£ <?=$total;?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            
                            </form>
                            <?php }else{ ?>
                            <?php } ?>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
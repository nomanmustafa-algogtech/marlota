<style>
	.cart-summary a:hover {
		color: #ffffff !important;
	}
</style>
<main class="main cart">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="active"><a href="<?=base_url();?>cart">Shopping Cart</a></li>
                        <li><a href="<?=base_url();?>checkout">Checkout</a></li>
                        <li><a href="javascript:void(0);">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="row gutter-lg mb-10">
                        <div class="col-lg-8 pr-lg-4 mb-6">
                            <?php $total = 0;
                            if(count($cart) > 0){ ?>
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
                                    foreach($cart as $row){
                                    $total += $row['qty']*$row['price'];
                                    $product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
                                    ?>
                                    <tr>
                                        <input type="hidden" name="cart_id[]" value="<?=$row['id'];?>" />
                                        <td class="product-thumbnail">
                                            <div class="p-relative">
                                                <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
                                                    <figure>
                                                        <img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img'];?>" alt="<?=$product['name'];?>"
                                                            width="300" height="338">
                                                    </figure>
                                                </a>
                                                <button type="button" onclick="window.location.href='<?=base_url();?>cart/deleteCart/<?=$row['id'];?>'" class="btn btn-close"><i
                                                        class="fas fa-times"></i></button>
                                            </div>
                                        </td>
                                        <td class="product-name">
                                            <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
                                                <?=$product['name'];?>
                                            </a>
                                            <p><?=$row['sku'];?></p>
                                        </td>
                                        <td class="product-price"><span class="amount">£ <?=$row['price'];?></span></td>
                                        <td class="product-quantity">
                                            <div class="input-group">
                                                <input class="1quantity form-control" id="qty_<?=$row['id'];?>" type="number" readonly name="qty[]" value="<?=$row['qty'];?>" min="1" max="1000">
                                                <button class="1quantity-plus w-icon-plus" onclick="addvalue(1, <?=$row['id'];?>);"></button>
                                                <button class="1quantity-minus w-icon-minus" onclick="addvalue(-1, <?=$row['id'];?>);"></button>
                                            </div>
                                        </td>
                                        <td class="product-subtotal">
                                            <span class="amount">£ <?=$row['qty']*$row['price'];?></span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            
                            <div class="cart-action mb-6">
                                <a href="<?=base_url();?>" class="btn btn-dark btn-rounded btn-icon-left btn-shopping mr-auto"><i class="w-icon-long-arrow-left"></i>Continue Shopping</a>
                                <button type="button" onclick="window.location.href='<?=base_url();?>cart/clearCart'" class="btn btn-rounded btn-default btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button> 
                                <button type="submit" class="btn btn-rounded btn-update" name="update_cart" value="Update Cart">Update Cart</button>
                            </div>
                            </form>
                            <?php }else{ ?>
                            <div class="alert alert-error alert-bg alert-inline show-code-action">Your cart is empty.</div>
                            <?php } ?>
                            <script>
                                function addvalue(val, id){
                                    var oldqty = $("#qty_"+id).val();
                                    var newqty = parseInt(oldqty)+parseInt(val);
                                    console.log(val, id, oldqty, newqty)
                                    if(newqty > 0 && newqty < 1000){
                                        $("#qty_"+id).val(newqty);
                                    }
                                    
                                }
                            </script>
                        </div>
                        <div class="col-lg-4 sticky-sidebar-wrapper">
                            <div class="sticky-sidebar">
                                <div class="cart-summary mb-4">
                                    <h3 class="cart-title text-uppercase">Cart Totals</h3>
                                    <div class="cart-subtotal d-flex align-items-center justify-content-between">
                                        <label class="ls-25">Subtotal</label>
                                        <span>£ <?=$total;?></span>
                                    </div>
                                    <hr class="divider mb-6">
                                    <div class="order-total d-flex justify-content-between align-items-center">
                                        <label>Total</label>
                                        <span class="ls-50">£ <?=$total;?></span>
                                    </div>
                                    <a href="<?=base_url();?>checkout"
                                        class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                        Proceed to checkout<i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>

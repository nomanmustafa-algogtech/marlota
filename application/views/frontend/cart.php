    <!--------------- blog-tittle-section---------------->
    <section class="blog about-blog">
    	<div class="container">
    		<div class="blog-bradcrum">
    			<span><a href="index.html">Home</a></span>
    			<span class="devider">/</span>
    			<span><a href="#">Cart</a></span>
    		</div>
    		<div class="blog-heading about-heading">
    			<h1 class="heading">Cart</h1>
    		</div>
    	</div>
    </section>
    <!--------------- blog-tittle-section-end---------------->

    <!--------------- cart-section---------------->
    <section class="product-cart product footer-padding">
    	<div class="container">
    		<div class="cart-section">
    			<?php $total = 0;
				if (count($cart) > 0) { ?>
    				<form action="<?= base_url(); ?>cart/updateCart" method="post">
    					<table>
    						<tbody>
    							<tr class="table-row table-top-row">
    								<td class="table-wrapper wrapper-product">
    									<h5 class="table-heading">PRODUCT</h5>
    								</td>
    								<td class="table-wrapper">
    									<div class="table-wrapper-center">
    										<h5 class="table-heading">PRICE</h5>
    									</div>
    								</td>
    								<td class="table-wrapper">
    									<div class="table-wrapper-center">
    										<h5 class="table-heading">QUANTITY</h5>
    									</div>
    								</td>
    								<td class="table-wrapper wrapper-total">
    									<div class="table-wrapper-center">
    										<h5 class="table-heading">TOTAL</h5>
    									</div>
    								</td>
    								<td class="table-wrapper">
    									<div class="table-wrapper-center">
    										<h5 class="table-heading">ACTION</h5>
    									</div>
    								</td>
    							</tr>
									<?php
									$total = 0;
									foreach ($cart as $row) {
										$total += $row['qty'] * $row['price'];
										$product = $this->db->query("SELECT * FROM app_products where id = '{$row['product_id']}'")->row_array();
									?>
							    	<input type="hidden" name="cart_id[]" value="<?=$row['id'];?>" />
    								<tr class="table-row ticket-row" data-id="<?= $row['id']; ?>" data-price="<?= $row['price']; ?>" data-qty="<?= $row['qty']; ?>">
    									<td class="table-wrapper wrapper-product">
    										<div class="wrapper">
    											<div class="wrapper-img">
    												<img src="<?=base_url();?>uploads/products/<?=$product['thumbnail_img'];?>" alt="<?=$product['name'];?>"
    													alt="img">
    											</div>
    											<div class="wrapper-content">
    												<h5 class="heading"> <a href="<?=base_url();?>products/view/<?=$product['slug'];?>">
															<?=$product['name'];?>
														</a>
													</h5>
													<p><?=$row['sku'];?></p>
    											</div>
    										</div>
    									</td>
    									<td class="table-wrapper">
    										<div class="table-wrapper-center">
    											<h5 class="heading">£ <?=$row['price'];?></h5>
    										</div>
    									</td>
    									<td class="table-wrapper">
    										<div class="table-wrapper-center">
    											<div class="quantity">
													<span class="product-minus">-</span>
													<span class="number" id="user_qty"><?= $row['qty']; ?></span> 
													<span class="product-plus">+</span>
												</div>
    										</div>
    									</td>
    									<td class="table-wrapper wrapper-total ">
    										<div class="table-wrapper-center">
    											<h5 class="heading ">£ <?=$row['qty']*$row['price'];?></h5>
    										</div>
    									</td>
    									<td class="table-wrapper">
    										<div class="table-wrapper-center">
												<span>
													<a href="<?= base_url('cart/deleteCart/' . $row['id']); ?>">
														<svg width="10" height="10" viewBox="0 0 10 10" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
																fill="#AAAAAA"></path>
														</svg>
													</a>
    											</span>
    										</div>
    									</td>
    								</tr>
    							<?php } ?>
    						</tbody>
    					</table>
    				<?php } else { ?>
    					<div class="alert alert-error alert-bg alert-inline show-code-action">Your cart is empty.</div>
    				<?php } ?>
    		</div>
			<?php if (count($cart) > 0) { ?>
				<div class="wishlist-btn cart-btn">
					<button type="button" onclick="window.location.href='<?=base_url();?>cart/clearCart'" class="clean-btn btn-clear" name="clear_cart" value="Clear Cart">Clear Cart</button>
					<button type="submit" class="shop-btn btn-update" name="update_cart" value="Update Cart">Update Cart</button>
					<a href="<?=base_url();?>checkout" class="shop-btn  btn-checkout">Proceed to Checkout</a>
				</div>
			<?php } ?>
    	</div>
    </section>
    <!--------------- cart-section-end---------------->
	<style>
		.show-code-action {
			font-size: large;
			text-align: center;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function () {
		 $(".product-plus, .product-minus").css("cursor", "pointer");
    $(".product-plus, .product-minus").click(function () {
        let row   = $(this).closest("tr");
        let id    = row.data("id");
        let price = parseFloat(row.data("price"));
        let numberEl = row.find(".number");
        let qty   = parseInt(numberEl.text());

        if ($(this).hasClass("product-plus")) {
			qty++;
		} else if ($(this).hasClass("product-minus") && qty > 1) {
			qty--;
		}

        numberEl.text(qty);

        $.ajax({
            url: "<?= base_url('cart/updateCartAjax'); ?>",
            method: "POST",
            data: { cart_id: id, qty: qty, price: price },
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    // update row total
                    row.find(".wrapper-total .heading").text("£ " + res.row_total);

                    // update header cart count
                    $(".cart-count").text(res.cart_count);

                    // update subtotal
                    $(".cart-subtotal").text("£ " + res.subtotal);
                }
            }
        });
    });
});


</script>

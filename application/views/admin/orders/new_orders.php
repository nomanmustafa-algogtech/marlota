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
                                    <!--<div class="col-12" style="display:flex;justify-content: right;">
                                        
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
                                    </div>-->
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
                            if(count($orders) > 0){ ?>
                           
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                        <div class="card-title" style="font-size: 20px;">Orders</div>
                                           <table  class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="15%">Date/Time</th>
                                                                        <th >Order#</th>
                                                                        <th >Buyer</th>
                                                                         <th >Vat</th>
                                                                        <th >Shipping Cost</th>
                                                                        <th >Total Amount</th>
                                                                        <th >Payment Method</th>
                                                                        <th >Action</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                                <tbody>
																	<?php if (!empty($orders)) { ?>
																	<?php foreach ($orders as $order) { ?>

																	<?php
																	// Determine buyer info safely
																	if ($order['guest_user'] == 1) {
																		// Guest checkout
																		$buyer_name  = $order['full_name'] ?? 'Guest';
																		$buyer_email = $order['email'] ?? 'N/A';
																	} else {
																		// Logged-in user
																		$user = $this->db
																			->select('full_name, email')
																			->from('app_users')
																			->where('id', $order['user_id'])
																			->get()
																			->row_array();

																		$buyer_name  = $user['full_name'] ?? 'N/A';
																		$buyer_email = $user['email'] ?? 'N/A';
																	}
																	?>

																	<tr>
																		<td><?= date('d/M H:i', strtotime($order['created_date'])); ?></td>
																		<td><?= $order['id']; ?></td>

																		<td>
																			<?= htmlspecialchars($buyer_name); ?><br>
																			<?= htmlspecialchars($buyer_email); ?>
																		</td>

																		<td><?= number_format($order['vat'], 2); ?></td>
																		<td><?= number_format($order['shipping_cost'], 2); ?></td>

																		<td>
																			<?= number_format(
																				$order['total_amount'] + $order['vat'] + $order['shipping_cost'],
																				2
																			); ?>
																		</td>

																		<td>
																			<?php
																			if ($order['payment_method'] == 1) echo 'Cash on Delivery';
																			elseif ($order['payment_method'] == 2) echo 'Credit Card';
																			elseif ($order['payment_method'] == 3) echo 'Paypal';
																			?>
																		</td>

																		<td>
																			<a href="<?= base_url('admin/orders/view/' . $order['id']); ?>"
																			class="btn btn-success btn-xs waves-effect waves-light">
																			View
																			</a>
																		</td>
																	</tr>

																	<?php } ?>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

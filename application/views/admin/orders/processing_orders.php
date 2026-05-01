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
                                        <h4 class="page-title">In Prepration</h4>
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
                                    
                                    <div class="col-12">
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
                                                                        <th >Total Amount</th>
                                                                        <th >Payment Method</th>
                                                                        <th >Action</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                               <tbody>
																<?php if (!empty($orders)) { ?>
																	<?php foreach ($orders as $order) { ?>
																		<tr>
																			<td><?= date('d/M H:i', strtotime($order['created_date'])); ?></td>

																			<td><?= (int) $order['id']; ?></td>

																			<td>
																				<?= htmlspecialchars($order['buyer_name']); ?><br>
																				<?= htmlspecialchars($order['buyer_email']); ?>
																			</td>

																			<td><?= number_format($order['total_amount'], 2); ?></td>

																			<td>
																				<?php
																				switch ((int)$order['payment_method']) {
																					case 1: echo 'Cash on Delivery'; break;
																					case 2: echo 'Credit Card'; break;
																					case 3: echo 'Paypal'; break;
																					default: echo 'N/A';
																				}
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
																<?php } else { ?>
																	<tr>
																		<td colspan="6" class="text-center">No processing orders found</td>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

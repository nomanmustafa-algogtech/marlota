<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                            
                        
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">All Orders</h4>
                                        <!--<div class="page-title-right">-->
                                        <!--    <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/products/add_new');?>'">-->
                                        <!--           <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Product-->
                                        <!--    </button>-->
                                        <!--</div>-->
                                    </div>
                                   
                                </div>
                            </div>
                            
                            <div class="row">
                       
                                <div class="col-12">
                                    <?=$this->CI->flash_message();?><br>
                                    <form action="" method="POST" style="margin-bottom: 10px;">
                                        <div class="row">
                                            <div class="col-sm-3 col-12">
                                                <input type="number" placeholder="Order #" class="form-control" name="order_id" value="<?php if(isset($_POST['order_id'])){ echo $_POST['order_id']; } ?>" />
                                            </div>
                                            <div class="col-sm-2 col-12" >
                                                <input type="date" class="form-control" name="from_date" value="<?php if(isset($_POST['from_date'])){ echo $_POST['from_date']; } ?>" />
                                            </div>
                                            <div class="col-sm-2 col-12" >
                                                <input type="date" class="form-control" name="to_date" value="<?php if(isset($_POST['to_date'])){ echo $_POST['to_date']; } ?>" />
                                            </div>
                                            <div class="col-sm-5 col-12">
                                                <input name="filter" value="1" type="hidden">
                                                <button type="submit" class="btn btn-primary" style="margin-right:10px" >Seach Orders</button>
                                                
                                                
                                            </div>
                                            
                                        </div>
                                    </form>
                                   
                                </div>
                            </div>
                            
                            
                            <form action="<?=base_url();?>admin/orders/changestatus" method="post">
                            <?php if ($this->input->post()): ?>
								<div class="row">
									<div class="row" style="margin-bottom:10px">
										<div class="col-12"></div>
										
										<div class="col-12">
											<?php if (count($orders) < 1 && isset($_POST['filter'])): ?>
												<br>
												<div class="alert alert-danger">Order list is empty.</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
                            <?php 
                            if($this->input->post()){
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
                                                                        <th >Status</th>
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
																				<?php
																				switch ((int)$order['status']) {
																					case 0:
																						echo '<span class="badge bg-danger float-end">Pending / New</span>';
																						break;
																					case 1:
																						echo '<span class="badge bg-warning float-end">In Preparation</span>';
																						break;
																					case 2:
																						echo '<span class="badge bg-primary float-end">Out for Delivery</span>';
																						break;
																					case 100:
																						echo '<span class="badge bg-success float-end">Delivered / Completed</span>';
																						break;
																					case 11:
																					case 12:
																					case 13:
																					case 14:
																					case 15:
																						echo '<span class="badge bg-secondary float-end">Cancelled / Returned</span>';
																						break;
																					default:
																						echo '<span class="badge bg-dark float-end">Unknown</span>';
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
																		<td colspan="7" class="text-center">No orders found</td>
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
                            <?php }} ?>
                            
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

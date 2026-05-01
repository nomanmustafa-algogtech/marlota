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
                                    <h4 class="page-title"><?=$this->settings['site_title'];?> (Vendor Panel)</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                        
                        <div class="col-sm-4 col-12" style="margin-top:10px" >
                            <div style="width:100%; height:200px;background: #1192d2;border: 1px solid #1192d2; border-radius: 5px;padding: 27px 40px; cursor: pointer;" onclick="window.location.href='<?=base_url();?>admin/orders/new_orders'">
                                <h2 style="text-align: center;color: white;font-size: 70px;margin-bottom:15px"><i class="ri-shopping-basket-line"></i></h2>
                                <h2 style="text-align:center; color:white;font-size: 16px;">New Orders</h2>
                                <h2 style="text-align:center; color:white;font-size: 16px; font-weight: bold;"><?=$this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 0 && a.vendor_id = '{$_SESSION['vendor_id']}' GROUP BY order_id;")->num_rows(); ?></h2>
                            </div>
                         </div>
                         <div class="col-sm-4 col-12" style="margin-top:10px" >
                            <div style="width:100%; height:200px;background: #04bbbf;border: 1px solid #04bbbf; border-radius: 5px;padding: 27px 40px;cursor: pointer;" onclick="window.location.href='<?=base_url();?>admin/orders/processing_orders'">
                                <h2 style="text-align: center;color: white;font-size: 70px;margin-bottom:15px"><i class="ri-shopping-cart-2-line"></i></h2>
                                <h2 style="text-align:center; color:white;font-size: 16px;">Processed Orders</h2>
                                <h2 style="text-align:center; color:white;font-size: 16px; font-weight: bold;"><?=$this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 1 && a.vendor_id = '{$_SESSION['vendor_id']}' GROUP BY order_id;")->num_rows(); ?></h2>
                            </div>
                         </div>
                         <div class="col-sm-4 col-12" style="margin-top:10px" >
                            <div style="width:100%; height:200px;background: #4caf50;border: 1px solid #4caf50; border-radius: 5px;padding: 27px 40px;cursor: pointer;" onclick="window.location.href='<?=base_url();?>admin/orders/out_for_delivery'">
                                <h2 style="text-align: center;color: white;font-size: 70px;margin-bottom:15px"><i class="ri-truck-line"></i></h2>
                                <h2 style="text-align:center; color:white;font-size: 16px;">Out for Delivery</h2>
                                <h2 style="text-align:center; color:white;font-size: 16px; font-weight: bold;"><?=$this->db->query("SELECT * FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 2 && a.vendor_id = '{$_SESSION['vendor_id']}' GROUP BY order_id;")->num_rows(); ?></h2>
                            </div>
                         </div>
                         <div class="col-sm-6 col-12" style="margin-top:10px" >
                            <div style="width:100%; height:200px;background: #9c27b0;border: 1px solid #9c27b0; border-radius: 5px;padding: 27px 40px;" >
                                <h2 style="text-align: center;color: white;font-size: 70px;margin-bottom:15px"><i class="ri-money-dollar-box-line"></i></h2>
                                <h2 style="text-align:center; color:white;font-size: 16px;">Total Sales</h2>
                                <h2 style="text-align:center; color:white;font-size: 16px; font-weight: bold;">Rs. <?=$this->db->query("SELECT IFNULL(SUM(a.total_amount), 0) as total  FROM app_order_details a, app_orders b WHERE b.id = a.order_id && b.status = 100 && a.vendor_id = '{$_SESSION['vendor_id']}'")->row()->total; ?></h2>
                            </div>
                         </div>
                         <div class="col-sm-6 col-12" style="margin-top:10px" >
                            <div style="width:100%; height:200px;background: #673ab7;border: 1px solid #673ab7; border-radius: 5px;padding: 27px 40px;cursor: pointer;" onclick="window.location.href='<?=base_url();?>admin/customers'">
                                <h2 style="text-align: center;color: white;font-size: 70px;margin-bottom:15px"><i class="ri-group-2-line"></i></h2>
                                <h2 style="text-align:center; color:white;font-size: 16px;">Products Listed</h2>
                                <h2 style="text-align:center; color:white;font-size: 16px; font-weight: bold;"><?=$this->db->query("SELECT * FROM app_products where vendor_id = '{$_SESSION['vendor_id']}'")->num_rows(); ?></h2>
                            </div>
                         </div>
                         
                    </div>
                     
                        <!-- end row-->
                        
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
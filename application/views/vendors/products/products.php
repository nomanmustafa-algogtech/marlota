<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
<style>
table.dataTable tbody>tr.selected, table.dataTable tbody>tr>.selected {
    background-color: #e9e9e9;
    color: black;
}
</style>

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                            <!-- start page title -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="page-title-box">
                                        <h4 class="page-title">Product List</h4>
                                        <div class="page-title-right">
                                            <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('vendors/products/add_new');?>'">
                                                   <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Product
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 
            
                            <div class="row">
                                <form action="" method="post">
                                    <div class="row" style="margin-bottom:10px">
                                        <div class="col-12">
                                            <?=$this->CI->flash_message();?>
                                        </div>
                                        <div class="col-12" style="display:flex;justify-content: right;">
                                            
                                            <select class="form-control select2" style="width:40%; margin-left:10px; margin-right:10px" name="status" required>
                                                <option value="">Select Status</option>
                                                
                                                <option value="featured">Set Featured</option>
                                                <option value="unfeatured">Set UnFeatured</option>
                                                <option value="published">Set Published</option>
                                                <option value="unpublished">Set UnPublished</option>
                                                
                                            </select>
                                            
                                            <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                                        </div>
                                    </div>
                                    <input id="product_ids" name="product_ids" type="hidden"/>
                                </form>
                                </div>
                                
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
    
                                            <table  class="table dt-responsive nowrap w-100 basic-datatable" id="products_table_check">
                                                                <thead>
                                                                    <tr>
                                                                        <th>
                                                                             <button style="border: none; background: transparent; font-size: 14px;" id="MyTableCheckAllButton">
                                                                                <i class="far fa-square"></i>  
                                                                             </button>
                                                                        </th>
                                                                        <th width="10%">Sn</th>
                                                                        <th>Image</th>
                                                                        <th>Name</th>
                                                                        <!--<th>Unit Price</th>-->
                                                                        <th>Category</th>
                                                                        <th>F</th>
                                                                        <th>P</th>
                                                                        <th width="7%">Action</th>
                                                                    </tr>
                                                                </thead>
                                                            
                                                            
                                                                <tbody class="row_position">
                                                                    <?php 
                                                                    $sn = 0;
                                                                    foreach($products as $row){
                                                                        // $cat = $this->db->select("*")->from("app_categories")->where('id', $row['category_id'])->get()->row_array();
                                                                        // $stock = $this->db->select("*")->from("app_product_stocks")->where('product_id', $row['id'])->get()->row_array();
                                                                    $sn++ ;?>
                                                                    <tr id="<?php echo $row['id']; ?>">
                                                                        <td></td>
                                                                        <td><?=$sn;?></td>
                                                                        <td><img src="<?=base_url();?>uploads/products/<?=$row['thumbnail_img'];?>" style="width:50px;height:50px;" /></td>
                                                                        <td><?=$row['sku'];?></td>
                                                                        <!--<td><?//$row['unit_price'];?></td>-->
                                                                        <td><?=$row['name'];?></td>
                                                                        <td><?=$row['featured'];?></td>
                                                                        <td><?=$row['published'];?></td>
                                                                        <td>
                                                                            
                                                                            <a  href="<?=base_url();?>vendors/products/edit/<?=$row['id'];?>" class="btn btn-success btn-xs waves-effect waves-light">Edit</a>
                                                                            <a href="<?=base_url('vendors/products/delete_product/'.$row['id']);?>" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                                                        </td>
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
                       
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <?="&copy; 2014-".date('Y')." Ali Softtech. All Right Reserved"?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
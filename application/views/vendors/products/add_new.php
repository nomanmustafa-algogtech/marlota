<?php
function getOptions($row, $level){
    $html = '';
    
        if($level==0){ 
        $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }elseif($level==2){
            $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    
    
    return $html;
}
?>
<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
<style>
.select2-container--default .select2-selection--multiple {
padding:2px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: #fff;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3aafda;
    border: 1px solid #3aafda;
}
.preloader {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background: white;
            z-index: 99999999;
            opacity: 0.6;
        }

        #preloader-logo {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
        }

       

        .spinner {
            width: 80px;
            height: 80px;
            border: 2px solid #f3f3f3;
            border-top: 3px solid #2489CE;
            border-radius: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            animation: spin 1s infinite ease;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }

</style>
<div class="preloader" style="display:none;">
        <div class="spinner"></div>
        
</div>
    

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Product</h4>
                                    <div class="page-title-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="$('#update_csv_file').click();">
                                               <span class="btn-label"><i class="mdi mdi-cloud-upload"></i></span> Update CSV
                                        </button>
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="$('#csv_file').click();">
                                               <span class="btn-label"><i class="mdi mdi-file-upload-outline"></i></span> Add CSV
                                        </button>
                                        <form action="<?=base_url();?>admin/products/add_csv" method="post" enctype="multipart/form-data" style="display:none">
                                            <input type="file" accept=".csv" name="csv_file" id="csv_file" onchange="this.form.submit(); $('.preloader').show();" />
                                        </form>
                                        <form action="<?=base_url();?>admin/products/update_csv" method="post" enctype="multipart/form-data" style="display:none">
                                             <input type="file" accept=".csv" name="csv_file" id="update_csv_file" onchange="this.form.submit(); $('.preloader').show();" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <?=$this->CI->flash_message();?>
                            </div>
                        </div>            
                        <form class="form-horizontal" role="form" action="" id="choice_form" enctype="multipart/form-data" method="post">
                            <div class="row">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title">Product Information</div>
                                        <div class="row">
                                            
                                            <div class="col-12">
                                                <div class="p-2">
                                                    
                                                        
                                                         <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="name">Product Name </label>
                                                                <input type="text" id="name" name="name" value="" class="form-control" placeholder="e.g Iphone 13 Pro Max" required>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="category_id">Select Category</label>
                                                                <select class="select2 form-control" name="category_id" id="category_id" required>
                												    <option value="">Select Category</option>
                												    <?php 
                												    foreach($categories as $row){
                                                                        
                                                                        if($row['level']==0){
                                                                            echo getOptions($row, $row['level']);
                                                                            foreach($categories as $row1){
                                                                                
                                                                                if($row1['level']==1 && $row1['parent_id'] == $row['id']){ 
                                                                                    echo getOptions($row1, $row1['level']);
                                                                                    foreach($categories as $row2){
                                                                                
                                                                                        if($row2['level']==2 && $row2['parent_id'] == $row1['id']){ 
                                                                                            echo getOptions($row2, $row2['level']);
                                                                                            
                                                                                        }
                                                                                        
                                                                                    } 
                                                                                }
                                                                                
                                                                            } 
                                                                                
                                                                        } 
                                                                    
                                                                    } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="brand_id">Select Brand</label>
                                                                <select class="select2 form-control" name="brand_id" id="brand_id" required>
                												    <option value="">Select Brand</option>
                												    <?php 
                												    foreach($brands as $row){
                                                                        
                                                                            echo getOptions($row, 1);
                                                                            
                                                                    } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                      
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="tags">Tags </label>
                                                                <input type="text" id="tags" name="tags" data-role="tagsinput"  class="form-control" placeholder="e.g mobile,mobilephones" required>
                                                            </div>
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        <!-- end row -->
                                        </div>
                                    </div> <!-- end card -->
                                </div>
                            </div> <!-- end row --> 
                            <div class="col-1"></div>
                        
                        
                    </div> 
                            <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">Product Images</div>
                                                <div class="row">
                                                    
                                                    <div class="col-12">
                                                        <div class="p-2">
                                                            
                                                                
                                                                <div class="mb-2 row">
                                                           
                                                                    <div class="col-md-12">
                                                                        <label class="col-form-label" for="gallery_images">Gallery Images (600x600)</label>
                                                                        <input type="file" class="form-control" name="gallery_images[]" accept=".jpg,.jpeg,.png,.gif"  id="gallery_images" multiple>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="mb-2 row">
                                                           
                                                                    <div class="col-md-12">
                                                                        <label class="col-form-label" for="thumbnail">Thumbnail (300x300)</label>
                                                                        <input type="file" class="form-control" name="thumbnail" accept=".jpg,.jpeg,.png,.gif" id="thumbnail" required>
                                                                    </div>
                                                                </div>
                                                                
                                                        </div>
                                                    </div>
                                                <!-- end row -->
                                                </div>
                                            </div> <!-- end card -->
                                        </div>
                                    </div> <!-- end row --> 
                                    <div class="col-1"></div>
                                
                                
                            </div> 
                            <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title">Product Variations</div>
                                                <div class="row">
                                                    
                                                    <div class="col-12">
                                                        <div class="p-2">
                                                            
                                                                
                                                                <div class="mb-2 row">
                                                                    <label class="col-3 col-form-label" for="choice_attributes">Select Attribute</label>
                                                                    <div class="col-md-9">
                                                                        
                                                                        <select class="select2 form-control" name="choice_attributes[]" id="choice_attributes" multiple>
                        												    
                        												    <?php 
                        												    foreach($attributes as $row){
                                                                                echo getOptions($row, 1);
                                                                            } ?>
                        												    
                        												</select>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <p>Choose the attributes of this product and then input values of each attribute</p>
                                                                    <br>
                                                                </div>
                                        
                                                                <div class="customer_choice_options" id="customer_choice_options">
                                        
                                                                </div>
                                                                
                                                        </div>
                                                    </div>
                                                <!-- end row -->
                                                </div>
                                            </div> <!-- end card -->
                                        </div>
                                    </div> <!-- end row --> 
                                    <div class="col-1"></div>
                                
                                
                            </div>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">Product Price</div>
                                            <div class="row">
                                                
                                                <div class="col-12">
                                                    <div class="p-2">
                                                        <div id="show-hide-div" >
                                                            <div class="mb-2 row" >
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="sku">SKU </label>
                                                                    <input type="text" id="sku" name="sku" value="" class="form-control" placeholder="e.g IPHONE-13-PRO-MAX" required>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="unit_price">Price </label>
                                                                    <input type="number" step="0.01"  id="unit_price" name="unit_price" value="" class="form-control" placeholder="e.g 1200" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="qty">Qty </label>
                                                                    <input type="number" step="1"  id="qty" name="qty" value="" class="form-control" placeholder="e.g 2" required>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="discount">Discount Price</label>
                                                                    <input type="number" step="0.01" id="discount" name="discount" value="0" class="form-control" placeholder="e.g 10">
                                                                </div>
                                                            </div>
                                                        </div>    
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="shipping_cost">Shipping Rate</label>
                                                                    <input type="number" step="0.01"id="shipping_cost" name="shipping_cost" value="0" class="form-control" placeholder="e.g 2" required>
                                                                </div>
                                                            </div>
                                                            
                                                            <br>
                                                            <div class="sku_combination" id="sku_combination">
                                    
                                                            </div>
                                                            
                                                           
                                                            
                                                    </div>
                                                </div>
                                            <!-- end row -->
                                            </div>
                                        </div> <!-- end card -->
                                    </div>
                                </div> <!-- end row --> 
                                <div class="col-1"></div>
                            </div> 
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">Product Description</div>
                                            <div class="row">
                                                
                                                <div class="col-12">
                                                    <div class="p-2">
                                                        
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="description">Description </label>
                                                                    <textarea style="width:100%" class="form-control" rows="7" name="description"></textarea>
                                                                    <!--<div id="snow-editor" style="height:300px"></div>-->
                                                                    <!--<input type="hidden" id="quill-html" name="description"/>-->
                                                                </div>
                                                            </div>
                                                           
                                                            
                                                    </div>
                                                </div>
                                            <!-- end row -->
                                            </div>
                                        </div> <!-- end card -->
                                    </div>
                                </div> <!-- end row --> 
                                <div class="col-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">SEO Meta Tags</div>
                                            <div class="row">
                                                
                                                <div class="col-12">
                                                    <div class="p-2">
                                                        
                                                            <div class="mb-2 row">
                                                           <div class="col-md-12">
                                                                 <label class="col-form-label" for="meta_title">Meta Title</label>
                                                                <input type="text" id="meta_title" name="meta_title" class="form-control" placeholder="Meta Title">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_description">Meta Description</label>
                                                                <textarea rows="4"  id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description"></textarea>
                                                            </div>
                                                        </div>
                                                           
                                                            
                                                    </div>
                                                </div>
                                            <!-- end row -->
                                            </div>
                                        </div> <!-- end card -->
                                    </div>
                                </div> <!-- end row --> 
                                <div class="col-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title">Other Settings</div>
                                            <div class="row">
                                                
                                                <div class="col-12">
                                                    <div class="p-2">
                                                        
                                                         <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="published">Publish status</label>
                                                                <select class="select2 form-control" name="published" id="published" required>
                												    <option value="1">Published</option>
                												    <option value="0">Un Published</option>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="featured">Featured status</label>
                                                                <select class="select2 form-control" name="featured" id="featured" required>
                												    <option value="1">Featured</option>
                												    <option value="0">Not Featured</option>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="text-end">
                                                                <input class="btn btn-primary waves-effect waves-light me-1" type="submit" name="submit" value="Save">
                                                            </div>
                                                        </div>
                                                           
                                                            
                                                    </div>
                                                </div>
                                            <!-- end row -->
                                            </div>
                                        </div> <!-- end card -->
                                    </div>
                                </div> <!-- end row --> 
                                <div class="col-1"></div>
                            </div>
                        </form>

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
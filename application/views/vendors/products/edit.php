<?php
function getOptions($row, $level, $selected){
    $html = '';
    
    if($selected==$row['id']){
        if($level==0){ 
        $html .= '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['id'].'" selected>&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }elseif($level==2){
            $html .= '<option value="'.$row['id'].'" selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    }else{
        if($level==0){ 
        $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }elseif($level==2){
            $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
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
</style>

                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Product</h4>
                                    
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
                                                                <input type="text" id="name" name="name" value="<?=$product['name']; ?>" class="form-control" placeholder="e.g Iphone 13 Pro Max" required>
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
                                                                            echo getOptions($row, $row['level'], $product['category_id']);
                                                                            foreach($categories as $row1){
                                                                                
                                                                                if($row1['level']==1 && $row1['parent_id'] == $row['id']){ 
                                                                                    echo getOptions($row1, $row1['level'], $product['category_id']);
                                                                                    foreach($categories as $row2){
                                                                                
                                                                                        if($row2['level']==2 && $row2['parent_id'] == $row1['id']){ 
                                                                                            echo getOptions($row2, $row2['level'], $product['category_id']);
                                                                                            
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
                                                                        
                                                                            echo getOptions($row, 1, $product['brand_id']);
                                                                            
                                                                    } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                      
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="tags">Tags </label>
                                                                <input type="text" id="tags" name="tags" data-role="tagsinput" value="<?=$product['tags'];?>"  class="form-control" placeholder="e.g mobile,mobilephones" required>
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
                                                            
                                                                <script>
                                                                    var images = [];
                                                                    <?php if($product['photos'] != '') {foreach(explode(',', $product['photos']) as $pic) { ?>
                                                                        images.push('<?=$pic;?>');
                                                                    <?php }} ?>
                                                                    function removePic(name, real_name){
                                                                        images = images.filter(item => item !== real_name)
                                                                        $("#old_gallery_images").val(images.join());
                                                                        var myobj = document.getElementById(name);
                                                                        myobj.remove();
                                                                    }
                                                                </script>
                                                                <div class="mb-2 row">
                                                           
                                                                    <div class="col-md-12">
                                                                        <label class="col-form-label" for="gallery_images">Gallery Images (600x600)</label>
                                                                        <input type="file" class="form-control" name="gallery_images[]" accept=".jpg,.jpeg,.png,.gif"  id="gallery_images" multiple>
                                                                        <input type="hidden" name="old_gallery_images" id="old_gallery_images" value="<?=$product['photos'];?>" />
                                                                        <div class="row" style="margin-top:10px">
                                                                            <?php if($product['photos'] != '') {foreach(explode(',', $product['photos']) as $pic){ ?>
                                                                            <div class="col-md-3" id="pic_id_<?=$pic;?>">
                                                                                <div class="imgUp">
                                                                                    <div class="imagePreview" style="<?php if($pic){ echo 'background-image: url('.base_url().'uploads/products/'.$pic.');'; } ?>"></div>
                                                                                    <label class="btn btn-upload btn-primary" onclick="removePic('pic_id_<?=$pic;?>', '<?=$pic;?>');">
                    										    			            Remove
                    				                                                </label>
                                                                                </div>
                                                                            </div>
                                                                            <?php }} ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="mb-2 row">
                                                                    
                                                                    <div class="col-md-12">
                                                                        <label class="col-form-label" for="thumbnail">Thumbnail (300x300)</label>
                                                                        <div class="imgUp">
                                                                            <div class="imagePreview" style="<?php if($product['thumbnail_img']!=''){ echo 'background-image: url('.base_url().'uploads/products/'.$product['thumbnail_img'].');'; } ?>"></div>
                                                                            <label class="btn btn-upload btn-primary">
            										    			            Change<input type="file" class="uploadFile img" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png,.gif" value="Change Photo" style="width: 0px;height: 0px;overflow: hidden;">
            				                                                </label>
                                                                        </div>
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
                        												    $product_attributes = json_decode($product['attributes']);
                        												    foreach($attributes as $row){
                        												        if(in_array($row['id'], $product_attributes)){
                                                                                    echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
                        												        }else{
                        												            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
                        												        }
                                                                            } ?>
                        												    
                        												</select>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <p>Choose the attributes of this product and then input values of each attribute</p>
                                                                    <br>
                                                                </div>
                                        
                                                                <div class="customer_choice_options" id="customer_choice_options">
                                                                     <?php foreach (json_decode($product['choice_options']) as $key => $choice_option){
                                                                     
                                                                     ?>
                                                                        <div class="form-group row">
                                                                            <div class="col-lg-3">
                                                                                <input type="hidden" name="choice_no[]" value="<?=$choice_option->attribute_id;?>">
                                                                                <input type="text" class="form-control" name="choice[]" value="<?=$this->db->query("select * from app_attributes where id='".$choice_option->attribute_id."'")->row()->name; ?>" placeholder="Choice Title" disabled>
                                                                            </div>
                                                                            <div class="col-lg-9">
                                                                                <select class="select2 form-control attribute_choice" data-live-search="true" name="choice_options_<?=$choice_option->attribute_id;?>[]" multiple>
                                                                                    <?php foreach ($this->db->query("select * from app_attribute_values where attribute_id='".$choice_option->attribute_id."'")->result() as $row){ ?>
                                                                                    <option value="<?=$row->value;?>" <?php if(in_array($row->value, $choice_option->values)){ echo 'selected';} ?>>
                                                                                        <?=$row->value;?>
                                                                                    </option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                                <!--{{-- <input type="text" class="form-control aiz-tag-input" name="choice_options_<?=$choice_option->attribute_id;?>[]" placeholder="{{ translate('Enter choice values') }}" value="{{ implode(',', $choice_option->values) }}" data-on-change="update_sku"> --}}-->
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
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
                                                        <?php
                                                        $product_stock = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$product['id']}'")->row_array(); ?>
                                                        <div id="show-hide-div" style="<?php if(count(json_decode($product['choice_options'])) > 0){echo 'display:none;';} ?>">
                                                            <div class="mb-2 row" >
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="sku">SKU </label>
                                                                    <input type="text" id="sku" name="sku" value="<?php if(count(json_decode($product['choice_options'])) == 0){echo $product_stock['sku'];} ?>" class="form-control" placeholder="e.g IPHONE-13-PRO-MAX" <?php if(count(json_decode($product['choice_options'])) == 0){echo 'required';} ?>>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="unit_price">Price </label>
                                                                    <input type="number" step="0.01"  id="unit_price" name="unit_price" value="<?php if(count(json_decode($product['choice_options'])) == 0){echo $product_stock['price'];} ?>" class="form-control" placeholder="e.g 1200" <?php if(count(json_decode($product['choice_options'])) == 0){echo 'required';} ?>>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="qty">Qty </label>
                                                                    <input type="number" step="1"  id="qty" name="qty" value="<?php if(count(json_decode($product['choice_options'])) == 0){echo $product_stock['qty'];} ?>" class="form-control" placeholder="e.g 2" <?php if(count(json_decode($product['choice_options'])) == 0){echo 'required';} ?>>
                                                                </div>
                                                            </div>
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="discount">Discount Price</label>
                                                                    <input type="number" step="0.01" id="discount" name="discount" value="<?php if(count(json_decode($product['choice_options'])) == 0){echo $product_stock['discount'];} ?>" class="form-control" placeholder="e.g 10">
                                                                </div>
                                                            </div>
                                                        </div>    
                                                            <div class="mb-2 row">
                                                                
                                                                <div class="col-md-12">
                                                                    <label class="col-form-label" for="shipping_cost">Shipping Rate</label>
                                                                    <input type="number" step="0.01"id="shipping_cost" name="shipping_cost" value="<?=$product['shipping_cost'];?>" class="form-control" placeholder="e.g 2" required>
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
                                                                    <textarea style="width:100%" class="form-control" rows="7" name="description"><?=$product['description'];?></textarea>
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
                                                                <input type="text" id="meta_title" name="meta_title" value="<?=$product['meta_title'];?>" class="form-control" placeholder="Meta Title">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_description">Meta Description</label>
                                                                <textarea rows="4"  id="meta_description" name="meta_description"  class="form-control" placeholder="Meta Description"><?=$product['meta_description'];?></textarea>
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
                												    <option value="1" <?php if($product['published'] == 1){ echo 'selected'; } ?>>Published</option>
                												    <option value="0" <?php if($product['published'] == 0){ echo 'selected'; } ?>>Un Published</option>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="featured">Featured status</label>
                                                                <select class="select2 form-control" name="featured" id="featured" required>
                												    <option value="1" <?php if($product['featured'] == 1){ echo 'selected'; } ?>>Featured</option>
                												    <option value="0" <?php if($product['featured'] == 0){ echo 'selected'; } ?>>Not Featured</option>
                												    
                												</select>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="text-end">
                                                                <input type="hidden" name="product_id" id="product_id" value="<?=$product['id'];?>" />
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
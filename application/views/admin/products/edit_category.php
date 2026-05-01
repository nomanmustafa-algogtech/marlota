<?php
function getOptions($row, $level, $sn, $pr_id){
    $html = '';
    if($pr_id == $row['id']){
        if($level==0){ 
        $html .= '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['id'].'" selected>&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    }else{
        if($level==0){ 
        $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }elseif($level==1){
            $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
        }
    }
    
    return $html;
}
?>
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
                                    <h4 class="page-title">Edit Category</h4>
                                    
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <div class="row">
                            <div class="col-12">
                                <?=$this->CI->flash_message();?>
                            </div>
                        </div>                   
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="parent_id">Select Parent Category</label>
                                                                <select class="select2 form-control" name="parent_id" id="parent_id" required>
                												    <option value="0">Select Parent Category</option>
                												    <?php 
                												    foreach($categories as $row){
                                                                        
                                                                        if($row['level']==0){
                                                                            echo getOptions($row, $row['level'], $sn, $category['parent_id']);
                                                                            foreach($categories as $row1){
                                                                                
                                                                                if($row1['level']==1 && $row1['parent_id'] == $row['id']){ 
                                                                                    echo getOptions($row1, $row1['level'], $sn, $category['parent_id']);
                                                                                    
                                                                                }
                                                                                
                                                                            } 
                                                                                
                                                                        } 
                                                                    
                                                                    } ?>
                												    
                												</select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="name">Name </label>
                                                                <input type="text" id="name" name="name" value="<?=$category['name'];?>" class="form-control" placeholder="e.g Toy" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="slug">Slug </label>
                                                                <input type="text" id="slug" name="slug" value="<?=$category['slug'];?>" class="form-control" placeholder="e.g toy" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="image">Image (200x200)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($category['image']!=''){ echo 'background-image: url('.base_url().'uploads/categories/'.$category['image'].');'; } ?>"></div>
                                                                    <label class="btn btn-upload btn-primary">
    										    			            Upload<input type="file" class="uploadFile img" name="image" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="icon">Icon (32x32)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($category['icon']!=''){ echo 'background-image: url('.base_url().'uploads/categories/'.$category['icon'].');'; } ?>"></div>
                                                                    <label class="btn btn-upload btn-primary">
    										    			            Upload<input type="file" class="uploadFile img" name="icon" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                           <div class="col-md-12">
                                                                 <label class="col-form-label" for="meta_title">Meta Title</label>
                                                                <input type="text" id="meta_title" name="meta_title" value="<?=$category['meta_title'];?>" class="form-control" placeholder="Meta Title">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_description">Meta Description</label>
                                                                <textarea rows="4"  id="meta_description" value="<?=$category['meta_description'];?>" name="meta_description" class="form-control" placeholder="Meta Description"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="text-end">
                                                                <input class="btn btn-primary waves-effect waves-light me-1" type="submit" name="submit" value="Save">
                                                            </div>
                                                        </div>
    
                                                        
    
                                                    </form>
                                                </div>
                                            </div>
    
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div> <!-- end card -->
                            </div>
                            <div class="col-3"></div>
                        </div> <!-- end row --> 
                        
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

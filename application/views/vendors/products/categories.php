<!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
<?php 
function getTable($row, $level, $sn){
    $html = '';
    $html .= '<tr id="'.$row['id'].'">';
    $html .= '<td>'.$row['id'].'</td>';
    if($level==0){ 
        $html .= '<td><a href="'.base_url().'admin/products/categories/?parent_id='.$row['id'].'">'.$row['name'].'</a></td>';
    }elseif($level==1){
        $html .= '<td><a href="'.base_url().'admin/products/categories/?parent_id='.$row['id'].'">'.$row['name'].'</a></td>';
    }elseif($level==2){
        $html .= '<td>'.$row['name'].'</td>';
    }
    $html .= '<td><img src="'.base_url().'uploads/categories/'.$row['image'].'" style="height: 50px;" /></td>';
    $html .= '    
        <td>
           
            <button type="button" onclick="window.location.href=\''.base_url().'admin/products/edit_category/'.$row['id'].'\';" class="btn btn-success btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-edit-box-line"></i></button>
            <button type="button" onclick="if(confirm(\'Are you sure you want to delete this category?\')){ window.location.href=\''.base_url().'admin/products/category_delete/'.$row['id'].'\'; }" class="btn btn-danger btn-bordered rounded-pill btn-xs waves-effect waves-light"><i class="ri-delete-bin-line"></i></button>
            
            
        </td>
    </tr>';
    return $html;
}
function getOptions($row, $level, $sn){
    $html = '';
    if($level==0){ 
        $html .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }elseif($level==1){
        $html .= '<option value="'.$row['id'].'">&nbsp;&nbsp;&nbsp;'.$row['name'].'</option>';
    }
    return $html;
}
?>        <div class="content-page">


                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">All Categories</h4>
                                    
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
                            <div class="col-7">
                                <div class="card">
                                    
                                    <div class="card-body">
                                        <h4 class="card-title"><?php if(isset($category_name)){ echo $category_name; }else{ echo 'Categories'; } ?> </h4>
                                        <table  class="table dt-responsive nowrap w-100 basic-datatable" id="categories_table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">#</th>
                                                                    <th width="45%">Name</th>
                                                                    <th width="25%">Logo</th>
                                                                    <th width="20%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                if($categories){
                                                                       
                                                                   foreach($categories as $row){
                                                                        
                                                                        
                                                                            $sn++ ;
                                                                            echo getTable($row, $row['level'], $sn);
                                                                                
                                                                       
                                                                    
                                                                    }
                                                                }else{ ?>
                                                                    <tr class="footable-empty"><td colspan="4"><i class="ri-spam-3-line" style="font-size:60px" aria-hidden="true"></i><br> Nothing Found</td></tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                        <!-- end accordion -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->
                            </div> <!-- end col -->
                            <div class="col-5">
                                <div class="card">
                                    <div class="card-body">
                                    <h4 class="card-title">Add Category</h4>
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
                                                                            echo getOptions($row, $row['level'], $sn);
                                                                            foreach($categories as $row1){
                                                                                
                                                                                if($row1['level']==1 && $row1['parent_id'] == $row['id']){ 
                                                                                    echo getOptions($row1, $row1['level'], $sn);
                                                                                    
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
                                                                <input type="text" id="name" name="name" class="form-control" placeholder="e.g Toy" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="slug">Slug </label>
                                                                <input type="text" id="slug" name="slug" class="form-control" placeholder="e.g toy" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="image">Image (200x200)</label>
                                                                <input type="file" class="form-control" name="image" accept="image/*" id="image" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="icon">Icon (32x32)</label>
                                                                <input type="file" class="form-control" name="icon" id="icon" required>
                                                            </div>
                                                        </div>
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
                            </div><!-- end col -->
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
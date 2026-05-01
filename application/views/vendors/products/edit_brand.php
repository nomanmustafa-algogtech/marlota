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
                                    <h4 class="page-title">Edit Brand</h4>
                                    
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
                                                                <label class="col-form-label" for="name">Name </label>
                                                                <input type="text" id="name" name="name" class="form-control" value="<?=$brand['name'];?>" placeholder="e.g Acer" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="logo">Logo (120x80)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($brand['logo']!=''){ echo 'background-image: url('.base_url().'uploads/brands/'.$brand['logo'].');'; } ?>"></div>
                                                                    <label class="btn btn-upload btn-primary">
    										    			            Upload<input type="file" class="uploadFile img" name="logo" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                           <div class="col-md-12">
                                                                 <label class="col-form-label" for="meta_title">Meta Title</label>
                                                                <input type="text" id="meta_title" name="meta_title" value="<?=$brand['meta_title'];?>" class="form-control" placeholder="Meta Title">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_description">Meta Description</label>
                                                                <textarea rows="4"  id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description"><?=$brand['meta_description'];?></textarea>
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
                                <?="&copy; 2014-".date('Y')." Ali Softtech. All Right Reserved"?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
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
                                    <h4 class="page-title">General Settings</h4>
                                    
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
                            <div class="col-2"></div>
                            <div class="col-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="p-2">
                                                    <form class="form-horizontal" role="form" action="" enctype="multipart/form-data" method="post">
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="site_title">Site Name </label>
                                                                <input type="text" id="site_title" name="site_title" class="form-control" value="<?=$site_title;?>" placeholder="e.g D Channel" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_title">Site Title </label>
                                                                <input type="text" id="meta_title" name="meta_title" class="form-control" value="<?=$meta_title;?>" placeholder="e.g D Channel Online Ecommerce Website" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="meta_description">Meta Description</label>
                                                                <textarea rows="4"  id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description"><?=$meta_description;?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="top_message">Top Message </label>
                                                                <input type="text" id="top_message" name="top_message" class="form-control" value="<?=$top_message;?>" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="copyright_message">Copyright Message </label>
                                                                <input type="text" id="copyright_message" name="copyright_message" class="form-control" value="<?=$copyright_message;?>" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="site_phone">Site Phone </label>
                                                                <input type="text" id="site_phone" name="site_phone" class="form-control" value="<?=$site_phone;?>" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="logo">Favicon (64x64)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($site_icon!=''){ echo 'background-image: url('.base_url().'uploads/settings/'.$site_icon.');'; } ?>"></div>
                                                                    <label class="btn btn-upload btn-primary">
    										    			            Upload<input type="file" class="uploadFile img" name="site_icon" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="logo">Logo (288x90)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($site_logo!=''){ echo 'background-image: url('.base_url().'uploads/settings/'.$site_logo.');'; } ?>width: 288px;height: 90px;"></div>
                                                                    <label class="btn btn-upload btn-primary" style="width: 288px">
    										    			            Upload<input type="file" class="uploadFile img" name="site_logo" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="logo">Logo Bottom (288x90)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="<?php if($site_logo_bottom!=''){ echo 'background-image: url('.base_url().'uploads/settings/'.$site_logo_bottom.');'; } ?>width: 288px;height: 90px;"></div>
                                                                    <label class="btn btn-upload btn-primary" style="width: 288px">
    										    			            Upload<input type="file" class="uploadFile img" name="site_logo_bottom" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
    				                                                </label>
                                                                </div>
                                                                
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
                            <div class="col-2"></div>
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

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
                                    <h4 class="page-title">Add Slider</h4>
                                    
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
                                                                <label class="col-form-label" for="title">Title </label>
                                                                <input type="text" id="title" name="title" class="form-control" value="" placeholder="" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="sub_title">Sub Title </label>
                                                                <input type="text" id="sub_title" name="sub_title" class="form-control" value="" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="text">Text </label>
                                                                <input type="text" id="text" name="text" class="form-control" value="" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="button_title">Button Title </label>
                                                                <input type="text" id="button_title" name="button_title" class="form-control" value="" placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="button_link">Button Link </label>
                                                                <input type="text" id="button_link" name="button_link" class="form-control" value="" placeholder="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="1" name="content_show" id="content_show">
                                                                    <label class="form-check-label" for="content_show">
                                                                        Content Show
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="mb-2 row">
                                                            
                                                            <div class="col-md-12">
                                                                <label class="col-form-label" for="image">Image (940x380)</label>
                                                                <div class="imgUp">
                                                                    <div class="imagePreview" style="width: 550px;height: 222px;"></div>
                                                                    <label class="btn btn-upload btn-primary" style="width: 550px">
    										    			            Upload<input type="file" class="uploadFile img" name="image" accept="image/*" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;" required>
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

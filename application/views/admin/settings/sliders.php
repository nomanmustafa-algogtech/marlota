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
                                    <h4 class="page-title">Slider List</h4>
                                    <div class="page-title-right">
                                        <button type="button" class="btn btn-success waves-effect waves-light" onclick="window.location.href='<?=base_url('admin/settings/add_slider');?>'">
                                               <span class="btn-label"><i class="mdi mdi-account-plus"></i></span> Add Slider
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
        
                        <div class="row">
                            <div class="col-xl-12">
                                <?=$this->CI->flash_message();?>
                                <div class="card">
                                    <div class="card-body">

                                        <table  class="table dt-responsive nowrap w-100 basic-datatable" id="products_table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="10%">Sn</th>
                                                                    <th>Title</th>
                                                                    <th width="15%">Action</th>
                                                                </tr>
                                                            </thead>
                                                        
                                                        
                                                            <tbody class="row_position">
                                                                <?php 
                                                                $sn = 0;
                                                                if($sliders){
                                                                foreach($sliders as $row){
                                                                   
                                                                $sn++ ;?>
                                                                <tr id="<?php echo $row['id']; ?>" style="cursor: move;">
                                                                    <td><?=$sn;?></td>
                                                                    <td><?=$row['title'];?></td>
                                                                    <td>
                                                                        
                                                                        <button type="button" onclick="window.location.href='<?=base_url();?>admin/settings/edit_slider/<?=$row['id'];?>';" class="btn btn-success btn-xs waves-effect waves-light">Edit</button>
                                                                        <a href="<?=base_url('admin/settings/delete_slider/'.$row['id']);?>" class="btn btn-danger btn-xs waves-effect waves-light" onclick="return confirm('Are you sure you want to delete this slider?')">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php }}else{ ?>
                                                                    <tr class="footable-empty"><td colspan="3"><i class="ri-spam-3-line" style="font-size:60px" aria-hidden="true"></i><br> Nothing Found</td></tr>
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
                                <?= "&copy; " . date('Y') . ' <a href="https://abbasstechnologies.com/">Abbas Technologies</a> . All Rights Reserved'; ?> 
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->
            <script>
           document.addEventListener("DOMContentLoaded", function(event) {
                 $( ".row_position" ).sortable({
                    delay: 150,
                    stop: function() {
                        var selectedData = new Array();
                        $('.row_position>tr').each(function() {
                            selectedData.push($(this).attr("id"));
                        });
                        updateOrder(selectedData);
                    }
                });
            });
               
                
                function updateOrder(data) {
                    console.log('Data', data);
                        $.ajax({
                            url:"<?=base_url();?>admin/settings/reOrderSliders",
                            type:'post',
                            data:{position:data},
                            success:function(res){
                                console.log(res);
                                // new Noty({ text : 'Data has been saved.', timeout: 15000, layout: 'bottomRight', theme : 'metroui', type: 'success', killer: true }).show();
                            }
                        })
                    }
            </script>
            </div>

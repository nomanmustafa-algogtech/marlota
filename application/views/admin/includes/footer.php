 </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
        
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>
        <input type="hidden" id="base_url" value="<?=base_url();?>" />
        <!-- Vendor js -->
        <?php $this->load->view('admin/includes/layouts.js.php'); ?>
        
        <script>
            $(function() {
    $(document).on("change",".uploadFile", function()
    {
    		var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
 
            reader.onloadend = function(){ // set image data as background of div
                //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
            }
        }
      
    });
});

$("#select_all").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});
$(function() {
    $('input[type="checkbox"]').change(function(){
		var numberNotChecked = $('input[name="orderid[]"]').filter(':checked').length;
		$("#ocount").html(numberNotChecked);
    });
});
$(document).ready(function() {
    let myTable = $('#products_table_check').DataTable({
        columnDefs: [{
            orderable: false,
            className: 'select-checkbox',
            targets: 0,
        }],
        select: {
            style: 'os', // 'single', 'multi', 'os', 'multi+shift'
            selector: 'td:first-child',
        },
        order: [
            [1, 'asc'],
        ],
    });

    $('#MyTableCheckAllButton').click(function() {
        if (myTable.rows({
                selected: true
            }).count() > 0) {
            myTable.rows().deselect();
            return;
        }

        myTable.rows().select();
    });

    myTable.on('select deselect', function(e, dt, type, indexes) {
        if (type === 'row') {
            // We may use dt instead of myTable to have the freshest data.
            if (dt.rows().count() === dt.rows({
                    selected: true
                }).count()) {
                // Deselect all items button.
                $('#MyTableCheckAllButton i').attr('class', 'far fa-check-square');
                return;
            }

            if (dt.rows({
                    selected: true
                }).count() === 0) {
                // Select all items button.
                $('#MyTableCheckAllButton i').attr('class', 'far fa-square');
                return;
            }

            // Deselect some items button.
            $('#MyTableCheckAllButton i').attr('class', 'far fa-minus-square');
        }
        
        var id_list = $.map(myTable.rows('.selected').nodes(), function (item) {
        return $(item).attr("id");
    });
    
    $("#product_ids").val(id_list.toString());
    console.log(id_list);
    });
    
    
});
 $('#categories_table').DataTable({
    order: [
        [1, 'asc'],
    ],
    "pageLength": 50,
});

        </script>
    </body>

</html>
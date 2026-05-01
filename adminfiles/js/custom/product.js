var base_url = $("#base_url").val();
var product_id = $("#product_id").val();
$("#products_table").DataTable();
function update_sku(){
        $.ajax({
           type:"POST",
           url:base_url+'admin/products/sku_combination',
           data:$('#choice_form').serialize(),
           success: function(data) {
                $('#sku_combination').html(data);
                console.log(data);
                if (data.length > 1) {
                      $('#show-hide-div').hide();
                      $("#sku").removeAttr("required");
                      $("#unit_price").removeAttr("required");
                      $("#qty").removeAttr("required");
                }
                else {
                    $('#show-hide-div').show();
                    $("#sku").attr("required","required");
                    $("#unit_price").attr("required","required");
                    $("#qty").attr("required","required");
                }
           }
       });
    
}

function update_edit_sku(id){
        $.ajax({
           type:"POST",
           url:base_url+'admin/products/edit_sku_combination/'+id,
           data:$('#choice_form').serialize(),
           success: function(data) {
                $('#sku_combination').html(data);
                console.log(data);
                if (data.length > 1) {
                      $('#show-hide-div').hide();
                      $("#sku").removeAttr("required");
                      $("#unit_price").removeAttr("required");
                      $("#qty").removeAttr("required");
                }
                else {
                    $('#show-hide-div').show();
                    $("#sku").attr("required","required");
                    $("#unit_price").attr("required","required");
                    $("#qty").attr("required","required");
                }
           }
       });
    
}

var quill = new Quill('#snow-editor', {
    theme: 'snow',
    modules: {
        'toolbar': [[{ 'font': [] }, { 'size': [] }], ['bold', 'italic', 'underline', 'strike'], [{ 'color': [] }, { 'background': [] }], [{ 'script': 'super' }, { 'script': 'sub' }], [{ 'header': [false, 1, 2, 3, 4, 5, 6] }, 'blockquote', 'code-block'], [{ 'list': 'ordered' }, { 'list': 'bullet' }, { 'indent': '-1' }, { 'indent': '+1' }], ['direction', { 'align': [] }], ['link', 'image', 'video'], ['clean']]
    },
});

 $(document).ready(function(){
      $("#choice_form").on("submit", function(event){
        //   event.preventDefault();
            var html = quill.root.innerHTML;
            // Copy HTML content in hidden form
            // $('#quill-html').val(html);
            $('#quill-html').val(html);  
            console.log($('#quill-html').val());
            // return false;

       });
       
});



$(document).on("change", ".attribute_choice",function() {
    if(product_id==undefined){
        update_sku();
    }else{
        update_edit_sku(product_id);
    }
        
});
function add_more_customer_choice_option(i, name){
        $.ajax({
            type:"POST",
            url:base_url+'admin/products/get_more_choice_option',
            data:{
               attribute_id: i
            },
            success: function(data) {
                console.log(data);
                var obj = JSON.parse(data);
                $('#customer_choice_options').append('\
                <div class="mb-2 row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly>\
                    </div>\
                    <div class="col-md-9">\
                        <select class="select2 form-control attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" id="choice_options_'+ i +'" multiple required>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                // AIZ.plugins.bootstrapSelect('refresh');
                $('#choice_options_'+ i).select2();
                update_sku();
           }
       });
    

}

function add_more_edit_customer_choice_option(i, name, pid){
        $.ajax({
            
            type:"POST",
            url:base_url+'admin/products/get_more_edit_choice_option',
            data:{
               attribute_id: i,
               product_id: pid
            },
            success: function(data) {
                console.log(data);
                var obj = JSON.parse(data);
                $('#customer_choice_options').append('\
                <div class="mb-2 row">\
                    <div class="col-md-3">\
                        <input type="hidden" name="choice_no[]" value="'+i+'">\
                        <input type="text" class="form-control" name="choice[]" value="'+name+'" placeholder="Choice Title" readonly>\
                    </div>\
                    <div class="col-md-9">\
                        <select class="select2 form-control attribute_choice" data-live-search="true" name="choice_options_'+ i +'[]" id="choice_options_'+ i +'" multiple required>\
                            '+obj+'\
                        </select>\
                    </div>\
                </div>');
                // AIZ.plugins.bootstrapSelect('refresh');
                $('#choice_options_'+ i).select2();
                update_edit_sku(pid);
           }
       });
    

}
$('#choice_attributes').on('change', function() {
        $('#customer_choice_options').html("");
        $.each($("#choice_attributes option:selected"), function(){
                    console.log(product_id);
            if(product_id==undefined){
                add_more_customer_choice_option($(this).val(), $(this).text());
            }else{
                add_more_edit_customer_choice_option($(this).val(), $(this).text(), product_id);
            }
            
        });

        if(product_id==undefined){
            update_sku();
        }else{
            update_edit_sku(product_id);
        }
});

    
    
    
$(function() {
    if(product_id!=undefined){
        $.each($("#choice_attributes option:selected"), function(){
            update_edit_sku(product_id);
        });
        
    }
    
});
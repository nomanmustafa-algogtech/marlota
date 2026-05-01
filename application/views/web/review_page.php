<style>
                                .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    /*position:absolute;*/
    /*top:-9999px;*/
    display:none;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
                            </style>
<div class="login-popup">
    <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
        <ul class="nav nav-tabs text-uppercase" role="tablist">
            <li class="nav-item">
                <a href="#review-sec" class="nav-link active">Write a Review</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="review-sec">
                <?php $check_order = $this->db->query("SELECT * FROM app_order_details where user_id = '$user_id' && order_id = '$order_id' && product_id = '$product_id'")->num_rows();
                if($check_order > 0){
                $check_review = $this->db->query("SELECT * FROM app_product_reviews WHERE user_id = '$user_id' && order_id = '$order_id' && product_id = '$product_id'")->num_rows();
                if($check_review > 0){?>
                <div class="col-md-12">
                                  <div class="alert alert-error alert-bg alert-inline show-code-action" >You have already submitted review for this product.</div>              
                </div>
                <?php }else{ ?>
                <div class="col-md-12">
                                                <div class="review-form-wrapper">
                                                    <form action="<?=base_url('products/addreview');?>" method="post" class="review-form">
                                                        <div class="rating-form">
                                                            <label for="rating">Your Rating Of This Product :</label>
                                                           <div class="rate">
                                                            <input type="radio" id="star5" name="rate" value="5" />
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" id="star4" name="rate" value="4" />
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" name="rate" value="3" />
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" name="rate" value="2" />
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" name="rate" value="1" />
                                                            <label for="star1" title="text">1 star</label>
                                                          </div>
                                                        </div>
                                                        <textarea cols="30" rows="6"
                                                            placeholder="Write Your Review Here..." class="form-control"
                                                            id="review" name="comment"></textarea>
                                                            <br>
                                                            <input type="hidden" name="order_id" value="<?=$order_id;?>" />
                                                            <input type="hidden" name="product_id" value="<?=$product_id;?>" />
                                                        <button type="submit" class="btn btn-dark">Submit
                                                            Review</button>
                                                    </form>
                                                </div>
                                            </div>
                 
                <?php }} ?>
            </div>
        </div>
    </div>
</div>
<?php 
$settingsd = $this->db->select("*")->from('app_settings')->get()->result_array();
foreach($settingsd as $row){
    $settings[$row['name']] = $row['value'];
}
if($this->session->userdata('user_loggedin')){
 $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array();   
}
?>

<!-- ==================== MARLOTA FOOTER ==================== -->
<footer class="marlota-footer">
    <div class="container">
        <div class="row">
            <!-- Col 1: Logo + tagline + social -->
            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <a href="<?=base_url();?>">
                    <img src="<?= base_url(); ?>uploads/settings/<?=$this->settings['site_logo'];?>"
                         alt="<?=$settings['site_title'];?>"
                         class="footer-logo footer-logo-large" />
                </a>
                <p class="footer-tagline">Your trusted partner for premium packaging, labels, and office essentials.</p>
                <div class="footer-social">
                    <a href="https://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                    <a href="https://www.instagram.com/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <p class="footer-col-title">Quick Links</p>
                <ul class="footer-links">
                    <li><a href="<?=base_url();?>">Home</a></li>
                    <li><a href="<?=base_url('products');?>">Products</a></li>
                    <li><a href="<?=base_url('about');?>">About Us</a></li>
                    <li><a href="<?=base_url('contact');?>">Contact Us</a></li>
                </ul>
            </div>

            <!-- Col 3: Customer Service -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <p class="footer-col-title">Customer Service</p>
                <ul class="footer-links">
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns &amp; Refunds</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="<?=base_url();?>privacy_policy">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Col 4: Contact Info -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <p class="footer-col-title">Contact Info</p>
                <div class="footer-contact-item">
                    <span class="fc-icon"><i class="fa fa-map-marker"></i></span>
                    <span><?= !empty($settings['site_address']) ? $settings['site_address'] : 'Manchester, United Kingdom'; ?></span>
                </div>
                <div class="footer-contact-item">
                    <span class="fc-icon"><i class="fa fa-envelope"></i></span>
                    <span><?= !empty($settings['site_email']) ? $settings['site_email'] : 'support@marlota.co.uk'; ?></span>
                </div>
                <div class="footer-contact-item">
                    <span class="fc-icon"><i class="fa fa-phone"></i></span>
                    <span><?=$settings['site_phone'];?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom Bar -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <p>&copy; <?= date('Y'); ?> Marlota Limited. All Rights Reserved.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p>VAT No: GB123 4567 89</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End of Marlota Footer -->

    </div>
    <!-- End of Page-wrapper-->

    <!-- Start of Sticky Footer -->
    <div class="sticky-footer sticky-content fix-bottom">
        <a href="<?=base_url();?>" class="sticky-link active">
            <i class="w-icon-home"></i>
            <p>Home</p>
        </a>
        <?php if($this->session->userdata('user_loggedin')){ ?>
                <a href="<?=base_url('user/account');?>" class="sticky-link">
                    <i class="w-icon-account"></i>
                    <p>My Account</p>
                </a>
        <?php }else{ ?>
                <a href="javascript:void(0);" class="sticky-link login sign-in-click">
                    <i class="w-icon-account"></i>
                    <p>My Account</p>
                </a>
        
        <?php } ?>
       
        <div class="cart-dropdown dir-up">
            <a href="#" class="sticky-link">
                <i class="w-icon-cart"></i>
                <p>Cart</p>
            </a>
        </div>

        <div class="header-search hs-toggle dir-up">
            <a href="#" class="search-toggle sticky-link">
                <i class="w-icon-search"></i>
                <p>Search</p>
            </a>
            <form action="<?=base_url();?>products/" method="get" class="input-wrapper">
                <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    required />
                <button class="btn btn-search" type="submit">
                    <i class="w-icon-search"></i>
                </button>
            </form>
        </div>
    </div>
    <!-- End of Sticky Footer -->

    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button">
        <i class="fa fa-chevron-up"></i>
    </a>
    <!-- End of Scroll Top -->

    <!-- Start of Mobile Menu -->
    <div class="mobile-menu-wrapper">
        <div class="mobile-menu-overlay"></div>
        <!-- End of .mobile-menu-overlay -->

        <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
        <!-- End of .mobile-menu-close -->

        <div class="mobile-menu-container scrollable">
            <div class="tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a href="#categories" class="nav-link">Categories</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane active" id="categories">
                    <ul class="mobile-menu">
                        <?php 
                                        $cat0 = $this->db->query("SELECT t2.* FROM app_categories t2 WHERE t2.level=0 ORDER BY (SELECT COUNT( * ) FROM  app_categories t1 WHERE t1.parent_id = t2.id) DESC LIMIT 0,12")->result_array();
                                        foreach($cat0 as $row0){  ?>
                                        
                                        <li>
                                            <a href="<?=base_url();?>products/?category=<?=$row0['slug']; ?>">
                                                <img src="<?=base_url();?>/uploads/categories/<?=$row0['icon']; ?>" alt="<?=$row0['name']; ?>" class="footer-mobile-cat-icon"/> <?=$row0['name']; ?>
                                            </a>
                                            <?php $cat1 = $this->db->query("SELECT * FROM app_categories WHERE level=1 && parent_id = '{$row0['id']}'")->result_array();
                                            if(count($cat1) > 0) {?>
                                                        <ul>
                                                            <?php foreach($cat1 as $row1){  ?>
                                                            <li><a href="<?=base_url();?>products/?category=<?=$row1['slug']; ?>"><?=$row1['name']; ?></a>
                                                            </li>
                                                            <?php } ?>
                                                            
                                                        </ul>
                                                    
                                            <?php } ?>
                                        </li>
                                        
                                        <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Mobile Menu -->

    <!-- Start of Newsletter popup -->
    <div class="newsletter-popup mfp-hide">
        <div class="newsletter-content">
            <h4 class="text-uppercase font-weight-normal ls-25">Get Up to<span class="text-primary">25% Off</span></h4>
            <h2 class="ls-25">Sign up to Marlota</h2>
            <p class="text-light ls-10">Subscribe to the Marlota newsletter to receive updates on special offers.</p>
            <form action="#" method="get" class="input-wrapper input-wrapper-inline input-wrapper-round">
                <input type="email" class="form-control email font-size-md" name="email" id="email2"
                    placeholder="Your email address" required="">
                <button class="btn btn-dark" type="submit">SUBMIT</button>
            </form>
            <div class="form-checkbox d-flex align-items-center">
                <input type="checkbox" class="custom-checkbox" id="hide-newsletter-popup" name="hide-newsletter-popup"
                    required="">
                <label for="hide-newsletter-popup" class="font-size-sm text-light">Don't show this popup again.</label>
            </div>
        </div>
    </div>
   <style>
        /* Sticky Circular Button Style */
        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #25D366;
            color: white;
            font-size: 16px;
            font-weight: bold;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-decoration: none;
            border-radius: 50%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .whatsapp-button:hover {
            background-color: #20b954;
        }
    </style>
   
    <!-- Sticky Circular WhatsApp Button -->
    <a 
        href="https://wa.me/+44 7448 484949?text=Hello%20I%20want%20to%20know%20more!" 
        target="_blank" 
        class="whatsapp-button">
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" class="footer-mobile-cat-icon">
    </a>
    <!-- End of Newsletter popup -->

    <!-- Start of Quick View -->
    <!-- End of Quick view -->

    <!-- Plugin JS File -->
    <?php $this->load->view('frontend/layouts/layouts.js.php'); ?>
    
    
   
    <script>
    
    function resetpassword(){
        $(".preloader").show();
        var form = $("#forgot-password-form");
        
        $("#sendpassword").html('Submitting.....');
        $("#sendpassword").attr("disabled", "disabled");
                
                
                $.ajax({
                      type: "POST",
                      url: '<?=base_url();?>/authentication/sendpassword/',
                      data: form.serialize(), // serializes the form's elements.
                      success: function(data)
                      {
                          $(".preloader").hide();
                          $("#sendpassword").html('Verify Account');
                          $("#sendpassword").removeAttr("disabled");
                          if(data=='SUCCESS'){
                              form.trigger("reset");
                              $("#reset-success").html("New password has been sent to your registerd email address.");
                              $("#reset-success").show();
                              form.hide();
                              
                              setTimeout(function() {
                                  $('#reset-success').fadeOut(400);
                                  $("#forgot-password").removeClass("active");
                                  $("#sign-in").addClass("active");
                                    form.show();
                                    
                              }, 5000);
                          }else{
                              $("#reset-error").html(data);
                              $("#reset-error").show();
                              setTimeout(function() {
                                    $('#reset-error').fadeOut(400);
                              }, 5000);
                          }
                          
                      }
                });
            
        
       return false;
    }
    
    function otpverify(){
        $(".preloader").show();
        var form = $("#otp-form");
        
        $("#verifyOtp").html('Verifying.....');
        $("#verifyOtp").attr("disabled", "disabled");
                
                
                $.ajax({
                      type: "POST",
                      url: '<?=base_url();?>/authentication/verify_otp/',
                      data: form.serialize(), // serializes the form's elements.
                      success: function(data)
                      {
                          $(".preloader").hide();
                          $("#verifyOtp").html('Verify Account');
                          $("#verifyOtp").removeAttr("disabled");
                          if(data=='SUCCESS'){
                              form.trigger("reset");
                              $("#sign-up-form").trigger("reset");
                              $("#otp-success").html("Your account has been created. Logging.....");
                              $("#otp-success").show();
                              $("#otp-form").hide();
                              setTimeout(function() {
                                    window.location.href='<?=base_url();?>user/account';
                              }, 5000);
                          }else{
                              $("#otp-error").html(data);
                              $("#otp-error").show();
                              setTimeout(function() {
                                    $('#otp-error').fadeOut(400);
                              }, 5000);
                          }
                          
                      }
                });
            
        
       return false;
    }
    
    function changeSignupText(text){
        if(text.length > 0 && text != ''){
            $("#btnSignup").html('Sign Up');
        }else{
            $("#btnSignup").html('Sign Up Without Referral');
        }
        
    }
    
    function register() {
        $(".preloader").show();
        var form = $("#sign-up-form");
        
        $("#btnSignup").html('Creating Account.....');
        $("#btnSignup").attr("disabled", "disabled");
                
                
                $.ajax({
                      type: "POST",
                      url: '<?=base_url();?>/authentication/register/',
                      data: form.serialize(), // serializes the form's elements.
                      success: function(data)
                      {
                          $(".preloader").hide();
                          $("#btnSignup").html('Sign Up');
                          $("#btnSignup").removeAttr("disabled");
                          if(data=='SUCCESS'){
                              $("#email-otp").html($("#email-register").val());
                              $("#sign-up").removeClass("active");
                              $("#otp-section").addClass("active");
                          }else{
                              $("#sign-up-error").html(data);
                              $("#sign-up-error").show();
                              setTimeout(function() {
                                    $('#sign-up-error').fadeOut(400);
                              }, 5000);
                          }
                          
                      }
                });
            
        
       return false;
    }
    
    function login() {
        $(".preloader").show();
        var form = $("#sign-in-form");
        
        $.ajax({
              type: "POST",
              url: '<?=base_url();?>/authentication/login/',
              data: form.serialize(), // serializes the form's elements.
              success: function(data)
              {
                  $(".preloader").hide();
                  if(data=='SUCCESS'){
                      $("#sign-in-success").html("Logged in successfully. Redirecting...");
                      $("#sign-in-success").show();
                      setTimeout(function() {
                            window.location.href='<?=base_url();?>user/account';
                      }, 3000);
                  }else{
                      $("#sign-in-error").html(data);
                      $("#sign-in-error").show();
                      setTimeout(function() {
                            $('#sign-in-error').fadeOut(400);
                      }, 5000);
                  }
                  
              }
        });
       return false;
    }
    
    function reviewproduct(sn, order_id, product_id){
        var query = '?sn='+sn+'&order_id='+order_id+'&product_id='+product_id;
        if (typeof Wolmart !== 'undefined') {
            Wolmart.popup({items:{src:'<?=base_url();?>products/review_page'+query}},"login");
        }
    }
    
    
    
    $(".sign-in-click").click(function(){
      if (typeof Wolmart !== 'undefined') Wolmart.popup({items:{src:'<?=base_url();?>authentication'}},"login");
    });
    $(".register-click").click(function(){
      if (typeof Wolmart !== 'undefined') Wolmart.popup({items:{src:'<?=base_url();?>authentication'},callbacks:{ajaxContentAdded:function(){this.wrap.find('[href="#sign-up"]').click()}}},"login");
    });
    
    
if (typeof Wolmart !== 'undefined') Wolmart.$body.on("click", ".product:not(.product-select) .btn-cart, .product-popup .btn-cart, .home .product-single .btn-cart", (function(e) {
e.preventDefault();
var i = $(this),
a = i.closest(".product, .product-popup");
i.hasClass("disabled") ? alert("Please select some product options before adding this product to your cart.") : (i.toggleClass("added").addClass("load-more-overlay loading"), setTimeout((function() {
var product_id = $("#product_id").val();
var qty = $("#user_qty").val();
var regex = /[+-]?\d+(\.\d+)?/g;
var price = $("#product-price .new-price").html().match(regex).map(function(v) { return parseFloat(v); }); 

var cart_old_total = $(".cart-total .price").html().match(regex).map(function(v) { return parseFloat(v); });
if (parseInt(qty) < 10) {
alert("Minimum order quantity is 10. Please select at least 10 products.");
i.removeClass("load-more-overlay loading");
return;
}

var formdata = $("#choice_options_form").serialize();

formdata += '&product_id='+product_id+'&qty='+qty;

$.ajax({
type:"POST",
url:'<?=base_url();?>products/add_to_cart/',
data:formdata,
success: function(data) {

if(data == 'ERROR_QTY'){
alert('Product qty must be equal or less than available qty.');
i.removeClass("load-more-overlay loading");
}else{
console.log(data);
var oldcart = parseInt($(".cart-count").html());

$(".cart-count").html((oldcart+1));
$(".cart-total .price").html("£ "+(parseInt(cart_old_total)+(parseInt(price)*qty)))
$(".cart-dropdown .products").append('<div class="product product-cart"><div class="product-detail"><a href="<?=base_url();?>products/view/'+$("#product-slug").val()+'" class="product-name">'+a.find(".product-name, .product-title").text()+'</a><div class="price-box"><span class="product-quantity">'+qty+'</span><span class="product-price">£ '+price+'</span></div></div><figure class="product-media"><a href="<?=base_url();?>products/view/'+$("#product-slug").val()+'"><img src="'+a.find(".product-media img, .product-image:first-child img").attr("src")+'" alt="'+a.find(".product-name, .product-title").text()+'" height="84" width="94" /></a></figure></div>');
i.removeClass("load-more-overlay loading");
if (typeof Wolmart !== 'undefined') Wolmart.Minipopup.open({
productClass: " product-cart",
name: a.find(".product-name, .product-title").text(),
nameLink: a.find(".product-name > a, .product-title > a").attr("href"),
imageSrc: a.find(".product-media img, .product-image:first-child img").attr("src"),
imageLink: a.find(".product-name > a").attr("href"),
message: "<p>has been added to cart:</p>",
actionTemplate: '<a href="<?=base_url();?>cart" class="btn btn-rounded btn-sm">View Cart</a><a href="<?=base_url();?>checkout" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
})
}
}
});



}), 500))
}));
                    
                  
    
</script>

<script>
    // Scroll-to-top button visibility
    var scrollTopBtn = document.getElementById('scroll-top');
    if (scrollTopBtn) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
    }
</script>

</body>


</html>

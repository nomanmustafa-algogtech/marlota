<?php 
$settingsd = $this->db->select("*")->from('app_settings')->get()->result_array();
foreach($settingsd as $row){
    $settings[$row['name']] = $row['value'];
}
if($this->session->userdata('user_loggedin')){
 $userData = $this->db->select('*')->from('app_users')->where('id', $this->session->userdata('user_id'))->get()->row_array();   
}
?>
<footer class="footer appear-animate" data-animation-options="{
            'name': 'fadeIn'
        }">
            <div class="footer-newsletter bg-primary">
                <div class="container">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-xl-5 col-lg-6">
                            <div class="icon-box icon-box-side text-white">
                                <div class="icon-box-icon d-inline-flex">
                                    <i class="w-icon-envelop3"></i>
                                </div>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title text-white text-uppercase font-weight-bold">Subscribe To
                                        Our Newsletter</h4>
                                    <p class="text-white">Get all the latest information on Events, Sales and Offers.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6 col-md-9 mt-4 mt-lg-0 ">
                            <form action="#" method="get"
                                class="input-wrapper input-wrapper-inline input-wrapper-rounded">
                                <input type="email" class="form-control mr-2 bg-white" name="email" id="email"
                                    placeholder="Your E-mail Address" />
                                <button class="btn btn-dark btn-rounded" type="submit">Subscribe<i
                                        class="w-icon-long-arrow-right"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="footer-top">
                    <div class="row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="widget widget-about">
                                <a href="<?=base_url();?>" class="logo-footer">
                                    <img src="<?= base_url(); ?>uploads/settings/<?=$this->settings['site_logo'];?>" alt="<?=$settings['site_title'];?>" width="144"
                                        height="45" />
                                </a>
                                <div class="widget-body">
                                    <p class="widget-about-title">Got Question? Call us 24/7</p>
                                    <a href="tel:<?=$settings['site_phone'];?>" class="widget-about-call"><?=$settings['site_phone'];?></a>
                                    <p class="widget-about-desc">Register now to get updates</p>

                                    <div class="social-icons social-icons-colored">
                                        <a href="https://www.facebook.com/beatersonline/" target="_blank" class="social-icon social-facebook w-icon-facebook"></a>
                                        <a href="https://www.instagram.com/beatersonlineshopping/" target="_blank" class="social-icon social-instagram w-icon-instagram"></a>
                                        <a href="https://youtube.com/channel/UCrHlbKMM9BGkXyfxE6lDjpA" target="_blank" class="social-icon social-youtube w-icon-youtube"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h3 class="widget-title">Company</h3>
                                <ul class="widget-body">
                                    <li><a href="<?=base_url('web/about');?>">About Us</a></li>
                                    <li><a href="<?=base_url('web/contact');?>">Contact Us</a></li>
                                    <li><a href="<?=base_url('web/career');?>">Career</a></li>
                                    <li><a href=""<?=base_url('web/contact');?>"">Contact Us</a></li>
                                    <li><a href="#">Affilate</a></li>
                                    <li><a href="#">Order History</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <ul class="widget-body">
                                    <li><a href="#">Track My Order</a></li>
                                    <li><a href="#">View Cart</a></li>
                                    <li><a href="#">Sign In</a></li>
                                    <li><a href="#">Help</a></li>
                                    <li><a href="#">My Wishlist</a></li>
                                    <li><a href="<?=base_url();?>privacy_policy">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>
                                <ul class="widget-body">
                                    <li><a href="#">Payment Methods</a></li>
                                    <li><a href="#">Money-back guarantee!</a></li>
                                    <li><a href="#">Product Returns</a></li>
                                    <li><a href="#">Support Center</a></li>
                                    <li><a href="#">Shipping</a></li>
                                    <li><a href="#">Term and Conditions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="footer-bottom">
                    <div class="footer-left">
                        <p class="copyright"><?=$settings['copyright_message'];?> - Developed by <a href="https://oxijan.co.uk/" target="_blank">oxijan.co.uk</a></p>
                    </div>
                    <div class="footer-right">
                        <span class="payment-label mr-lg-8">We're using safe payment for</span>
                        <figure class="payment">
                            <img src="<?=base_url();?>webfiles/images/payment.png" alt="Payment Methods" width="159" height="25" />
                        </figure>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->
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
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
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
                                                <img src="<?=base_url();?>/uploads/categories/<?=$row0['icon']; ?>" alt="<?=$row0['name']; ?>" style="width:1.5rem;height:1.5rem"/> <?=$row0['name']; ?>
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
            <h2 class="ls-25">Sign up to Beaters</h2>
            <p class="text-light ls-10">Subscribe to the Beaters market newsletter to
                receive updates on special offers.</p>
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
            bottom: 20px; /* Distance from the bottom */
            right: 20px; /* Distance from the right */
            background-color: #25D366;
            color: white;
            font-size: 16px;
            font-weight: bold;
            width: 60px; /* Button width */
            height: 60px; /* Button height */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            text-decoration: none;
            border-radius: 50%; /* Makes the button circular */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000; /* Ensure it's above other elements */
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
        <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" style="width: 30px; height: 30px;">
    </a>
    <!-- End of Newsletter popup -->

    <!-- Start of Quick View -->
    <!-- End of Quick view -->

    <!-- Plugin JS File -->
    <?php $this->load->view('web/includes/layouts.js.php'); ?>
    
    
   
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
                            //   form.trigger("reset");
                            //   $("#sign-up-success").html("Your account has been created. Please verify your email to signin.");
                            //   $("#sign-up-success").show();
                              $("#email-otp").html($("#email-register").val());
                            //   $("#phone-otp").html($("#phone-register").val());
                              $("#sign-up").removeClass("active");
                              $("#otp-section").addClass("active");
                            //   setTimeout(function() {
                            //         window.location.href='<?=base_url();?>user/account';
                            //   }, 15000);
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
        var query = '?sn='+sn+'&order_id='+order_id+'&product_id='+product_id
        Wolmart.popup({items:{src:'<?=base_url();?>products/review_page'+query}},"login");
    }
    
    
    
    $(".sign-in-click").click(function(){
      Wolmart.popup({items:{src:'<?=base_url();?>authentication'}},"login");
    });
    $(".register-click").click(function(){
      Wolmart.popup({items:{src:'<?=base_url();?>authentication'},callbacks:{ajaxContentAdded:function(){this.wrap.find('[href="#sign-up"]').click()}}},"login")
    });
    
    
	Wolmart.$body.on("click", ".product:not(.product-select) .btn-cart, .product-popup .btn-cart, .home .product-single .btn-cart", (function(e) {
		e.preventDefault();
		var i = $(this),
			a = i.closest(".product, .product-popup");
		i.hasClass("disabled") ? alert("Please select some product options before adding this product to your cart.") : (i.toggleClass("added").addClass("load-more-overlay loading"), setTimeout((function() {
				var product_id = $("#product_id").val();
				var qty = $("#user_qty").val();
				var regex = /[+-]?\d+(\.\d+)?/g;
				var price = $("#product-price .new-price").html().match(regex).map(function(v) { return parseFloat(v); }); 
				
				var cart_old_total = $(".cart-total .price").html().match(regex).map(function(v) { return parseFloat(v); });
				// price =  parseFloat(price)
			if (parseInt(qty) < 10) {
				alert("Minimum order quantity is 10. Please select at least 10 products.");
				i.removeClass("load-more-overlay loading"); // FIX HERE
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
						i.removeClass("load-more-overlay loading"), Wolmart.Minipopup.open({
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
                    
                  
    //                 Wolmart.$body.on("click", ".product:not(.product-select) .btn-cart, .product-popup .btn-cart, .home .product-single .btn-cart", (function (e) {
    //     e.preventDefault();
    //     var i = $(this),
    //         a = i.closest(".product, .product-popup");
    //     i.hasClass("disabled") ? alert("Please select some product options before adding this product to your cart.") : (i.toggleClass("added").addClass("load-more-overlay loading"), setTimeout((function () {
    //         var product_id = $("#product_id").val();
    //         var qty = $("#user_qty").val();
    //         var regex = /[+-]?\d+(\.\d+)?/g;
    //         var price = $("#product-price .new-price").html().match(regex).map(function (v) { return parseFloat(v); });
    //         var discountPercentage = 0;

    //         // Define discount conditions based on quantity
    //         if (parseInt(qty) >= 10 && parseInt(qty) < 50) {
    //             discountPercentage = 5;
    //         } else if (parseInt(qty) >= 50 && parseInt(qty) < 100) {
    //             discountPercentage = 10;
    //         } else if (parseInt(qty) >= 100 && parseInt(qty) < 150) {
    //             discountPercentage = 15;
    //         } else if (parseInt(qty) >= 150 && parseInt(qty) <= 200) {
    //             discountPercentage = 20;
    //         }

    //         if (parseInt(qty) < 10) {
    //             alert("Minimum order quantity is 10. Please select at least 10 products.");
    //             return;
    //         }

    //         var formdata = $("#choice_options_form").serialize();
    //         formdata += '&product_id=' + product_id + '&qty=' + qty;

    //         $.ajax({
    //             type: "POST",
    //             url: '<?=base_url();?>products/add_to_cart/',
    //             data: formdata,
    //             success: function (data) {
    //                 if (data == 'ERROR_QTY') {
    //                     alert('Product qty must be equal or less than available qty.');
    //                     i.removeClass("load-more-overlay loading");
    //                 } else {
    //                     console.log(data);
    //                     var oldcart = parseInt($(".cart-count").html());
    //                     var discountedPrice = calculateDiscountedPrice(price, discountPercentage);

    //                     $(".cart-count").html((oldcart + 1));
    //                     $(".cart-total .price").html("£ " + (parseFloat($(".cart-total .price").html()) + (discountedPrice * qty)))
    //                     $(".cart-dropdown .products").append('<div class="product product-cart"><div class="product-detail"><a href="<?=base_url();?>products/view/' + $("#product-slug").val() + '" class="product-name">' + a.find(".product-name, .product-title").text() + '</a><div class="price-box"><span class="product-quantity">' + qty + '</span><span class="product-price">£ ' + discountedPrice + '</span></div></div><figure class="product-media"><a href="<?=base_url();?>products/view/' + $("#product-slug").val() + '"><img src="' + a.find(".product-media img, .product-image:first-child img").attr("src") + '" alt="' + a.find(".product-name, .product-title").text() + '" height="84" width="94" /></a></figure></div>');
    //                     i.removeClass("load-more-overlay loading"), Wolmart.Minipopup.open({
    //                         productClass: " product-cart",
    //                         name: a.find(".product-name, .product-title").text(),
    //                         nameLink: a.find(".product-name > a, .product-title > a").attr("href"),
    //                         imageSrc: a.find(".product-media img, .product-image:first-child img").attr("src"),
    //                         imageLink: a.find(".product-name > a").attr("href"),
    //                         message: "<p>has been added to cart:</p>",
    //                         actionTemplate: '<a href="<?=base_url();?>cart" class="btn btn-rounded btn-sm">View Cart</a><a href="<?=base_url();?>checkout" class="btn btn-dark btn-rounded btn-sm">Checkout</a>'
    //                     });

    //                     // Display discounted price in the console
    //                     console.log("Discounted Price: £" + discountedPrice);
    //                 }
    //             }
    //         });

    //     }), 500))
    // }));

    // // Function to calculate discounted price
    // function calculateDiscountedPrice(originalPrice, discountPercentage) {
    //     return originalPrice - (originalPrice * (discountPercentage / 100));
    // }  
                    
    
</script>


</body>


</html>

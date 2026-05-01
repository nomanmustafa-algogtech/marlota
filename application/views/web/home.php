
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<style>
    /*products slider start*/
    .intro-wrapper {
        padding-left: 0px;
    }

    .containerr {
        display: flex;
        /* Use flexbox layout */
    }

    .category-image {
        width: 100%;
        /* Adjusts width to fill the container */
        height: 100%;
        /* Ensures the height is consistent across all images */
        object-fit: cover;
        /* Makes the image cover the area, maintaining aspect ratio */
        border-radius: 15px;
        /* Adds rounded corners */
    }

    .swiper-slide .category-media {
        width: 217px;
        /* Fixed width for each slider item */
        height: 96px;
        /* Fixed height for each slider item */
        overflow: hidden;
        /* Prevents any overflow from the image */
        border-radius: 15px;
        /* Rounded corners on the container */
    }

    /* Style for each child div */
    .child {
        flex: 1;
        /* Distribute equal space among child elements */
        border: 1px solid #ccc;
        /* Optional border for visualization */
        padding: 10px;
        /* Optional padding for content spacing */
    }

    /* Style for the first child div with an image (30% width) */
    .child:first-child {
        flex: 0 0 20%;
        /* 30% width, fixed size */
    }

    /* Style for the second child div (70% width) */
    .child:nth-child(2) {
        flex: 0 0 80%;
        /* 70% width, fixed size */
        overflow: hidden;
    }

    .childd {
        flex: 1;
        /* Distribute equal space among child elements */
        border: 1px solid #ccc;
        /* Optional border for visualization */
        padding: 10px;
        /* Optional padding for content spacing */
    }

    /* Style for the first child div with an image (30% width) */
    .childd:first-child {
        flex: 0 0 20%;
        /* 30% width, fixed size */
    }

    /* Style for the second child div (70% width) */
    .childd:nth-child(2) {
        flex: 0 0 80%;
        /* 70% width, fixed size */
        overflow: hidden;
    }

    /* Style for the image inside the first child */
    .child img {
        max-width: 100%;
        /* Make sure the image doesn't exceed the container width */
        height: auto;
        /* Maintain the aspect ratio of the image */
        display: block;
        /* Remove extra spacing below the image */
        margin: 0 auto;
        /* Center the image horizontally */
    }


    /*slide show css start */
    .mySlides {
        display: none;
    }

    img {
        vertical-align: middle;
    }

    /* Slideshow container */
    .slideshow-container {
        max-width: 1000px;
        position: relative;
        margin: auto;
    }

    /* Caption text */
    .text {
        color: #f2f2f2;
        font-size: 15px;
        padding: 8px 12px;
        position: absolute;
        bottom: 8px;
        width: 100%;
        text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbb;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.6s ease;
    }

    /* Fading animation */
    .fade {
        animation-name: fade;
        animation-duration: 1.5s;
    }

    @keyframes fade {
        from {
            opacity: .4
        }

        to {
            opacity: 1
        }
    }

    .width60{
        width: 97% !important;
    }
    
    @media only screen and (max-width: 768px) {
        .width60{
        width: 98% !important;
    }
    
    }
    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .text {
            font-size: 11px
        }
    }
</style>

            <style>

                .custom-slider-container {
                    position: relative;
                    width: 100%;
                    margin: auto;
                    padding: 50px 0 50px 0;
                    /* border: 2px solid #1d5366; */
                    border-radius: 5px;
                    overflow: hidden;
                }
            
                .custom-slider {
                    display: flex;
                    transition: transform 0.5s ease;
                    text-align: center;
                }
            
                .custom-product {
                    /* width: 25%; */
                    /* Show 4 products at a time */
                    margin: 0 1% 0 1%;
                    text-align: center;
                    padding: 10px;
                    border-radius: 15px;
                    border: 2px solid #1d5366;

                    /* border: 1px solid black;
                        border-radius: 5px; */
                }
            
                .fix-box {
                    width: 100%; 
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    overflow: hidden;
                }
                
                /* Small screens (typically phones) */
                @media screen and (max-width: 599px) {
                    /* Styles for small screens go here */
                    .fix-box {
                        width: 100%;
                    }
                }
                
                /* Medium screens (tablets) */
                @media screen and (min-width: 600px) and (max-width: 1023px) {
                    /* Styles for medium screens go here */
                    .fix-box {
                        width: 100%;
                    }
                }
                
                /* Large screens (desktops and large tablets) */
                @media screen and (min-width: 1024px) {
                    /* Styles for large screens go here */
                    .fix-box {
                        width: 100%;
                    }
                }
            
            
                .custom-product img {
                    /* width: 300%;
                        height: auto;
                        border-radius: 8px; */
                    max-width: 100%;
                    height: 250px;
                    object-fit: contain;
                    /* Ensures aspect ratio is preserved */
                }
            
                /* .custom-product p {
                        text-align: center;
                    } */
            
                .custom-button {
                    position: absolute;
                    width: 50px;
                    height: 50px;
                    top: 50%;
                    transform: translateY(-50%);
                    background-color: rgba(0, 0, 0, 0.242);
                    color: white;
                    border: none;
                    padding: 10px;
                    cursor: pointer;
                    font-size: 24px;
                    border-radius: 50%;
                    z-index: 10;
                }
            
                .prev {
                    left: 0;
                }
            
                .next {
                    right: 0;
                }
            
                button:hover {
                    background-color: rgba(0, 0, 0, 0.8);
                }
                .swiper-slidee {
                    width: 100% !important;
                }
                .slick-slider {
                    width: 100%;
                    margin: 0 auto;
                }

                .slick-slider .slide {
                    height: 100%; /* Adjust height as needed */
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    text-align: center;
                    color: #fff; /* Text color for visibility */
                    padding: 0;
                }

                /* Remove padding and margins from parent elements */
                .intro-wrapper {
                    padding: 0;
                    margin: 0;
                }

                /* Ensure the .card container doesn't have unnecessary space */
                .card {
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                }
                .category-image-slider{
                    height: 240px !important;
                }
            </style>
<body>
    <div class="main">
        <h1 style="display:none">Oxijan Ltd: Uk Best wholesale and dropshipping website</h1>
        <div class="container">
            <!-- <div class="card">
                <div class="intro-wrapper">
                    <div class="swiper-container swiper-theme nav-inner swiper-nav-md animation-slider swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events" data-swiper-options="{
                                'autoplay': {
                                    'delay': 8000,
                                    'disableOnInteraction': false
                                }
                            }">
                        <div class="swiper-wrapper " id="swiper-wrapper-f5699e756fc558ae" aria-live="off" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                            <?php
                            $sliders = $this->db->query("SELECT * FROM app_sliders order by sorting asc");
                            $total_sliders = $sliders->num_rows();
                            $sn = 0;
                            foreach ($sliders->result_array() as $row) {
                                $sn++ ?>
                                <div class="swiper-slide swiper-slidee banner banner-fixed intro-slide intro-slide1 br-sm swiper-slide-active" style="background-image: url(&quot;<?= base_url(); ?>uploads/sliders/<?= $row['image']; ?>&quot;); width: 797px;" role="group" aria-label="<?= $sn; ?> / <?= $total_sliders; ?>">
                                    <?php if ($row['content_show'] == 1) { ?>
                                        <div class="banner-content y-50 x-50 w-100 text-center">
                                            <h5 class="banner-subtitle text-primary font-weight-normal text-capitalize font-secondary ls-25 slide-animate"
                                                data-animation-options="{'name': 'fadeInDownShorter', 'duration': '.8s'}"><?= $row['title']; ?>
                                            </h5>
                                            <h3 class="banner-title text-white text-capitalize ls-25 lh-1 slide-animate"
                                                data-animation-options="{'name': 'fadeInRightShorter', 'duration': '.5s', 'delay': '.5s'}">
                                                <?= $row['subtitle']; ?></h3>
                                            <p class="ls-25 slide-animate" data-animation-options="{
                                                'name': 'fadeInLeftShorter', 'duration': '.5s', 'delay': '.5s'
                                            }"><?= $row['text']; ?></p>
                                            <a href="<?= $row['link']; ?>"
                                                class="btn btn-white btn-outline btn-rounded btn-icon-right slide-animate"
                                                data-animation-options="{'name': 'fadeInUpShorter', 'duration': '.5s', 'delay': '.5s'}">
                                                <?= $row['button_title']; ?><i class="w-icon-long-arrow-right"></i>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <button class="swiper-button-next" tabindex="0" aria-label="Next slide" aria-controls="swiper-wrapper-f5699e756fc558ae" aria-disabled="false"></button>
                        <button class="swiper-button-prev swiper-button-disabled" tabindex="-1" aria-label="Previous slide" aria-controls="swiper-wrapper-f5699e756fc558ae" aria-disabled="true" disabled=""></button>
                        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    </div>
                </div>
            </div> -->
            
                <div class="intro-wrapper">
                    <div class="slick-slider">
                        <?php
                        $sliders = $this->db->query("SELECT * FROM app_sliders ORDER BY sorting ASC");
                        foreach ($sliders->result_array() as $index => $row) {
                        ?>
                            <div class="slide banner banner-fixed intro-slide br-sm" style="background-image: url('<?= base_url(); ?>uploads/sliders/<?= $row['image']; ?>'); background-size: cover; background-position: center;">
                                <?php if ($row['content_show'] == 1) { ?>
                                    <div class="banner-content y-50 x-50 w-100 text-center">
                                        <h5 class="banner-subtitle text-primary font-weight-normal text-capitalize font-secondary ls-25">
                                            <?= $row['title']; ?>
                                        </h5>
                                        <h3 class="banner-title text-white text-capitalize ls-25 lh-1">
                                            <?= $row['subtitle']; ?>
                                        </h3>
                                        <p class="ls-25">
                                            <?= $row['text']; ?>
                                        </p>
                                        <a href="<?= $row['link']; ?>" class="btn btn-white btn-outline btn-rounded btn-icon-right">
                                            <?= $row['button_title']; ?><i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
           

            <!-- End of Intro Wrapper -->
    
            <!-- End of Iocn Box Wrapper -->
            <br>
            <section class="row px-6 md:px-12 text-center" style="">
                <div class="col-12 md-col-12 lg-col-12 " style="background: #871919; color: #ffffff; border-radius: 2px;">
                    <p class="mt-2" style="justify-content: center; align-items:center;">Your trusted link between top suppliers and loyal customers. Experience seamless drop-shipping with quality products and reliable service every step of the way!</p>
                </div>
            </section>
            
            <h2 class="title text-left mb-5 title justify-content-center ls-normal mb-4 mt-5 pt-1">Our Categories</h2>
    
            <div class="child" style="justify-content:center; align-items: center; border: 0px !important;">
                <div class="slider owl-carousel" style="border: 0px !important;">
                    <?php
                    $categories = $this->db->query("SELECT * FROM app_categories WHERE level = 0");
                    foreach ($categories->result_array() as $row) {
                        // Ensure there is an image and a name for the category
                        if (!empty($row['image']) && !empty($row['name'])) {
                    ?>
                            <div class="card width60" style="overflow: hidden; float: none !important; padding: 0 !important; margin: 0 !important; border-radius: 10px; border: 2px solid #1d5366;">
                                <div class="product text-center" style="margin: 0 !important;">
                                    <div class="img">
                                        <figure class="product-media">
                                            <a href="<?= base_url(); ?>products/?category=<?= $row['slug']; ?>">
                                                <img class="category-image-slider" src="<?= base_url(); ?>uploads/categories/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" width="100%" />
                                            </a>
                                        </figure>
                                    </div>
                                    <div class="product-details content">
                                        <h4 class="product-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></h4>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
            
            <!-- End of Category Wrapper -->
    
            <h2 class="title justify-content-center ls-normal mb-4 mt-5 pt-1 appear-animate">Trending Products</h2>

            <div class="custom-slider-container">
                <div class="custom-slider owl-carousel">
                    <?php
                    $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                    foreach ($new_arrivals as $row) {
                        $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                    ?>
                        <div class="custom-product">
                            <div class="fix-box">
                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                    <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="Product Image">
                                </a>
                            </div>
                            <h4 class="product-name text-center" style=" overflow: hidden;">
                            <!-- <h4 class="product-name text-center" style="width: 260px; overflow: hidden;"> -->
                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                    <?= $row['name']; ?>
                                </a>
                            </h4>
                            <div class="ratings-container text-center">
                                <div class="ratings-full" style="display: flex; justify-content: center; align-items: center;">
                                    <span class="ratings" style="width: <?= ($row['rating'] * 100 / 5); ?>%;"></span>
                                </div>
                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews">(
                                    <?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows(); ?>
                                    Reviews)
                                </a>
                            </div>
                            <div class="product-price text-center">
                                <?php if ($stocks->num_rows() > 1) {
                                    $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
                                    if ($low_price->discount > 0) { ?>
                                        <del class="old-price">£<?= $low_price->price; ?></del>
                                        <ins class="new-price">£<?= $low_price->discount; ?></ins>
                                    <?php } else { ?>
                                        <ins class="new-price">£<?= $low_price->price; ?></ins>
                                    <?php }
                                } else {
                                    if ($stocks->row()->discount > 0) { ?>
                                        <del class="old-price">£<?= $stocks->row()->price; ?></del>
                                        <ins class="new-price">£<?= $stocks->row()->discount; ?></ins>
                                    <?php } else { ?>
                                        <ins class="new-price">£<?= $stocks->row()->price; ?></ins>
                                    <?php }
                                } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <h2 class="title justify-content-center ls-normal mb-4 mt-5 pt-1 appear-animate">Popular Departments
            </h2>
            <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <!--<li class="nav-item mr-2 mb-2">-->
                    <!--    <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-3">Featured</a>-->
                    <!--</li>-->
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New arrivals</a>
                    </li>
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best seller</a>
                    </li>
    
                </ul>
            </div>
            <!-- End of Tab -->
            <div class="tab-content product-wrapper appear-animate">
                <div class="tab-pane  pt-4" id="tab1-1">
                    <div class="row roww cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                        ?>
                                <div class="product-wrap" style="padding: 10px; margin: 10px; border-radius: 10px; border: 2px solid #1d5366;">
                                    <div class="product text-center">
                                        <figure class="product-media">
                                            <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
        
                                                <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" style="width:300px;height:230px" alt="<?= $row['name']; ?>"
                                                    width="68%" />
                                            </a>
                                        </figure>
                                        <div class="product-details">
                                            <h4 class="product-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: <?= ($row['rating'] * 100 / 5); ?>%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
                                            </div>
                                            <div class="product-price">
                                                <?php if ($stocks->num_rows() > 1) {
                                                    $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price asc")->row();
        
                                                ?>
                                                    <?php if ($low_price->discount > 0) { ?>
                                                        <del class="old-price">£ <?= $low_price->price; ?></del>
                                                        <ins class="new-price">£ <?= $low_price->discount; ?></ins>
                                                    <?php } else { ?>
                                                        <ins class="new-price">£ <?= $low_price->price; ?></ins>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($stocks->row()->discount > 0) { ?>
                                                        <del class="old-price">£ <?= $stocks->row()->price; ?></del>
                                                        <ins class="new-price">£ <?= $stocks->row()->discount; ?></ins>
                                                    <?php } else { ?>
                                                        <ins class="new-price">£ <?= $stocks->row()->price; ?></ins>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        <?php } ?>
                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane pt-4" id="tab1-2">
                    <div class="row  roww cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' ORDER by rating DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                        ?>
                            <div class="product-wrap" style="padding: 10px; margin: 10px; border-radius: 10px; border: 2px solid #1d5366;">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
    
                                            <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" style="width:300px;height:230px" alt="<?= $row['name']; ?>"
                                                width="68%" />
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: <?= ($row['rating'] * 100 / 5); ?>%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <?php if ($stocks->num_rows() > 1) {
                                                $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price asc")->row();
    
                                            ?>
                                                <?php if ($low_price->discount > 0) { ?>
                                                    <del class="old-price">£ <?= $low_price->price; ?></del>
                                                    <ins class="new-price">£ <?= $low_price->discount; ?></ins>
                                                <?php } else { ?>
                                                    <ins class="new-price">£ <?= $low_price->price; ?></ins>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($stocks->row()->discount > 0) { ?>
                                                    <del class="old-price">£ <?= $stocks->row()->price; ?></del>
                                                    <ins class="new-price">£ <?= $stocks->row()->discount; ?></ins>
                                                <?php } else { ?>
                                                    <ins class="new-price">£ <?= $stocks->row()->price; ?></ins>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- End of Tab Pane -->
                <div class="tab-pane active pt-4" id="tab1-3">
                    <div class="row roww cols-xl-5 cols-md-4 cols-sm-3 cols-2">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                        ?>
                            <div class="product-wrap" style="padding: 10px; margin: 10px; border-radius: 10px; border: 2px solid #1d5366;">
                                <div class="product text-center">
                                    <figure class="product-media">
                                        <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
    
                                            <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" style="width:300px;height:230px" alt="<?= $row['name']; ?>"
                                                width="68%" />
                                        </a>
                                    </figure>
                                    <div class="product-details">
                                        <h4 class="product-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: <?= ($row['rating'] * 100 / 5); ?>%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <?php if ($stocks->num_rows() > 1) {
                                                $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price asc")->row();
    
                                            ?>
                                                <?php if ($low_price->discount > 0) { ?>
                                                    <del class="old-price">£ <?= $low_price->price; ?></del>
                                                    <ins class="new-price">£ <?= $low_price->discount; ?></ins>
                                                <?php } else { ?>
                                                    <ins class="new-price">£ <?= $low_price->price; ?></ins>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <?php if ($stocks->row()->discount > 0) { ?>
                                                    <del class="old-price">£ <?= $stocks->row()->price; ?></del>
                                                    <ins class="new-price">£ <?= $stocks->row()->discount; ?></ins>
                                                <?php } else { ?>
                                                    <ins class="new-price">£ <?= $stocks->row()->price; ?></ins>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
    
                    </div>
                </div>
                <!-- End of Tab Pane -->
            </div>
    
    
    
            <h2 class="title justify-content-center ls-normal mb-4 mt-5 pt-1 appear-animate">Best Seller Products
            </h2>
            <div class="containerr">
    
    
                <div class="childd">
                    <div class="slideshow-container">
    
                        <div class="mySlides fade">
    
    
                            <img src="<?php echo base_url(); ?>uploads/newimgs/Shopping.jpg" />
    
    
                        </div>
    
                        <div class="mySlides fade">
    
    
                            <img src="<?php echo base_url(); ?>uploads/newimgs/Shoping2.jpg" />
                        </div>
    
    
    
                    </div>
                    <br>
    
                    <div style="text-align:center">
                        <span class="dot"></span>
                        <span class="dot"></span>
    
                    </div>
                </div>
                <div class="childd double-child">
                    <div class="child-top">
                        <img src="https://oxijan.co.uk/uploads/sliders/slider_1653136746.png" style="width:100%">
    
                    </div>
                    <hr>
                    <div class="child-bottom">
                        <div class="slider-bottom owl-carousel">
                            <?php
                            $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1'  && bestseller = '1'   ORDER by id DESC LIMIT 0,20")->result_array();
                            foreach ($new_arrivals as $row) {
                                $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                            ?>
                                <div class="card" style="padding: 10px; margin: 10px; border-radius: 10px; border: 2px solid #1d5366;">
    
                                    <div class="product text-center">
    
                                        <div class="img">
    
                                            <figure class="product-media">
                                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
    
                                                    <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>"
                                                        width="68%" />
                                                </a>
                                            </figure>
                                        </div>
                                        <div class="product-details content">
                                            <h4 class="product-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: <?= ($row['rating'] * 100 / 5); ?>%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="rating-reviews">(<?= $this->db->query("SELECT * FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->num_rows(); ?> Reviews)</a>
                                            </div>
                                            <div class="product-price">
                                                <?php if ($stocks->num_rows() > 1) {
                                                    $low_price = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price asc")->row();
    
                                                ?>
                                                    <?php if ($low_price->discount > 0) { ?>
                                                        <del class="old-price">£ <?= $low_price->price; ?></del>
                                                        <ins class="new-price">£ <?= $low_price->discount; ?></ins>
                                                    <?php } else { ?>
                                                        <ins class="new-price">£ <?= $low_price->price; ?></ins>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <?php if ($stocks->row()->discount > 0) { ?>
                                                        <del class="old-price">£ <?= $stocks->row()->price; ?></del>
                                                        <ins class="new-price">£ <?= $stocks->row()->discount; ?></ins>
                                                    <?php } else { ?>
                                                        <ins class="new-price">£ <?= $stocks->row()->price; ?></ins>
                                                    <?php } ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Banner Product Wrapper -->
    
            <div class="row pb-5 pt-5">
                <div class="col-md-6">
                    <img src="<?= base_url(); ?>uploads/banner-3.jpg" alt="No minimum Orders Required" style="width:100%" />
                </div>
                <div class="col-md-6">
                    <img src="<?= base_url(); ?>uploads/banner2.jpg" alt="We Offer multiple payment options" style="width:100%" />
                </div>
            </div>
        </div>
        <!-- End of Container -->
    </div>
</body>

<script>
    $(document).ready(function () {
    
       // $('.slick-slider').slick({
         //   autoplay: true,
          //  autoplaySpeed: 8000,
           // arrows: true, // Enable next/prev arrows
           // dots: false, // Disable dots
            //infinite: true,
            //slidesToShow: 1,
            //slidesToScroll: 1,
            //cssEase: 'ease',
            //speed: 500,
            //responsive: [
              //  {
                //    breakpoint: 768,
                  //  settings: {
                    //    slidesToShow: 1
                   // }
                //}
           // ]
        //});
    });

	 
    $(".slider").owlCarousel({
        loop: true,
        items: 6,
        autoplay: true,
        autoplayTimeout: 2000, //2000ms = 2s;
        autoplayHoverPause: true,
        responsive: {
            0: { items: 2 }, // 1 item on small screens
            600: { items: 3 }, // 2 items on medium screens
            1000: { items: 6 } // 3 items on large screens
        }
    });
    $(".slider-bottom").owlCarousel({
        loop: true,
        items: 5,
        autoplay: true,
        autoplayTimeout: 2000, //2000ms = 2s;
        autoplayHoverPause: true,
        responsive: {
            0: { items: 2 }, // 1 item on small screens
            600: { items: 3 }, // 2 items on medium screens
            1000: { items: 5 } // 3 items on large screens
        }
    });

    $(".custom-slider").owlCarousel({
        items: 5, // Number of visible slides
        loop: true, // Enable infinite looping
        margin: 7, // Space between slides
        nav: true, // Show navigation arrows
        dots: false, // Hide dots (optional)
        responsive: {
            0: { items: 1 }, // 1 item for small screens
            600: { items: 2 }, // 2 items for medium screens
            1000: { items: 5 } // 4 items for large screens
        }
    });
    </script>

<script>
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {
            slideIndex = 1
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
        setTimeout(showSlides, 2000); // Change image every 2 seconds
    }
</script>

<script>
    // let currentIndex = 0;
    // const visibleProducts = 4; // Number of products visible at a time
    // const customslider = document.querySelector('.custom-slider');
    // const totalProducts = document.querySelectorAll('.custom-product').length;
    // const maxIndex = totalProducts - visibleProducts;

    // function moveSlide(direction) {
    //     currentIndex += direction;

    //     // Handle edge cases to loop the slides
    //     if (currentIndex < 0) {
    //         currentIndex = maxIndex;
    //     }
    //     if (currentIndex > maxIndex) {
    //         currentIndex = 0;
    //     }

    //     // Move the custom-slider by applying a transform
    //     const offset = -currentIndex * (100 / visibleProducts);
    //     customslider.style.transform = `translateX(${offset}%)`;
    // }

    // // Auto move the slide every 3 seconds
    // setInterval(() => {
    //     moveSlide(1); // Move to the next slide every 3 seconds
    // }, 3000);
</script>

<!-- Google Tag Manager -->
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime(),
            event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TLPTH5RL');
</script>
<!-- End Google Tag Manager -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TLPTH5RL"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

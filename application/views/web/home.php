<?php /* Keep OWL and other slider scripts */ ?>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

<style>
    /* ---- Product slider overrides for new clean design ---- */
    .custom-slider-container {
        position: relative;
        width: 100%;
        margin: auto;
        padding: 20px 0 40px 0;
        overflow: hidden;
    }

    .custom-slider {
        display: flex;
        transition: transform 0.5s ease;
        text-align: center;
    }

    .custom-product {
        margin: 0 1%;
        text-align: center;
        padding: 14px;
        border-radius: 12px;
        border: 1px solid #e8e8e8 !important;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.05);
        transition: box-shadow .25s, transform .2s;
    }

    .custom-product:hover {
        box-shadow: 0 8px 24px rgba(45, 27, 105, .1) !important;
        transform: translateY(-2px);
    }

    .custom-product img {
        max-width: 100%;
        height: 220px;
        object-fit: contain;
    }

    .fix-box {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .product-wrap {
        padding: 14px;
        margin: 8px;
        border-radius: 12px;
        border: 1px solid #e8e8e8 !important;
        background: #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,.04);
        transition: box-shadow .25s, transform .2s;
    }

    .product-wrap:hover {
        box-shadow: 0 8px 24px rgba(45, 27, 105, .1) !important;
        transform: translateY(-2px);
    }

    .category-card-home {
        border: 1px solid #e8e8e8;
        border-radius: 12px;
        overflow: hidden;
        text-align: center;
        transition: box-shadow .25s, transform .2s;
        text-decoration: none;
        display: block;
        color: inherit;
        background: #fff;
    }

    .category-card-home:hover {
        box-shadow: 0 8px 28px rgba(45, 27, 105, .12);
        transform: translateY(-4px);
        color: inherit;
        text-decoration: none;
    }

    .category-card-home img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .category-card-home .card-body-cat {
        padding: 14px 16px;
    }

    .category-card-home h5 {
        font-size: .95rem;
        font-weight: 600;
        color: #1a1a2e;
        margin-bottom: 4px;
    }

    .category-card-home .browse-link {
        font-size: .8rem;
        color: #D4A017;
        font-weight: 600;
    }

    /* Slideshow */
    .mySlides { display: none; }
    .mySlides img { width: 100%; }
    .dot {
        height: 12px; width: 12px;
        margin: 0 3px;
        background-color: #ccc;
        border-radius: 50%;
        display: inline-block;
        transition: background-color 0.4s ease;
    }
    .dot.active { background-color: #2D1B69; }
    .fade { animation-name: fade; animation-duration: 1.5s; }
    @keyframes fade { from { opacity:.4 } to { opacity:1 } }
</style>

<div class="main" id="main">

    <!-- ========================================
         HERO SECTION
    ========================================= -->
    <section class="marlota-hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12">
                    <span class="badge-hero">Premium Packaging &amp; Supplies</span>
                    <h1>
                        E-Commerce Solutions for<br>
                        <span class="accent">Your Business</span>
                    </h1>
                    <p class="hero-sub">Premium packaging, labels, and office essentials delivered fast across the UK.</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="<?= base_url('products'); ?>" class="btn-hero-primary">Shop Products</a>
                        <a href="<?= base_url('web/about'); ?>" class="btn-hero-outline">Learn More</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 hero-image mt-4 mt-lg-0">
                    <img src="<?= base_url(); ?>uploads/newimgs/Shopping.jpg"
                         onerror="this.src='<?= base_url(); ?>webfiles/images/product-banner.jpg'"
                         alt="Premium Packaging Products" />
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         SHOP BY CATEGORY
    ========================================= -->
    <section class="marlota-categories">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">Shop By Category</h2>
                <div class="section-underline-center"></div>
                <p class="section-sub">Browse our wide range of quality packaging and supplies.</p>
            </div>
            <div class="row g-4">
                <?php
                $categories = $this->db->query("SELECT * FROM app_categories WHERE level = 0 LIMIT 0,8");
                foreach ($categories->result_array() as $row) {
                    if (!empty($row['name'])) {
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="<?= base_url(); ?>products/?category=<?= $row['slug']; ?>" class="category-card-home">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="<?= base_url(); ?>uploads/categories/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" />
                            <?php } else { ?>
                                <div style="height:180px;background:#f0eaf8;display:flex;align-items:center;justify-content:center;font-size:2rem;color:#2D1B69;">📦</div>
                            <?php } ?>
                            <div class="card-body-cat">
                                <h5><?= $row['name']; ?></h5>
                                <span class="browse-link">Browse Now →</span>
                            </div>
                        </a>
                    </div>
                <?php } } ?>
            </div>
        </div>
    </section>

    <!-- ========================================
         WHY CHOOSE MARLOTA
    ========================================= -->
    <section class="marlota-why">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title-white">Why Choose Marlota?</h2>
                <div class="section-underline-center"></div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="fa fa-truck"></i></div>
                        <h5>Fast UK Shipping</h5>
                        <p>Fast and reliable shipping across the United Kingdom.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="fa fa-star"></i></div>
                        <h5>Top Quality Products</h5>
                        <p>High-quality packaging products you can trust.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="feature-card">
                        <div class="icon-circle"><i class="fa fa-check-circle"></i></div>
                        <h5>Trusted By Sellers</h5>
                        <p>Thousands of businesses trust Marlota.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         TRENDING PRODUCTS
    ========================================= -->
    <section class="marlota-products-section">
        <div class="container">
            <h2 class="section-title mb-4">Trending Products</h2>
            <div class="custom-slider-container">
                <div class="custom-slider owl-carousel">
                    <?php
                    $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                    foreach ($new_arrivals as $row) {
                        $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                        $review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
                        $star_pct = ($row['rating'] * 100 / 5);
                        $filled = round($row['rating']);
                        // compute price/discount
                        if ($stocks->num_rows() > 1) {
                            $lp = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
                        } else {
                            $lp = $stocks->row();
                        }
                        $show_old = ($lp && $lp->discount > 0);
                        $display_price = ($show_old) ? $lp->discount : ($lp ? $lp->price : 0);
                        $old_price = $lp ? $lp->price : 0;
                        $pct_off = ($show_old && $old_price > 0) ? round(($old_price - $display_price) / $old_price * 100) : 0;
                    ?>
                        <div class="product-card-new" style="margin:0 5px;">
                            <div class="pc-image-wrap">
                                <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                    <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>">
                                </a>
                                <?php if ($pct_off > 0) { ?><span class="pc-badge-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                            </div>
                            <div class="pc-body">
                                <div class="pc-rating">
                                    <div class="pc-stars">
                                        <?php for ($s = 1; $s <= 5; $s++) { ?>
                                        <i class="fa fa-star<?= ($s <= $filled) ? '' : ($s - 0.5 <= $row['rating'] ? '-half-o' : '-o'); ?>"></i>
                                        <?php } ?>
                                    </div>
                                    <span class="pc-review-count"><?= $review_count; ?> Reviews</span>
                                </div>
                                <div class="pc-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></div>
                                <div class="pc-price-row">
                                    <span class="pc-price">£<?= $display_price; ?></span>
                                    <?php if ($show_old) { ?><span class="pc-old-price">£<?= $old_price; ?></span><?php } ?>
                                    <?php if ($pct_off > 0) { ?><span class="pc-pct-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                </div>
                                <div class="pc-fast-delivery">
                                    <span class="pc-fd-fast">Fast</span>
                                    <span class="pc-fd-label">Delivery</span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <!-- ========================================
                 POPULAR DEPARTMENTS TABS
            ========================================= -->
            <h2 class="section-title mb-3 mt-5">Popular Departments</h2>
            <div class="tab tab-nav-boxed tab-nav-outline appear-animate">
                <ul class="nav nav-tabs justify-content-center" role="tablist">
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link active br-sm font-size-md ls-normal" href="#tab1-1">New Arrivals</a>
                    </li>
                    <li class="nav-item mr-2 mb-2">
                        <a class="nav-link br-sm font-size-md ls-normal" href="#tab1-2">Best Seller</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content product-wrapper appear-animate">
                <!-- New Arrivals -->
                <div class="tab-pane pt-4" id="tab1-1">
                    <div class="product-cards-grid">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                            $review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
                            $filled = round($row['rating']);
                            if ($stocks->num_rows() > 1) {
                                $lp = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
                            } else {
                                $lp = $stocks->row();
                            }
                            $show_old = ($lp && $lp->discount > 0);
                            $display_price = ($show_old) ? $lp->discount : ($lp ? $lp->price : 0);
                            $old_price = $lp ? $lp->price : 0;
                            $pct_off = ($show_old && $old_price > 0) ? round(($old_price - $display_price) / $old_price * 100) : 0;
                        ?>
                            <div class="product-card-new">
                                <div class="pc-image-wrap">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>">
                                    </a>
                                    <?php if ($pct_off > 0) { ?><span class="pc-badge-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                </div>
                                <div class="pc-body">
                                    <div class="pc-rating">
                                        <div class="pc-stars">
                                            <?php for ($s = 1; $s <= 5; $s++) { ?>
                                            <i class="fa fa-star<?= ($s <= $filled) ? '' : ($s - 0.5 <= $row['rating'] ? '-half-o' : '-o'); ?>"></i>
                                            <?php } ?>
                                        </div>
                                        <span class="pc-review-count"><?= $review_count; ?> Reviews</span>
                                    </div>
                                    <div class="pc-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></div>
                                    <div class="pc-price-row">
                                        <span class="pc-price">£<?= $display_price; ?></span>
                                        <?php if ($show_old) { ?><span class="pc-old-price">£<?= $old_price; ?></span><?php } ?>
                                        <?php if ($pct_off > 0) { ?><span class="pc-pct-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                    </div>
                                    <div class="pc-fast-delivery">
                                        <span class="pc-fd-fast">Fast</span>
                                        <span class="pc-fd-label">Delivery</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <!-- Best Seller Tab -->
                <div class="tab-pane pt-4" id="tab1-2">
                    <div class="product-cards-grid">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' ORDER by rating DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                            $review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
                            $filled = round($row['rating']);
                            if ($stocks->num_rows() > 1) {
                                $lp = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
                            } else {
                                $lp = $stocks->row();
                            }
                            $show_old = ($lp && $lp->discount > 0);
                            $display_price = ($show_old) ? $lp->discount : ($lp ? $lp->price : 0);
                            $old_price = $lp ? $lp->price : 0;
                            $pct_off = ($show_old && $old_price > 0) ? round(($old_price - $display_price) / $old_price * 100) : 0;
                        ?>
                            <div class="product-card-new">
                                <div class="pc-image-wrap">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>">
                                    </a>
                                    <?php if ($pct_off > 0) { ?><span class="pc-badge-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                </div>
                                <div class="pc-body">
                                    <div class="pc-rating">
                                        <div class="pc-stars">
                                            <?php for ($s = 1; $s <= 5; $s++) { ?>
                                            <i class="fa fa-star<?= ($s <= $filled) ? '' : ($s - 0.5 <= $row['rating'] ? '-half-o' : '-o'); ?>"></i>
                                            <?php } ?>
                                        </div>
                                        <span class="pc-review-count"><?= $review_count; ?> Reviews</span>
                                    </div>
                                    <div class="pc-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></div>
                                    <div class="pc-price-row">
                                        <span class="pc-price">£<?= $display_price; ?></span>
                                        <?php if ($show_old) { ?><span class="pc-old-price">£<?= $old_price; ?></span><?php } ?>
                                        <?php if ($pct_off > 0) { ?><span class="pc-pct-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                    </div>
                                    <div class="pc-fast-delivery">
                                        <span class="pc-fd-fast">Fast</span>
                                        <span class="pc-fd-label">Delivery</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <!-- ========================================
                 BEST SELLER PRODUCTS
            ========================================= -->
            <h2 class="section-title mb-4 mt-5">Best Seller Products</h2>
            <div class="row">
                <div class="col-md-3 d-none d-md-block">
                    <div style="border-radius:12px;overflow:hidden;">
                        <div class="mySlides fade">
                            <img src="<?php echo base_url(); ?>uploads/newimgs/Shopping.jpg" style="width:100%;border-radius:12px;" />
                        </div>
                        <div class="mySlides fade">
                            <img src="<?php echo base_url(); ?>uploads/newimgs/Shoping2.jpg" style="width:100%;border-radius:12px;" />
                        </div>
                        <div style="text-align:center;margin-top:8px;">
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="slider-bottom owl-carousel">
                        <?php
                        $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && bestseller = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                        foreach ($new_arrivals as $row) {
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                            $review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
                            $filled = round($row['rating']);
                            if ($stocks->num_rows() > 1) {
                                $lp = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}' ORDER BY price ASC")->row();
                            } else {
                                $lp = $stocks->row();
                            }
                            $show_old = ($lp && $lp->discount > 0);
                            $display_price = ($show_old) ? $lp->discount : ($lp ? $lp->price : 0);
                            $old_price = $lp ? $lp->price : 0;
                            $pct_off = ($show_old && $old_price > 0) ? round(($old_price - $display_price) / $old_price * 100) : 0;
                        ?>
                            <div class="product-card-new" style="margin:0 6px;">
                                <div class="pc-image-wrap">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= $row['name']; ?>">
                                    </a>
                                    <?php if ($pct_off > 0) { ?><span class="pc-badge-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                </div>
                                <div class="pc-body">
                                    <div class="pc-rating">
                                        <div class="pc-stars">
                                            <?php for ($s = 1; $s <= 5; $s++) { ?>
                                            <i class="fa fa-star<?= ($s <= $filled) ? '' : ($s - 0.5 <= $row['rating'] ? '-half-o' : '-o'); ?>"></i>
                                            <?php } ?>
                                        </div>
                                        <span class="pc-review-count"><?= $review_count; ?> Reviews</span>
                                    </div>
                                    <div class="pc-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= $row['name']; ?></a></div>
                                    <div class="pc-price-row">
                                        <span class="pc-price">£<?= $display_price; ?></span>
                                        <?php if ($show_old) { ?><span class="pc-old-price">£<?= $old_price; ?></span><?php } ?>
                                        <?php if ($pct_off > 0) { ?><span class="pc-pct-off"><?= $pct_off; ?>% OFF</span><?php } ?>
                                    </div>
                                    <div class="pc-fast-delivery">
                                        <span class="pc-fd-fast">Fast</span>
                                        <span class="pc-fd-label">Delivery</span>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         NEWSLETTER SECTION
    ========================================= -->
    <section class="marlota-newsletter">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="nl-icon">✉️</div>
                    <h4>Stay Updated</h4>
                    <p>Subscribe to get the latest updates on new products and offers.</p>
                </div>
                <div class="col-lg-6">
                    <form action="#" method="get" class="nl-form">
                        <input type="email" name="email" placeholder="Your email address" required />
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- End of Main -->

<script>
    $(document).ready(function () {
        $(".slider").owlCarousel({
            loop: true,
            items: 6,
            autoplay: true,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            responsive: {
                0:    { items: 2 },
                600:  { items: 3 },
                1000: { items: 6 }
            }
        });
        $(".slider-bottom").owlCarousel({
            loop: true,
            items: 4,
            autoplay: true,
            autoplayTimeout: 2500,
            autoplayHoverPause: true,
            responsive: {
                0:    { items: 2 },
                600:  { items: 3 },
                1000: { items: 4 }
            }
        });
        $(".custom-slider").owlCarousel({
            items: 5,
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0:    { items: 1 },
                600:  { items: 2 },
                1000: { items: 5 }
            }
        });
    });
</script>

<script>
    let slideIndex = 0;
    showSlides();
    function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots   = document.getElementsByClassName("dot");
        for (i = 0; i < slides.length; i++) { slides[i].style.display = "none"; }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1; }
        for (i = 0; i < dots.length; i++) { dots[i].className = dots[i].className.replace(" active",""); }
        if (slides[slideIndex-1]) {
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }
        setTimeout(showSlides, 2000);
    }
</script>

<!-- Google Tag Manager -->
<script>
    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-TLPTH5RL');
</script>
<!-- End Google Tag Manager -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TLPTH5RL" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

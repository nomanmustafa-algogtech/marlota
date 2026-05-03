<?php /* OWL CSS loaded here; OWL JS loaded via view_scripts in footer after jQuery */ ?>
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

    /* Force OWL carousel items to equal height */
    .custom-slider.owl-carousel .owl-stage {
        display: flex !important;
    }
    .custom-slider.owl-carousel .owl-item {
        display: flex !important;
        flex-direction: column;
    }
    .custom-slider.owl-carousel .owl-item .product-card-new {
        flex: 1;
        height: 100%;
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
        border-radius: 14px;
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

    .category-card-home .cat-img-wrap {
        background: #ffffff;
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 200px;
    }

    .category-card-home img {
        max-width: 100%;
        max-height: 160px;
        width: auto;
        height: auto;
        object-fit: contain;
    }

    .category-card-home .card-body-cat {
        padding: 14px 16px 16px;
        border-top: 1px solid #f0f0f0;
    }

    .category-card-home h5 {
        font-size: 16px;
        font-weight: 700;
        color: #1E1E1E;
        margin-bottom: 4px;
    }

    .category-card-home .browse-link {
        font-size: 16px;
        color: #1E1E1E;
        font-weight: 700;
    }

    .category-card-home:hover .browse-link {
        color: #5A2D82;
    }

    .category-slider-container {
        position: relative;
        width: 100%;
        margin: auto;
        padding: 4px 0;
    }

    .category-slider.owl-carousel .owl-stage {
        display: flex !important;
    }

    .category-slider.owl-carousel .owl-item {
        display: flex !important;
    }

    .category-slider.owl-carousel .owl-item .category-card-home {
        width: 100%;
        height: 100%;
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
    .dot.active { background-color: #5A2D82; }
    .fade { animation-name: fade; animation-duration: 1.5s; }
    @keyframes fade { from { opacity:.4 } to { opacity:1 } }
    .product-wrapper {
      height: 100% !important;
    }

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
                    <img src="<?= base_url(); ?>uploads/home-hero.png"
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
                <h2 class="section-title text-center">Shop By Category</h2>
                <div class="section-underline-center"></div>
                <p class="section-sub">Browse our wide range of quality packaging and supplies.</p>
            </div>
            <div class="category-slider-container">
                <div class="category-slider owl-carousel">
                    <?php
                    $categories = $this->db->query("SELECT * FROM app_categories WHERE level = 0 ");
                    foreach ($categories->result_array() as $row) {
                        if (!empty($row['name'])) {
                    ?>
                        <a href="<?= base_url(); ?>products/?category=<?= $row['slug']; ?>" class="category-card-home">
                            <div class="cat-img-wrap">
                            <?php if (!empty($row['image'])) { ?>
                                <img src="<?= base_url(); ?>uploads/categories/<?= $row['image']; ?>" alt="<?= $row['name']; ?>" />
                            <?php } else { ?>
                                <div class="home-category-fallback">📦</div>
                            <?php } ?>
                            </div>
                            <div class="card-body-cat">
                                <h5><?= $row['name']; ?></h5>
                                <span class="browse-link">Browse Now →</span>
                            </div>
                        </a>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>

    <!-- ========================================
         WHY CHOOSE MARLOTA
    ========================================= -->
    <section class="marlota-why">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title-white marlota-title-white">Why Choose Marlota?</h2>
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
            <h2 class="section-title mb-4 text-center">Trending Products</h2>
            <div class="custom-slider-container">
                <div class="custom-slider owl-carousel">
                    <?php
                    $new_arrivals = $this->db->query("SELECT * FROM app_products WHERE published = '1' && approved = '1' && featured = '1' ORDER by id DESC LIMIT 0,20")->result_array();
                    foreach ($new_arrivals as $row) {
                        $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '{$row['id']}'");
                        $review_count = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id = '{$row['id']}' AND approved = '1'")->row()->cnt;
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
                        <div class="product-card-new home-card-slider-margin">
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
                 POPULAR DEPARTMENTS — MODERN REDESIGN
            ========================================= -->
            <div class="pop-dept-section">
                <!-- Section Header -->
                <div class="pop-dept-header">
                    <div class="pop-dept-title-wrap">
                        <span class="pop-dept-eyebrow">Handpicked for you</span>
                        <h2 class="pop-dept-title">Popular Departments</h2>
                    </div>
                    <div class="pop-dept-filters" id="popDeptFilters">
                        <button class="pd-filter active" data-tab="tab-new">New Arrivals</button>
                        <button class="pd-filter" data-tab="tab-best">Best Sellers</button>
                        <button class="pd-filter" data-tab="tab-sale">On Sale</button>
                    </div>
                    <a href="<?= base_url('products'); ?>" class="pop-dept-viewall">View All <i class="fa fa-arrow-right"></i></a>
                </div>

                <!-- Tab Panels -->
                <div class="pop-dept-panels">

                    <!-- NEW ARRIVALS -->
                    <div class="pd-panel active" id="tab-new">
                        <div class="pd-grid">
                        <?php
                        $pd_new = $this->db->query("SELECT * FROM app_products WHERE published='1' AND approved='1' ORDER BY id DESC LIMIT 10")->result_array();
                        foreach ($pd_new as $row):
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}'");
                            $rc = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id='{$row['id']}' AND approved='1'")->row()->cnt;
                            $filled = round($row['rating']);
                            $lp = ($stocks->num_rows() > 1)
                                ? $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}' ORDER BY price ASC")->row()
                                : $stocks->row();
                            $has_disc = ($lp && $lp->discount > 0);
                            $price    = $has_disc ? $lp->discount : ($lp ? $lp->price : 0);
                            $orig     = $lp ? $lp->price : 0;
                            $pct      = ($has_disc && $orig > 0) ? round(($orig - $price) / $orig * 100) : 0;
                        ?>
                            <div class="pd-card">
                                <div class="pd-card-img">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= htmlspecialchars($row['name']); ?>" loading="lazy">
                                    </a>
                                    <?php if ($pct > 0): ?><span class="pd-badge-off"><?= $pct; ?>%<br>OFF</span><?php endif; ?>
                                    <span class="pd-badge-new">New</span>
                                    <div class="pd-hover-actions">
                                        <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-btn-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="pd-card-body">
                                    <div class="pd-stars">
                                        <?php for ($s=1;$s<=5;$s++): ?><i class="fa fa-star<?= ($s<=$filled)?'':($s-0.5<=$row['rating']?'-half-o':'-o'); ?>"></i><?php endfor; ?>
                                        <span>(<?= $rc; ?>)</span>
                                    </div>
                                    <div class="pd-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= htmlspecialchars($row['name']); ?></a></div>
                                    <div class="pd-price-row">
                                        <span class="pd-price">£<?= number_format($price, 2); ?></span>
                                        <?php if ($has_disc): ?><span class="pd-orig">£<?= number_format($orig, 2); ?></span><?php endif; ?>
                                    </div>
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-add-cart">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- BEST SELLERS -->
                    <div class="pd-panel" id="tab-best">
                        <div class="pd-grid">
                        <?php
                        $pd_best = $this->db->query("SELECT * FROM app_products WHERE published='1' AND approved='1' ORDER BY rating DESC, id DESC LIMIT 10")->result_array();
                        foreach ($pd_best as $row):
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}'");
                            $rc = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id='{$row['id']}' AND approved='1'")->row()->cnt;
                            $filled = round($row['rating']);
                            $lp = ($stocks->num_rows() > 1)
                                ? $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}' ORDER BY price ASC")->row()
                                : $stocks->row();
                            $has_disc = ($lp && $lp->discount > 0);
                            $price    = $has_disc ? $lp->discount : ($lp ? $lp->price : 0);
                            $orig     = $lp ? $lp->price : 0;
                            $pct      = ($has_disc && $orig > 0) ? round(($orig - $price) / $orig * 100) : 0;
                        ?>
                            <div class="pd-card">
                                <div class="pd-card-img">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= htmlspecialchars($row['name']); ?>" loading="lazy">
                                    </a>
                                    <?php if ($pct > 0): ?><span class="pd-badge-off"><?= $pct; ?>%<br>OFF</span><?php endif; ?>
                                    <span class="pd-badge-hot">🔥 Hot</span>
                                    <div class="pd-hover-actions">
                                        <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-btn-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="pd-card-body">
                                    <div class="pd-stars">
                                        <?php for ($s=1;$s<=5;$s++): ?><i class="fa fa-star<?= ($s<=$filled)?'':($s-0.5<=$row['rating']?'-half-o':'-o'); ?>"></i><?php endfor; ?>
                                        <span>(<?= $rc; ?>)</span>
                                    </div>
                                    <div class="pd-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= htmlspecialchars($row['name']); ?></a></div>
                                    <div class="pd-price-row">
                                        <span class="pd-price">£<?= number_format($price, 2); ?></span>
                                        <?php if ($has_disc): ?><span class="pd-orig">£<?= number_format($orig, 2); ?></span><?php endif; ?>
                                    </div>
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-add-cart">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- ON SALE -->
                    <div class="pd-panel" id="tab-sale">
                        <div class="pd-grid">
                        <?php
                        $pd_sale = $this->db->query("
                            SELECT p.* FROM app_products p
                            INNER JOIN app_product_stocks s ON s.product_id = p.id AND s.discount > 0
                            WHERE p.published='1' AND p.approved='1'
                            GROUP BY p.id ORDER BY p.id DESC LIMIT 10
                        ")->result_array();
                        foreach ($pd_sale as $row):
                            $stocks = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}'");
                            $rc = $this->db->query("SELECT COUNT(*) as cnt FROM app_product_reviews WHERE product_id='{$row['id']}' AND approved='1'")->row()->cnt;
                            $filled = round($row['rating']);
                            $lp = ($stocks->num_rows() > 1)
                                ? $this->db->query("SELECT * FROM app_product_stocks WHERE product_id='{$row['id']}' ORDER BY price ASC")->row()
                                : $stocks->row();
                            $has_disc = ($lp && $lp->discount > 0);
                            $price    = $has_disc ? $lp->discount : ($lp ? $lp->price : 0);
                            $orig     = $lp ? $lp->price : 0;
                            $pct      = ($has_disc && $orig > 0) ? round(($orig - $price) / $orig * 100) : 0;
                        ?>
                            <div class="pd-card">
                                <div class="pd-card-img">
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $row['thumbnail_img']; ?>" alt="<?= htmlspecialchars($row['name']); ?>" loading="lazy">
                                    </a>
                                    <?php if ($pct > 0): ?><span class="pd-badge-off"><?= $pct; ?>%<br>OFF</span><?php endif; ?>
                                    <span class="pd-badge-sale">Sale</span>
                                    <div class="pd-hover-actions">
                                        <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-btn-view">Quick View</a>
                                    </div>
                                </div>
                                <div class="pd-card-body">
                                    <div class="pd-stars">
                                        <?php for ($s=1;$s<=5;$s++): ?><i class="fa fa-star<?= ($s<=$filled)?'':($s-0.5<=$row['rating']?'-half-o':'-o'); ?>"></i><?php endfor; ?>
                                        <span>(<?= $rc; ?>)</span>
                                    </div>
                                    <div class="pd-name"><a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>"><?= htmlspecialchars($row['name']); ?></a></div>
                                    <div class="pd-price-row">
                                        <span class="pd-price">£<?= number_format($price, 2); ?></span>
                                        <?php if ($has_disc): ?><span class="pd-orig">£<?= number_format($orig, 2); ?></span><?php endif; ?>
                                    </div>
                                    <a href="<?= base_url(); ?>products/view/<?= $row['slug']; ?>" class="pd-add-cart">
                                        <i class="fa fa-shopping-cart"></i> Add to Cart
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (empty($pd_sale)): ?>
                            <div class="pd-empty">No sale products at the moment. <a href="<?= base_url('products'); ?>">Browse all products →</a></div>
                        <?php endif; ?>
                        </div>
                    </div>

                </div><!-- end panels -->

                <!-- View All CTA -->
                <div class="pop-dept-cta">
                    <a href="<?= base_url('products'); ?>" class="pop-dept-cta-btn">
                        Explore All Products &nbsp;<i class="fa fa-long-arrow-right"></i>
                    </a>
                </div>
            </div><!-- end pop-dept-section -->

        </div><!-- /.container -->
    </section><!-- /.marlota-products-section -->

    <!-- ========================================
         NEWSLETTER SECTION
    ========================================= -->
    <section class="marlota-newsletter newsletter-2025">
        <div class="container">
            <div class="newsletter-2025-card">
                <div class="newsletter-2025-left">
                    <div class="nl-icon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></div>
                    <div class="newsletter-copy">
                        <h4>Stay Updated</h4>
                        <p>Subscribe to get the latest updates on new products and offers.</p>
                    </div>
                </div>
                <div class="newsletter-2025-right">
                    <form action="#" method="get" class="nl-form" aria-label="Newsletter Subscribe">
                        <input type="email" name="email" placeholder="Enter your email" required />
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- End of Main -->

<script>
    /* Popular Departments tab switcher */
    document.querySelectorAll('#popDeptFilters .pd-filter').forEach(function(btn) {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#popDeptFilters .pd-filter').forEach(function(b){ b.classList.remove('active'); });
            document.querySelectorAll('.pd-panel').forEach(function(p){ p.classList.remove('active'); });
            btn.classList.add('active');
            var target = document.getElementById(btn.getAttribute('data-tab'));
            if (target) target.classList.add('active');
        });
    });
</script>

<script>
    window.addEventListener('load', function () {
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
            items: 4,
            loop: true,
            margin: 14,
            nav: true,
            dots: false,
            responsive: {
                0:    { items: 1 },
                600:  { items: 2 },
                1000: { items: 4 }
            }
        });
        $(".category-slider").owlCarousel({
            items: 4,
            loop: true,
            margin: 16,
            nav: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 2800,
            autoplayHoverPause: true,
            responsive: {
                0:    { items: 1 },
                576:  { items: 2 },
                992:  { items: 3 },
                1200: { items: 4 }
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

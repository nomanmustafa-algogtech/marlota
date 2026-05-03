<?php /* About Us Page — Marlota redesign */ ?>

<!-- ========================================
     HERO SECTION
========================================= -->
<section class="marlota-page-hero marlota-page-hero-about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="breadcrumb-hero">
                    <a href="<?= base_url(); ?>">Home</a>
                    <span>&rsaquo;</span>
                    <span>About Us</span>
                </div>
                <h1>About Us</h1>
                <p class="hero-sub">Driven by quality. Focused on service. Built for your business.</p>
            </div>
            <div class="col-lg-6 col-md-12 d-none d-lg-block">
                <div class="hero-visual text-end">
                    <img src="<?= base_url(); ?>uploads/about-hero.png"
                         onerror="this.src='<?= base_url(); ?>webfiles/images/product-banner.jpg'"
                         alt="Marlota products" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     WHO WE ARE
========================================= -->
<section class="marlota-about-who">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 col-md-12">
                <span class="badge-section">Who We Are</span>
                <h2>Your Trusted Partner in Packaging &amp; Supplies</h2>
                <div class="section-underline"></div>
                <p>Marlota is a modern UK brand built on one core principle: premium quality products, delivered with reliability you can trust. Based in Manchester and serving customers nationwide, Marlota specialises in high-quality home, lifestyle, and everyday essentials designed to elevate daily living.</p>
                <p class="second-p">As a fast-growing e-commerce brand, Marlota operates across Amazon, eBay, and our official website, giving customers a seamless, dependable shopping experience. Every product we offer is selected with purpose — durability, performance, and long-term value are at the heart of everything we do.</p>
                <a href="<?= base_url('products'); ?>" class="btn-shop-now" style="margin-top:16px; display:inline-block;">Explore Products</a>
            </div>
            <div class="col-lg-7 col-md-12">
                <img src="<?= base_url(); ?>uploads/about-marlota.png"
                     onerror="this.src='<?= base_url(); ?>webfiles/images/product-banner.jpg'"
                     alt="Marlota Warehouse" class="about-img" />
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     OUR CORE VALUES
========================================= -->
<section class="marlota-core-values">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-center">Our Core Values</h2>
            <div class="section-underline-center"></div>
            <p class="section-sub">The principles that guide everything we do.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="icon-circle"><i class="fa fa-truck"></i></div>
                    <h5>Fast Shipping</h5>
                    <p>We ensure fast and safe delivery across the UK.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="value-card">
                    <div class="icon-circle"><i class="fa fa-users"></i></div>
                    <h5>Customer Focused</h5>
                    <p>Our customers are at the heart of everything we do.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="value-card">
                    <div class="icon-circle"><i class="fa fa-shield"></i></div>
                    <h5>Trusted by Sellers</h5>
                    <p>Thousands of businesses rely on our products and services.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     OUR MISSION
========================================= -->
<section class="marlota-mission">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title text-center">Our Mission</h2>
            <div class="section-underline-center"></div>
        </div>
        <div class="mission-card">
            <div class="mission-icon-wrap"><i class="fa fa-star"></i></div>
            <div>
                <h4>Our Mission</h4>
                <p>To provide high-quality, reliable products that customers can trust — without unnecessary mark-ups or compromises.</p>
            </div>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-lg-4 col-md-12">
                <div class="mission-principle">
                    <div class="mp-number">01</div>
                    <h5>Quality First</h5>
                    <p>Every product is tested and selected to meet strict performance standards.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="mission-principle">
                    <div class="mp-number">02</div>
                    <h5>Customer Confidence</h5>
                    <p>Clear information, fast delivery, and responsive support — always.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="mission-principle">
                    <div class="mp-number">03</div>
                    <h5>Everyday Value</h5>
                    <p>Premium feel, long-lasting durability, and fair pricing for every customer.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     WHY CHOOSE MARLOTA
========================================= -->
<section class="marlota-why-choose">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 col-md-12">
                <span class="badge-section">Why Choose Us</span>
                <h2>A Brand That Puts Customers First</h2>
                <div class="section-underline"></div>
                <p>Marlota was created to challenge the throwaway culture of low-quality goods. We believe customers deserve better — products that last, perform, and deliver real value.</p>
                <ul class="marlota-checklist mt-4">
                    <li><i class="fa fa-check-circle"></i> Reliable UK-based service</li>
                    <li><i class="fa fa-check-circle"></i> Fast dispatch and delivery</li>
                    <li><i class="fa fa-check-circle"></i> Consistent product quality</li>
                    <li><i class="fa fa-check-circle"></i> Transparent communication</li>
                    <li><i class="fa fa-check-circle"></i> A smooth, stress-free shopping experience</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="why-choose-quote">
                    <i class="fa fa-quote-left wc-quote-icon"></i>
                    <p>Our customers return because they know exactly what to expect: quality, consistency, and care.</p>
                    <span class="wc-author">— The Marlota Team</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     OUR PRODUCTS
========================================= -->
<section class="marlota-products-range">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-center">Our Products</h2>
            <div class="section-underline-center"></div>
            <p class="section-sub">A growing range of practical, everyday essentials — each selected with the same attention to detail.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="range-card">
                    <div class="range-icon"><i class="fa fa-home"></i></div>
                    <h5>Home &amp; Lifestyle</h5>
                    <p>Essentials that elevate everyday living with quality and modern design.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="range-card">
                    <div class="range-icon"><i class="fa fa-leaf"></i></div>
                    <h5>Cleaning &amp; Organisation</h5>
                    <p>Practical tools and accessories to keep your space efficient and tidy.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="range-card">
                    <div class="range-icon"><i class="fa fa-wrench"></i></div>
                    <h5>Tools &amp; Accessories</h5>
                    <p>Durable everyday tools built for real-world performance and reliability.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="range-card">
                    <div class="range-icon"><i class="fa fa-calendar"></i></div>
                    <h5>Seasonal Essentials</h5>
                    <p>Trending and seasonal items curated to match what customers actually need.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="range-card">
                    <div class="range-icon"><i class="fa fa-briefcase"></i></div>
                    <h5>Daily-Use Items</h5>
                    <p>Practical, affordable products for regular use — strong materials, clean design.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="range-card range-card-cta">
                    <h5>Always Expanding</h5>
                    <p>New product lines added continuously — quality-checked before they carry the Marlota name.</p>
                    <a href="<?= base_url('products'); ?>" class="btn-shop-now mt-3">Browse All Products</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     3PL FULFILMENT SERVICES
========================================= -->
<section class="marlota-3pl">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-3pl">3PL Services</span>
            <h2 class="section-title-white text-white">Marlota 3PL Fulfilment Services</h2>
            <div class="section-underline-center" style="background:#C9A646;"></div>
            <p class="section-sub" style="color:rgba(255,255,255,.75);">UK &amp; Cross-Border — A reliable, cost-effective fulfilment solution designed to scale with you.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-building"></i></div>
                    <h5>UK-Based Warehousing</h5>
                    <p>Secure storage in the North West with flexible capacity for small to medium-sized brands.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-bolt"></i></div>
                    <h5>Fast &amp; Accurate Fulfilment</h5>
                    <p>Same-day or next-day dispatch options for e-commerce orders, handled with care.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-amazon"></i></div>
                    <h5>Amazon FBA Prep</h5>
                    <p>Labelling, bundling, poly-bagging, carton prep, and direct FBA shipment support.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-refresh"></i></div>
                    <h5>Multi-Channel Integration</h5>
                    <p>Seamless order syncing for eBay, Shopify, and all major platforms.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-globe"></i></div>
                    <h5>Cross-Border Fulfilment</h5>
                    <p>Ideal for EU, US, and global sellers wanting a reliable UK distribution hub.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="tpl-card">
                    <div class="tpl-icon"><i class="fa fa-undo"></i></div>
                    <h5>Returns &amp; Quality Checks</h5>
                    <p>Professional inspection, repackaging, and restocking services included.</p>
                </div>
            </div>
        </div>
        <div class="row mt-5 g-4">
            <div class="col-lg-6">
                <div class="tpl-who-card">
                    <h4><i class="fa fa-users"></i> Who Our 3PL Service Is For</h4>
                    <ul class="marlota-checklist marlota-checklist-light">
                        <li><i class="fa fa-check-circle"></i> UK brands needing reliable fulfilment</li>
                        <li><i class="fa fa-check-circle"></i> Overseas sellers wanting a UK base</li>
                        <li><i class="fa fa-check-circle"></i> Amazon FBA/FBM sellers</li>
                        <li><i class="fa fa-check-circle"></i> eBay and Shopify merchants</li>
                        <li><i class="fa fa-check-circle"></i> Start-ups scaling their operations</li>
                        <li><i class="fa fa-check-circle"></i> Businesses wanting to reduce fulfilment costs</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="tpl-who-card">
                    <h4><i class="fa fa-star"></i> Why Choose Marlota 3PL</h4>
                    <ul class="marlota-checklist marlota-checklist-light">
                        <li><i class="fa fa-check-circle"></i> Competitive pricing</li>
                        <li><i class="fa fa-check-circle"></i> Fast turnaround times</li>
                        <li><i class="fa fa-check-circle"></i> Transparent communication</li>
                        <li><i class="fa fa-check-circle"></i> Flexible storage options</li>
                        <li><i class="fa fa-check-circle"></i> A partner that understands e-commerce from the inside out</li>
                    </ul>
                    <p class="tpl-partner-note">Marlota isn't just a fulfilment provider — we're an operational partner dedicated to helping brands grow, scale, and succeed in the UK market.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     COMMITMENT + STANDARD
========================================= -->
<section class="marlota-commitment">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6">
                <span class="badge-section">Our Promise</span>
                <h2>Our Commitment to You</h2>
                <div class="section-underline"></div>
                <p>At Marlota, we believe trust is earned. We don't just sell products — we build long-term relationships with customers and clients who value reliability and honesty.</p>
                <ul class="marlota-checklist mt-4">
                    <li><i class="fa fa-check-circle"></i> Accurate product descriptions</li>
                    <li><i class="fa fa-check-circle"></i> High-quality packaging</li>
                    <li><i class="fa fa-check-circle"></i> Responsive customer support</li>
                    <li><i class="fa fa-check-circle"></i> Continuous improvement based on real customer feedback</li>
                </ul>
            </div>
            <div class="col-lg-6">
                <span class="badge-section">Our Benchmark</span>
                <h2>The Marlota Standard</h2>
                <div class="section-underline"></div>
                <p>Every product and every service we offer must meet the Marlota Standard. If it doesn't meet our standard, it doesn't carry the Marlota name.</p>
                <div class="standard-badges mt-4">
                    <span class="std-badge"><i class="fa fa-check"></i> Strong Materials</span>
                    <span class="std-badge"><i class="fa fa-check"></i> Clean, Modern Design</span>
                    <span class="std-badge"><i class="fa fa-check"></i> Practical Functionality</span>
                    <span class="std-badge"><i class="fa fa-check"></i> Long-Lasting Performance</span>
                    <span class="std-badge"><i class="fa fa-check"></i> Excellent Value for Money</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     LOOKING AHEAD
========================================= -->
<section class="marlota-looking-ahead">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <span class="badge-section">Our Vision</span>
                <h2>Looking Ahead</h2>
                <div class="section-underline"></div>
                <p>Marlota is growing quickly, and we're just getting started. Our vision is to become one of the UK's most trusted online brands for everyday essentials — and a leading fulfilment partner for businesses entering or expanding within the UK market.</p>
                <p style="margin-top:16px;">With new product lines, improved fulfilment capabilities, and continuous investment in our infrastructure, Marlota is building a brand and a service network that customers and clients can rely on for years to come.</p>
            </div>
            <div class="col-lg-5">
                <div class="ahead-stats">
                    <div class="ahead-stat">
                        <span class="ahead-num">UK</span>
                        <span class="ahead-label">Nationwide Delivery</span>
                    </div>
                    <div class="ahead-stat">
                        <span class="ahead-num">3PL</span>
                        <span class="ahead-label">Fulfilment Services</span>
                    </div>
                    <div class="ahead-stat">
                        <span class="ahead-num">24/7</span>
                        <span class="ahead-label">Online Store</span>
                    </div>
                    <div class="ahead-stat">
                        <span class="ahead-num">100%</span>
                        <span class="ahead-label">Quality Checked</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     FINAL CTA
========================================= -->
<section class="marlota-cta">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-4">
            <div class="d-flex align-items-center">
                <div class="cta-icon-wrap"><i class="fa fa-handshake-o"></i></div>
                <div>
                    <h4>Shop or Partner With Confidence</h4>
                    <p>Whether shopping on Amazon, eBay, or Marlota.co.uk, or partnering with us for 3PL fulfilment — quality, professionalism, and care every time.</p>
                </div>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <a href="<?= base_url('products'); ?>" class="btn-cta">Shop Now</a>
                <a href="<?= base_url('contact'); ?>" class="btn-cta" style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.4);">Get in Touch</a>
            </div>
        </div>
    </div>
</section>

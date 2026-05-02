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
                <p>Marlota Limited is a UK-based supplier of premium packaging, labels, and office essentials. We are dedicated to helping businesses of all sizes operate more efficiently with quality products that make a lasting impression.</p>
                <p class="second-p">We are committed to providing premium products at competitive prices, with fast and reliable delivery across the United Kingdom. Whether you are an e-commerce seller, retailer, or business owner, Marlota has the supplies you need.</p>
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
                <p>To deliver premium packaging and supplies that help businesses grow, operate efficiently, and leave a lasting impression. We strive to be the most reliable and trusted packaging partner for UK businesses.</p>
            </div>
        </div>
    </div>
</section>

<?php /* Contact Us Page — Marlota redesign */ ?>

<!-- ========================================
     HERO SECTION
========================================= -->
<section class="marlota-page-hero marlota-page-hero-contact">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">
                <div class="breadcrumb-hero">
                    <a href="<?= base_url(); ?>">Home</a>
                    <span>&rsaquo;</span>
                    <span>Contact Us</span>
                </div>
                <h1>Contact Us</h1>
                <p class="hero-sub">We're here to help. Get in touch with our friendly team.</p>
            </div>
            <div class="col-lg-6 col-md-12 d-none d-lg-block">
                <div class="hero-visual text-end">
                    <img class="contact-hero" src="<?= base_url(); ?>uploads/contect-hero.png"
                         onerror="this.src='<?= base_url(); ?>webfiles/images/product-banner.jpg'"
                         alt="Marlota products" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     MAIN CONTENT — Form + Info
========================================= -->
<section class="marlota-contact-section">
    <div class="container">
        <div class="row g-5">
            <!-- LEFT: Contact Form -->
            <div class="col-lg-7 col-md-12">
                <div class="contact-form-card">
                    <h4>Send Us a Message</h4>
                    <form class="formm" action="#" method="post">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" name="name" required class="form-control" placeholder="Your full name" />
                            </div>
                            <div class="col-12">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" id="email" name="email" required class="form-control" placeholder="your@email.com" />
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label">Inquiry Type</label>
                            <div class="radio-group">
                                <label>
                                    <input type="radio" name="inquiry_type" value="General" checked />
                                    General
                                </label>
                                <label>
                                    <input type="radio" name="inquiry_type" value="Wholesale" />
                                    Wholesale
                                </label>
                                <label>
                                    <input type="radio" name="inquiry_type" value="Support" />
                                    Support
                                </label>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" rows="5" required class="form-control" placeholder="Tell us how we can help..."></textarea>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn-send">Send Message</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT: Contact Information -->
            <div class="col-lg-5 col-md-12">
                <div class="contact-info-card">
                    <h4>Contact Information</h4>

                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="fa fa-map-marker"></i></div>
                        <div>
                            <p class="ci-label">Address</p>
                            <?php
                            $settingsd_c = $this->db->select("*")->from('app_settings')->get()->result_array();
                            $settings_c = [];
                            foreach ($settingsd_c as $s) { $settings_c[$s['name']] = $s['value']; }
                            ?>
                            <p class="ci-value"><?= !empty($settings_c['site_address']) ? $settings_c['site_address'] : 'Marlota Limited, Manchester, United Kingdom'; ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="fa fa-envelope"></i></div>
                        <div>
                            <p class="ci-label">Email</p>
                            <p class="ci-value"><?= !empty($settings_c['site_email']) ? $settings_c['site_email'] : 'support@marlota.co.uk'; ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="fa fa-phone"></i></div>
                        <div>
                            <p class="ci-label">Phone</p>
                            <p class="ci-value"><?= !empty($settings_c['site_phone']) ? $settings_c['site_phone'] : '01234 567 890'; ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="fa fa-clock-o"></i></div>
                        <div>
                            <p class="ci-label">Business Hours</p>
                            <p class="ci-value">Mon – Fri: 9:00 AM – 5:00 PM<br>Sat – Sun: Closed</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="follow-title">Follow Us</p>
                        <div class="social-icons-contact">
                            <a href="https://www.facebook.com/" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="https://www.instagram.com/" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.linkedin.com/" target="_blank" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     CTA BANNER
========================================= -->
<section class="marlota-cta">
    <div class="container">
        <div class="d-flex align-items-center flex-wrap gap-4">
            <div class="cta-icon-wrap">📦</div>
            <div class="flex-grow-1">
                <h4>Looking for quality packaging and supplies?</h4>
                <p>Explore our wide range of products.</p>
            </div>
            <a href="<?= base_url('products'); ?>" class="btn-cta">Shop Products</a>
        </div>
    </div>
</section>

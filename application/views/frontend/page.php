<?php
/* Derive a friendly page title from the URL segment if $page_title isn't set */
if (!isset($page_title)) {
    $raw = $this->uri->segment(1);
    $page_title = ucwords(str_replace('_', ' ', $raw));
}
?>

<!-- ========================================
     HERO SECTION
========================================= -->
<section class="marlota-page-hero marlota-page-hero-generic">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12">
                <div class="breadcrumb-hero">
                    <a href="<?= base_url(); ?>">Home</a>
                    <span>&rsaquo;</span>
                    <span><?= htmlspecialchars($title); ?></span>
                </div>
                <h1><?php echo htmlspecialchars($title); ?></h1>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     PAGE CONTENT
========================================= -->
<section class="marlota-page-content-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-md-12">
                <div class="page-content-card">
                    <?= $content; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* ---- Generic page hero ---- */
    .marlota-page-hero-generic {
        background: #3a1b76;
        padding: 36px 0 40px;
    }

    .marlota-page-hero-generic .breadcrumb-hero a,
    .marlota-page-hero-generic .breadcrumb-hero span {
        color: rgba(255, 255, 255, 0.80);
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
    }

    .marlota-page-hero-generic .breadcrumb-hero {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
    }

    .marlota-page-hero-generic h1 {
        color: #ffffff;
        font-family: 'Poppins', sans-serif;
        font-weight: 800;
        font-size: 36px;
        margin: 0;
    }

    /* ---- Content section ---- */
    .marlota-page-content-section {
        background: #f9f6f1;
        padding: 56px 0 72px;
    }

    .page-content-card {
        background: #ffffff;
        border: 1px solid #e8e8e8;
        border-top: 4px solid #3a1b76;
        border-radius: 14px;
        padding: 48px 52px;
        box-shadow: 0 4px 24px rgba(58, 27, 118, 0.07);
        font-family: 'Poppins', sans-serif;
        color: #1E1E1E;
    }

    .page-content-card h1,
    .page-content-card h2,
    .page-content-card h3,
    .page-content-card h4,
    .page-content-card h5,
    .page-content-card h6 {
        font-family: 'Poppins', sans-serif;
        color: #3a1b76;
        font-weight: 700;
        margin-top: 32px;
        margin-bottom: 12px;
        line-height: 1.3;
    }

    .page-content-card h1 { font-size: 28px; margin-top: 0; }
    .page-content-card h2 { font-size: 24px; }
    .page-content-card h3 { font-size: 20px; }
    .page-content-card h4 { font-size: 17px; }

    .page-content-card p {
        font-size: 15px;
        line-height: 1.82;
        color: #4A4A4A;
        margin: 0 0 18px;
        font-family: 'Poppins', sans-serif;
    }

    .page-content-card ul,
    .page-content-card ol {
        font-size: 15px;
        line-height: 1.82;
        color: #4A4A4A;
        padding-left: 24px;
        margin-bottom: 18px;
        font-family: 'Poppins', sans-serif;
    }

    .page-content-card ul li,
    .page-content-card ol li {
        margin-bottom: 8px;
    }

    .page-content-card a {
        color: #3a1b76;
        text-decoration: underline;
        font-family: 'Poppins', sans-serif;
    }

    .page-content-card a:hover {
        color: #C9A646;
    }

    .page-content-card hr {
        border: none;
        border-top: 1px solid #e8e8e8;
        margin: 28px 0;
    }

    .page-content-card strong {
        color: #1E1E1E;
        font-weight: 700;
    }

    .page-content-card table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
    }

    .page-content-card table th {
        background: #3a1b76;
        color: #fff;
        padding: 10px 14px;
        text-align: left;
    }

    .page-content-card table td {
        padding: 9px 14px;
        border-bottom: 1px solid #ede9f5;
        color: #4A4A4A;
    }

    .page-content-card table tr:last-child td {
        border-bottom: none;
    }

    @media (max-width: 767px) {
        .page-content-card {
            padding: 28px 20px;
        }

        .marlota-page-hero-generic h1 {
            font-size: 26px;
        }
    }
</style>

<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="content-page">
    <div class="content">
        <div class="container-fluid">

            <!-- page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Page</h4>
                    </div>
                </div>
            </div>

            <!-- flash message -->
            <div class="row">
                <div class="col-12">
                    <?=$this->CI->flash_message();?>
                </div>
            </div>

            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" role="form" action="" method="post" id="page-form">

                                <div class="mb-3">
                                    <label class="col-form-label" for="name">Page Name <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="name"
                                           name="name"
                                           class="form-control"
                                           placeholder="e.g. About Us"
                                           maxlength="255"
                                           value="<?=htmlspecialchars($page['name'], ENT_QUOTES, 'UTF-8');?>"
                                           required>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label" for="slug">Slug <span class="text-danger">*</span></label>
                                    <input type="text"
                                           id="slug"
                                           name="slug"
                                           class="form-control"
                                           placeholder="e.g. about-us"
                                           maxlength="255"
                                           value="<?=htmlspecialchars($page['slug'], ENT_QUOTES, 'UTF-8');?>"
                                           required>
                                    <small class="text-muted">Lowercase letters, numbers and hyphens only. Used in the page URL.</small>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Content</label>
                                    <div id="page-editor" style="height: 350px;"></div>
                                    <input type="hidden" id="content" name="content" value="<?=htmlspecialchars($page['content'], ENT_QUOTES, 'UTF-8');?>" />
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        <i class="ri-save-line"></i> Update Page
                                    </button>
                                    <a href="<?=base_url('admin/pages');?>" class="btn btn-secondary waves-effect ms-1">
                                        Cancel
                                    </a>
                                </div>

                            </form>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
                <div class="col-2"></div>
            </div><!-- end row -->

        </div><!-- end container-fluid -->
    </div><!-- end content -->
</div><!-- end content-page -->



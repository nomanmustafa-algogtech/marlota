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
                        <h4 class="page-title">All Pages</h4>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-2">
                                <div class="col-12 text-end">
                                    <a href="<?=base_url('admin/pages/add');?>" class="btn btn-primary waves-effect waves-light">
                                        <i class="ri-add-line"></i> Add New Page
                                    </a>
                                </div>
                            </div>

                            <table class="table dt-responsive nowrap w-100 basic-datatable">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="25%">Name</th>
                                        <th width="30%">Slug</th>
                                        <th width="25%">Content Preview</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sn = 0;
                                    if ($pages):
                                        foreach ($pages as $row):
                                            $sn++;
                                    ?>
                                    <tr>
                                        <td><?=$sn;?></td>
                                        <td><?=htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');?></td>
                                        <td><code><?=htmlspecialchars($row['slug'], ENT_QUOTES, 'UTF-8');?></code></td>
                                        <td><?=htmlspecialchars(strip_tags(mb_substr($row['content'], 0, 80)), ENT_QUOTES, 'UTF-8');?><?=(strlen(strip_tags($row['content'])) > 80 ? '...' : '');?></td>
                                        <td>
                                            <a href="<?=base_url('admin/pages/edit/' . $row['id']);?>" class="btn btn-success btn-bordered rounded-pill btn-xs waves-effect waves-light" title="Edit">
                                                <i class="ri-edit-box-line"></i>
                                            </a>
                                            <button type="button"
                                                onclick="if(confirm('Are you sure you want to delete this page?')){ window.location.href='<?=base_url('admin/pages/delete/' . $row['id']);?>'; }"
                                                class="btn btn-danger btn-bordered rounded-pill btn-xs waves-effect waves-light" title="Delete">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php
                                        endforeach;
                                    else:
                                    ?>
                                    <tr class="footable-empty">
                                        <td colspan="5">
                                            <i class="ri-file-list-3-line" style="font-size:60px" aria-hidden="true"></i><br>
                                            No pages found
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div>
            </div><!-- end row -->

        </div><!-- end container-fluid -->
    </div><!-- end content -->
</div><!-- end content-page -->

<style>
    .dataTables_length {
        display: none;
    }

    <?php if ($ln == 'ar') { ?>.dataTables_filter {
        float: left;
    }

    #user-listing_paginate {
        float: left;
    }

    <?php } else { ?>.dataTables_filter {
        float: right;
    }

    #user-listing_paginate {
        float: right;
    }

    <?php } ?>
</style>

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="< ?php echo base_url('permission') ?>">< ?php echo $this->lang->line('permissions'); ?></a></li>-->
                <li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('OWNERS'); ?></li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?php echo $this->lang->line('OWNERS'); ?>
                <a href="<?php echo base_url('add-owners'); ?>" class="<?php echo ($ln == 'en') ? 'pull-right' : 'pull-left'; ?> btn btn-sm btn-success text-white"> <?php echo $this->lang->line('add'); ?> <?php //echo $this->lang->line('portal_users'); 
                                                                                                                                                                                                                ?> </a>
            </h4><br /><br />

            <div class="row">
                <div class="col-12">
                    <div class="">

                        <table id="user-listing" class="table table-header-rotated">
                            <thead>
                                <tr>

                                    <th><?php echo $this->lang->line('S.NO'); ?></th>
                                    <th><?php echo $this->lang->line('action'); ?></th>
                                    <th style="text-align:center;"><?php echo $this->lang->line('FULLNAME'); ?></th>
                                    <th style="text-align:center;"><?php echo $this->lang->line('MOBILE'); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($owners as $owners) { ?>
                                    <tr class="sort-row lightGallery" id="medid_<?php echo $owners->id ?>">
                                        <td><?php echo $i; ?>
                                        <td>
                                            <div class="btn-group" role="owners" aria-label="">
                                                <button title="<?php echo $this->lang->line('edit'); ?>" onclick="editowners(<?php echo $owners->id ?>);" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                                                <button title="<?php echo $this->lang->line('deleteowners'); ?>" onclick="deleteowners(<?php echo $owners->id ?>)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>

                                            </div>
                                        </td>
                                        <td align="center"><?php echo $owners->fullName; ?></td>
                                        <td align="center"><?php echo $owners->mobileNumber; ?></td>
                                    </tr>
                                <?php $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- content-wrapper ends -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
<!-- <script src="< ?php echo base_url('assets/vendors/sweetalert/sweetalert.min.js') ?>"></script>	-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js?v=2'); ?>"></script>




<script>
    (function($) {
        'use strict';
        $(function() {
            $('#user-listing').DataTable({
                "aLengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "iDisplayLength": 10,
                "ordering": false,
                "language": {
                    <?php if ($ln == 'ar') { ?> "url": "<?php echo base_url('assets/vendors/datatables.net/Arabic.json'); ?>"
                    <?php } else { ?> "url": ""
                    <?php } ?>
                }
            });
            $('#user-listing').each(function() {
                var datatable = $(this);
                // SEARCH - Add the placeholder for Search and Turn this into in-line form control
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                // LENGTH - Inline-Form control
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        });
    })(jQuery);

    function editowners(id) {
        window.location.href = '<?php echo base_url('owners/editOwners/') ?>' + id;
    }


    function deleteowners(ID) {

        swal.fire({
            title: '<?php echo $this->lang->line('are_you_sure'); ?>',
            text: "<?php echo $this->lang->line('you_wont_revert_this'); ?>",
            icon: 'warning',
            showCancelButton: true,
            <?php if ($ln == 'ar') { ?>
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا',
            <?php } ?>
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = '<?php echo base_url('delete-owners/') ?>' + ID;

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        })

    }

    <?php if (!empty($this->session->flashdata('errowners'))) {  ?>
        showDangerToast('<?php echo $this->session->flashdata('errowners') ?>', '<?php echo $this->lang->line('danger')  ?>');
    <?php  } ?>

    <?php if (!empty($this->session->flashdata('successowners'))) { ?>
        showSuccessToast('<?php echo $this->session->flashdata('successowners') ?>', '<?php echo $this->lang->line('success')  ?>');
    <?php  } ?>
</script>
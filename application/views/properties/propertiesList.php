<?php $sess = (object)($this->session->userdata); ?>
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


<link href="<?php echo base_url('assets/static/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet" />


<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('PROPERTIES_UNITS'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>" class="text-muted"><?php echo $this->lang->line('DASHBOARD'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('PROPERTIES_AND_UNITS'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <a href="<?php echo base_url('add-properties'); ?>" style="border-radius: 50px;" class="btn btn-primary text-white"><?php echo $this->lang->line('add'); ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                        <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1 ) : ?>
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('S.NO'); ?></th>
                                        <th><?php echo $this->lang->line('EDIT'); ?></th>
                                        <th><?php echo $this->lang->line('TRASH'); ?></th>
                                        <th><?php echo $this->lang->line('OWNER'); ?></th>
                                        <th><?php echo $this->lang->line('PROPERTY_NAME'); ?></th>
                                        <th><?php echo $this->lang->line('NUMBER_OF_RESIDENTIAL_UNITS'); ?></th>
                                        <th><?php echo $this->lang->line('NUMBER_OF_COMMERCIAL_UNITS'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    $properties = count($searched_data)>0?$searched_data:$properties;
                                    foreach ($properties as $properties) { ?>
                                        <tr class="sort-row lightGallery" id="medid_<?php echo $properties->id ?>">
                                            <td><?php echo $i; ?></td>

                                            <th>
                                                <button title="<?php echo $this->lang->line('edit'); ?>" onclick="editproperties(<?php echo $properties->pId ?>);" type="button" class="btn btn-sm btn-light"> <i class="fas fa-edit text-primary"></i></button>

                                            </th>
                                            <th>
                                                <button title="<?php echo $this->lang->line('deleteproperties'); ?>" onclick="deleteproperties(<?php echo $properties->pId ?>)" type="button" class="btn btn-sm btn-light"><i class="fas fa-trash text-danger"></i></button>

                                            </th>
                                            <td><?php echo $properties->fullName; ?></td>
                                            <td><?php echo $properties->propertyName; ?></td>
                                            <td><?php echo $properties->residentialUnits; ?></td>
                                            <td><?php echo $properties->commercialUnits; ?></td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>

                            </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer text-center text-muted">
        All Rights Reserved by Web Art vision. Designed and Developed by <a href="https://webartvision.com">Web Art Vision</a>.
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>



<!-- content-wrapper ends -->


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

    function editproperties(id) {
        window.location.href = '<?php echo base_url('properties/editproperties/') ?>' + id;
    }


    function deleteproperties(ID) {

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
                window.location.href = '<?php echo base_url('delete-properties/') ?>' + ID;

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        })

    }

    <?php if (!empty($this->session->flashdata('errproperties'))) {  ?>
        showDangerToast('<?php echo $this->session->flashdata('errproperties') ?>', '<?php echo $this->lang->line('danger')  ?>');
    <?php  } ?>

    <?php if (!empty($this->session->flashdata('successproperties'))) { ?>
        showSuccessToast('<?php echo $this->session->flashdata('successproperties') ?>', '<?php echo $this->lang->line('success')  ?>');
    <?php  } ?>
</script>
<script src="<?php echo base_url('assets/static/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/static/dist/js/pages/datatable/datatable-basic.init.js'); ?>"></script>
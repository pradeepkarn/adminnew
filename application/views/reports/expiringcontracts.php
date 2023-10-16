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
                <h4 class="page-title text-truncate text-dark text-start font-weight-medium mb-1"><?php echo $this->lang->line('EXPIRING_CONTRACTS'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>" class="text-muted"><?php echo $this->lang->line('DASHBOARD'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('EXPIRING_CONTRACTS'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <?php if ($sess->ag_can_create == 1) : ?>
                    <!-- <div class="customize-input float-<?php echo rtl ? 'left' : 'right'; ?>">
                        <a href="<?php echo base_url('add-tenants'); ?>" style="border-radius: 50px;" class="btn btn-primary text-white"><?php echo $this->lang->line('add'); ?></a>
                    </div> -->
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 ms-auto my-3">
                <select id="filter" name="filter" class="form-select">
                    <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '') {
                                echo "selected";
                            } ?> value=""><?php echo $this->lang->line('ALL'); ?></option>
                    <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '1') {
                                echo "selected";
                            } ?> value="1"><?php echo $this->lang->line('ACTIVE'); ?></option>
                    <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '0') {
                                echo "selected";
                            } ?> value="0"><?php echo $this->lang->line('INACTIVE'); ?></option>
                    <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '2') {
                                echo "selected";
                            } ?> value="2"><?php echo $this->lang->line('SUSPENDED'); ?></option>
                </select>
                <script>
                    // Get a reference to the select element
                    const filterSelect = document.getElementById("filter");

                    // Add an event listener to detect changes
                    filterSelect.addEventListener("change", function() {
                        // Get the selected value
                        const selectedValue = filterSelect.value;

                        // Construct the new URL with the filter parameter
                        const currentUrl = window.location.href;
                        const baseUrl = currentUrl.split('?')[0]; // Get the base URL without query parameters

                        // Check if the selected value is not empty
                        if (selectedValue !== "") {
                            const newUrl = `${baseUrl}?filter=${selectedValue}`;
                            // Redirect to the new URL
                            window.location.href = newUrl;
                        } else {
                            // If the selected value is empty, remove the filter parameter from the URL
                            window.location.href = baseUrl;
                        }
                    });
                </script>
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
                            <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1) : ?>
                                <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo $this->lang->line('CONTRACT_NUMBER'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('EXPIRY_DATE'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('DAYS_LEFT'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('BUILDING_STATEMENT'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('TENANT_NAME'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('INSTALLMENT_DATE'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('INSTALLMENT_AMOUNT'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('PAID_AMOUNT'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('PENDING_AMOUNT'); ?>
                                            </th>
                                            <th>
                                                <?php echo $this->lang->line('PAID_DATE'); ?>
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1;
                                        $expiringcontracts = count($searched_data) > 0 ? $searched_data : $expiringcontracts;
                                        foreach ($expiringcontracts as $inst) { 
                                            $active = $this->lang->line('DAYS_ACTIVE');
                                            $expired = $this->lang->line('DAYS_EXPIRED');
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $inst->contractNumber; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst->expiryDate; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst->days_left; ?>
                                                    <br>
                                                    <?php echo $inst->days_left >0 ? "<span class='badge bg-success'>$active</span>":"<span class='badge bg-danger'>$expired</span>"; ?>
                                                </td>
                                                <td>
                                                    <?php echo $inst->propertyName; ?>
                                                </td>
                                                <td><?php echo $inst->tenantName; ?></td>
                                                <td><?php echo $inst->installmentDate; ?></td>
                                                <td><?php echo $inst->installmentAmount; ?></td>
                                                <td><?php echo $inst->paidAmount; ?></td>
                                                <td><?php echo $inst->pendingAmount; ?></td>
                                                <td><?php echo $inst->paidDate; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>

                                </table>
                            <?php endif; ?>
                            
                        </div>
                        <a download="" id="exportcsvbtn" href="<?php echo base_url(); ?>attachments/data/csv/expiringcontracts.csv" class="my-3 btn btn-info"><?php echo $this->lang->line('EXPORT_AS_CSV'); ?> <i class="bi bi-filetype-csv"></i> </a>
                        <a download="" id="exportcsvbtn" href="<?php echo base_url(); ?>attachments/data/pdf/expiringcontracts.pdf" class="my-3 btn btn-success"><?php echo $this->lang->line('EXPORT_AS_PDF'); ?> <i class="bi bi-filetype-pdf"></i> </a>
                    
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


<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>




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

    function edittenants(id) {
        window.location.href = '<?php echo base_url('tenants/edittenants/') ?>' + id;
    }
    function deletetenants(ID) {

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
                window.location.href = '<?php echo base_url('delete-tenants/') ?>' + ID;

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        })

    }

    <?php if (!empty($this->session->flashdata('errtenants'))) {  ?>
        showDangerToast('<?php echo $this->session->flashdata('errtenants') ?>', '<?php echo $this->lang->line('danger')  ?>');
    <?php  } ?>

    <?php if (!empty($this->session->flashdata('successtenants'))) { ?>
        showSuccessToast('<?php echo $this->session->flashdata('successtenants') ?>', '<?php echo $this->lang->line('success')  ?>');
    <?php  } ?>
</script>

<!--This page plugins -->

<script src="<?php echo base_url('assets/static/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/static/dist/js/pages/datatable/datatable-basic.init.js'); ?>"></script>
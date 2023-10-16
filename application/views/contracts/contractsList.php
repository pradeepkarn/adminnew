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

    div.swal2-icon-content {
        font-size: 50px !important;
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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('CONTRACTS'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html" class="text-muted"><?php echo $this->lang->line('DASHBOARD'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('CONTRACTS'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-right">
                    <a href="<?php echo base_url('add-contracts'); ?>" style="border-radius: 50px;" class="btn btn-primary text-white"><?php echo $this->lang->line('add'); ?></a>
                </div>
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


                        <div class="row">
                            <div class="col-12">

                                <div class="col-12 table-responsive">
                                    <?php
                                    if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1) : ?>
                                        <table id="user-listing" class="table">
                                            <thead>
                                                <tr>

                                                    <!-- <th><?php echo $this->lang->line('S.NO'); ?></th> -->


                                                    <th><?php echo $this->lang->line('action'); ?></th>
                                                    <th style="text-align:center;"><?php echo $this->lang->line('PROPERTY_NAME'); ?></th>
                                                    <th style="text-align:center;"><?php echo $this->lang->line('UNIT_NUMBER'); ?></th>
                                                    <th style="text-align:center;"><?php echo $this->lang->line('CONTRACT_NUMBER'); ?></th>
                                                    <th style="text-align:center;"><?php echo $this->lang->line('START_DATE'); ?></th>
                                                    <th style="text-align:center;"><?php echo $this->lang->line('EXPIRY_DATE'); ?></th>
                                                    <th>Delete</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $sno = 1;
                                                // print_r($contracts);
                                                $contracts = count($searched_data) > 0 ? $searched_data : $contracts;
                                                foreach ($contracts as $contracts) { ?>

                                                    <tr class="sort-row lightGallery">
                                                        <!-- <td><?php echo $sno; ?> -->


                                                        <td>
                                                            <div role="contracts" aria-label="">

                                                                <!-- <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('PAYMENTS'); ?> </button><br><br>
                                                <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button><br><br>
                                                <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button><br><br>
                                                <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button><br><br>
                                                <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button><br><br> -->


                                                                <button title="<?php echo  $this->lang->line('UPDATE');
                                                                                ?>" onclick="update('<?php echo $contracts->contractNo; ?>');" type="button" class="btn btn-sm btn-success"><?php echo  $this->lang->line('UPDATE');
                                                                                                                                                                                            ?> </button><br><br>




                                                                <select id="contractStatus" name="contractStatus" class="form-control" style="width:50%;" value="<?php echo $sno; ?>" onchange="changeStatus('<?php echo $contracts->contractNo; ?>',this.value);">

                                                                    <option value="" hidden>Select</option>
                                                                    <option value="0" <?php if (($contracts->contractStatus) == 0) {
                                                                                            echo "selected";
                                                                                        } ?> style="
                                                                      <?php if (($contracts->contractStatus) == 2) { ?>
                                                                             display:none;
                                                                      <?php  }
                                                                        ?>"><?php echo $this->lang->line('INACTIVE'); ?> </option>
                                                                    <option value=" 1" <?php if (($contracts->contractStatus) == 1) {
                                                                                            echo "selected";
                                                                                        } ?>><?php echo $this->lang->line('ACTIVE'); ?></option>
                                                                    <option value="2" <?php if (($contracts->contractStatus) == 2) {
                                                                                            echo "selected";
                                                                                        } ?> style="
                                                                        <?php if (($contracts->contractStatus) == 0) {
                                                                            echo "display:none;";
                                                                        } ?>"><?php echo $this->lang->line('SUSPENDED'); ?></option>
                                                                </select>
                                                                <!-- </div> -->
                                                                <?php
                                                                // if ($contracts->paidStatus == 1) {
                                                                //     echo $this->lang->line('INSTALLMENT_NUMBER_PAID_COMPLETELY');
                                                                //     echo " (" . $contracts->installmentNo . " )";
                                                                // } else if ($contracts->paidStatus == 2) {
                                                                //     echo $this->lang->line('INSTALLMENT_NUMBER_PAID_PARTIALLY');
                                                                //     echo " (" . $contracts->installmentNo . " )";
                                                                // } else {
                                                                //     echo $this->lang->line('INSTALLMENT_NOT_YET_PAID');
                                                                // }
                                                                ?>
                                                                <!-- <button title=" <?php echo $this->lang->line('TENANT_PAYMENT_STATUS'); ?>" onclick="tenantPaymentStatus(<?php echo $contracts->contractNo ?>);" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('TENANT_PAYMENT_STATUS'); ?> </button><br> -->

                                                            </div>
                                                        </td>
                                                        <td align="center"><?php echo $contracts->propertyName; ?></td>
                                                        <td align="center"><?php
                                                                            $s = str_replace("R", $this->lang->line('R'), ($contracts->Name), $i);
                                                                            $s = str_replace("C", $this->lang->line('C'), ($s), $i);
                                                                            echo $s;
                                                                            ?>
                                                        </td>
                                                        <td align="center"><input type="text" id="contractNumber" type="contractNumber[]" value="<?php echo $contracts->contractNo; ?>" hidden><?php echo   $contracts->contractNo; ?></td>
                                                        <td align="center"><?php
                                                                            echo $contracts->startDate;
                                                                            $d = date_create($contracts->startDate);
                                                                            // echo date_format($d, 'd-m-Y');
                                                                            ?></td>
                                                        <td align="center"><?php
                                                                            echo $contracts->expiryDate;
                                                                            $ed = date_create($contracts->expiryDate);
                                                                            // echo date_format($ed, 'd-m-Y');
                                                                            // echo "<br>";
                                                                            // echo ($contracts->contractStatus);

                                                                            if ((($contracts->contractStatus) == 1)) {

                                                                                $date1 = date_format(date_create($contracts->expiryDate), 'Y-m-d');
                                                                                $date2 = date('Y-m-d');

                                                                                if ($date1 < $date2) {
                                                                                    // echo "date expired";
                                                                                    if ($contracts->renewStatus == 0) { ?>
                                                                        <br><Br> <button title="<?php echo  $this->lang->line('RENEW');
                                                                                                ?>" onclick="renew('<?php echo $contracts->contractNo ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('RENEW');
                                                                                                                                                                                                            ?> </button><br><br>

                                                                    <?php } else   if ($contracts->renewStatus == 1) { ?>
                                                                        <br><br> <button title="<?php echo  $this->lang->line('RENEW');
                                                                                                ?>" type="button" class="btn btn-sm btn-primary"><?php echo  $this->lang->line('RENEWED_ALREADY');
                                                                                                                                                    ?> </button><br><br>

                                                                        <?php  }
                                                                                } else {

                                                                                    if ($contracts->renewStatus == 0) {
                                                                                        $diff = (strtotime($date2) - strtotime($date1));

                                                                                        $years = floor($diff / (365 * 60 * 60 * 24));
                                                                                        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
                                                                                        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
                                                                                        // echo "years =  " . $years;
                                                                                        // echo "<br>";
                                                                                        // echo "months =  " . $months;
                                                                                        // echo "<br>";
                                                                                        // echo "dys =  " . $days;
                                                                                        if (($years == -1) || ($years == 0)) {
                                                                                            if ($years == -1) {
                                                                                                if (($months == 11) || ($months == 12)) {  ?>
                                                                                    <br><br> <button title="<?php echo  $this->lang->line('RENEW');
                                                                                                            ?>" onclick="renew('<?php echo $contracts->contractNo ?>');" type="button" class="btn btn-sm btn-success"><?php echo  $this->lang->line('RENEW');
                                                                                                                                                                                                                        ?> </button><br><br>

                                                                                <?php   }
                                                                                            } else if ($years == 0) {
                                                                                                if ($months == 0) { ?>
                                                                                    <br><br> <button title="<?php echo  $this->lang->line('RENEW');
                                                                                                            ?>" onclick="renew('<?php echo $contracts->contractNo ?>');" type="button" class="btn btn-sm btn-success"><?php echo  $this->lang->line('RENEW'); ?> </button><br><br>

                                                                        <?php  }
                                                                                            }
                                                                                        }
                                                                                    } else   if ($contracts->renewStatus == 1) { ?>
                                                                        <br><br> <button title="<?php echo  $this->lang->line('RENEW');
                                                                                                ?>" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('RENEWED_ALREADY');
                                                                                                                                                    ?> </button><br><br>
                                                            <?php  }
                                                                                }
                                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($sess->ag_can_delete == 1) : ?>
                                                                <button title="Delete" onclick="deletecontracts(`<?php echo $contracts->contractNo; ?>`)" type="button" class="btn btn-sm btn-danger">Delete</button><br><br>
                                                                <a href="<?php echo base_url('edit-contracts') . "/$contracts->contractNo"; ?>" class="btn btn-primary btn-sm text-white">Edit</a>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>

                                                <?php $i++;
                                                    $sno++;
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
    function changeStatus(ID, contractStatus) {



        $.ajax({
            url: "<?php echo site_url(); ?>contracts/changeContractStatus",
            dataType: 'json',
            method: "POST",
            data: {
                status: contractStatus,
                contractNumber: ID
            },
            success: function(data) {

                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/';
                    }, 4000);
                } else {
                    showDangerToast(data.message, '<?php echo $this->lang->line('danger')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/';
                    }, 4000);
                }
            }
        });

    }





    (function($) {
        'use strict';
        $(function() {
            $('#user-listing').DataTable({
                "aLengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "iDisplayLength": 15,
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



    function payments(id) {

        window.location.href = '<?php echo base_url('contracts/payments/') ?>' + id;
    }

    function update(id) {

        window.location.href = '<?php echo base_url('contracts/payments/') ?>' + id;
    }


    function expenses(id) {

        window.location.href = '<?php echo base_url('contracts/expenses/') ?>' + id;
    }

    function management(id) {

        window.location.href = '<?php echo base_url('contracts/management/') ?>' + id;
    }

    function ownersdue(id) {

        window.location.href = '<?php echo base_url('contracts/ownersdue/') ?>' + id;
    }

    function statement(id) {

        window.location.href = '<?php echo base_url('contracts/statement/') ?>' + id;
    }

    // function contractStatus(id) {

    //     window.location.href = '<?php echo base_url('contracts/contractStatus/') ?>' + id;
    // }

    function tenantPaymentStatus(id) {

        window.location.href = '<?php echo base_url('contracts/tenantPaymentStatus/') ?>' + id;
    }

    function renew(id) {

        window.location.href = '<?php echo base_url('renew-contracts/') ?>' + id;
    }

    function deletecontracts(contractNo) {

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
                window.location.href = '<?php echo base_url('delete-contracts/') ?>' + contractNo;

            } else if (result.dismiss === Swal.DismissReason.cancel) {

            }
        })

    }

    <?php if (!empty($this->session->flashdata('errcontracts'))) {  ?> showDangerToast('<?php echo $this->session->flashdata('errcontracts') ?>', '<?php echo $this->lang->line('danger')  ?>');
    <?php  } ?>

    <?php if (!empty($this->session->flashdata('successcontracts'))) { ?> showSuccessToast('<?php echo $this->session->flashdata('successcontracts') ?>', '<?php echo $this->lang->line('success')  ?>');
    <?php  } ?>
</script>


<script src="<?php echo base_url('assets/static/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/static/dist/js/pages/datatable/datatable-basic.init.js'); ?>"></script>
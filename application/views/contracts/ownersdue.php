<?php

$sess = (object)($this->session->userdata); ?>
<link href="<?php echo base_url('assets/static/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet" />
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('OWNER_DUES'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('contracts') ?>" class="text-muted"><?php echo $this->lang->line('CONTRACTS'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('OWNER_DUES'); ?></li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <!-- <div class="customize-input float-right">
                    <a href="<?php echo base_url('add-contracts'); ?>" style="border-radius: 50px;" class="btn btn-primary text-white"><?php echo $this->lang->line('add'); ?></a>
                </div> -->
            </div>
        </div>
    </div>

    <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1) : ?>
        <div class="container-fluid text-center">
            <?php if (!isset($contractsData->contractNumber)) :
                $contractNumber = $ID;
            else :
                $contractNumber = $contractsData->contractNumber;
            endif;
            ?>

            <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button>
            <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('PAYMENTS'); ?> </button>
            <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button>
            <!-- <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button> -->
            <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button>

            <!-- <div class="w3-row">
                <a href="javascript:void(0)" onclick="openTab(event, 'ownersdue');">
                    <div class="w3-third tablink w3-bottombar w3-border-red w3-padding"><?php echo $this->lang->line('OWNER_DUES'); ?></div>
                </a>
                <a href="javascript:void(0)" onclick="openTab(event, 'Records');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><?php echo $this->lang->line('RECORDS'); ?></div>
                </a>
            </div> -->
            <div class="d-block mt-4">
                <button type="button" type="button" class="btn btn-sm btn-primary" onclick="openTab(event, 'ownersdue');">
                    <div class="tablink">
                        <?php echo $this->lang->line('OWNER_DUES'); ?>
                    </div>
                </button>
                <button type="button" type="button" class="btn btn-sm btn-success" onclick="openTab(event, 'Records');">
                    <div class="tablink">
                        <?php echo $this->lang->line('RECORDS'); ?>
                    </div>
                </button>
            </div>
            <div class="alert alertSuccess">

            </div>
            <div id="ownersdue" class="w3-container city mt-4">
                <div class="table-responsive">
                    <table class="table" border="1" style="width: 200%">
                        <thead>
                            <tr>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('ITEM'); ?></th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('DUE_DATE'); ?></th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('DUE_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('RECEIVED_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PENDING_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PAYMENT_DATE'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('NOTES'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('STATUS'); ?> </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if (!empty($contractsData)) {


                                $in  = $contractsData->installments;
                                $dt = strtotime($contractsData->startDate);
                                $dates = [$contractsData->startDate];
                                if ($in == 1) {
                                    $add = 12 * $contractsData->contractPeriod;
                                    $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                    $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                    array_push($dates, $dt3);
                                } else  if ($in == 2) {
                                    $add = 6 * $contractsData->contractPeriod;

                                    for ($i = 1; $i <= 2; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 4) {
                                    $add = 3 * $contractsData->contractPeriod;
                                    for ($i = 1; $i <= 4; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 12) {
                                    $add = 1 * $contractsData->contractPeriod;
                                    for ($i = 1; $i <= 12; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                }




                            ?>

                                <?php


                                for ($i = 1; $i <= $in; $i++) {
                                    $installmentStatus = 0;
                                    if ((!empty($ownersdueData[$i - 1]->pendingAmount) && ($ownersdueData[$i - 1]->pendingAmount != 0))) {

                                        $totalRent = $ownersdueData[$i - 1]->pendingAmount;
                                    } else {

                                        if (($expenseData)) {

                                            for ($j = 0; $j <= (sizeof($expenseData) - 1); $j++) {

                                                if ($i == $expenseData[$j]->chargeTo) {
                                                    $installmentAmount = (($ownersdueData[0]->rentAmount + $ownersdueData[0]->waterFee + $ownersdueData[0]->electricityFee + $ownersdueData[0]->otherFee) / $ownersdueData[0]->installments);

                                                    if (($ownersdueData[0]->mgmtFeesPercentage) != 0) {

                                                        $managementAmount = (($ownersdueData[0]->mgmtFeesPercentage / 100) * $installmentAmount);
                                                    } else  if (($ownersdueData[0]->mgmtFeesFixed) != 0) {

                                                        $managementAmount =  ($ownersdueData[0]->mgmtFeesFixed / $ownersdueData[0]->installments);
                                                    } else {
                                                        $managementAmount = 0;
                                                    }

                                                    $expenseAmount = $expenseData[$j]->expenseAmount;

                                                    break;
                                                } else {
                                                    $installmentAmount = (($ownersdueData[0]->rentAmount + $ownersdueData[0]->waterFee + $ownersdueData[0]->electricityFee + $ownersdueData[0]->otherFee) / $ownersdueData[0]->installments);
                                                    if (($ownersdueData[0]->mgmtFeesPercentage) != 0) {

                                                        $managementAmount = (($ownersdueData[0]->mgmtFeesPercentage / 100) * $installmentAmount);
                                                    } else  if (($ownersdueData[0]->mgmtFeesFixed) != 0) {

                                                        $managementAmount =  ($ownersdueData[0]->mgmtFeesFixed / $ownersdueData[0]->installments);
                                                    } else {
                                                        $managmentAmount = 0;
                                                    }

                                                    $expenseAmount = 0;
                                                }
                                            }
                                        } else {

                                            $installmentAmount = (($ownersdueData[0]->rentAmount + $ownersdueData[0]->waterFee + $ownersdueData[0]->electricityFee + $ownersdueData[0]->otherFee) / $ownersdueData[0]->installments);

                                            if (($ownersdueData[0]->mgmtFeesPercentage) != 0) {

                                                $managementAmount = (($ownersdueData[0]->mgmtFeesPercentage / 100) * $installmentAmount);
                                            } else  if (($ownersdueData[0]->mgmtFeesFixed) != 0) {

                                                $managementAmount =  ($ownersdueData[0]->mgmtFeesFixed / $ownersdueData[0]->installments);
                                            } else {
                                                $managementAmount = 0;
                                            }

                                            $expenseAmount = 0;
                                        }
                                        if (sizeof($installmentData) > 0) {
                                            for ($inst = 0; $inst <= sizeof($installmentData) - 1; $inst++) {
                                                if ($i == $installmentData[$inst]->installmentNumber) {
                                                    $installmentStatus = $installmentData[$inst]->paidStatus;
                                                }
                                            }
                                        } else {
                                            $installmentStatus = 0;
                                        }


                                        $totalRent = $installmentAmount - $managementAmount - $expenseAmount;
                                    }


                                    if (sizeof($ownersdueData) >= 1) {

                                        for ($kk = 0; $kk <= sizeof($ownersdueData) - 1; $kk++) {
                                            if (isset($ownersdueData[$kk]->installmentNumber)) {
                                                if ($i == $ownersdueData[$kk]->installmentNumber) {

                                                    $totalPaidAmount = $ownersdueData[$kk]->totalPaidAmount;
                                                    $status = 1;
                                                    break;
                                                } else {
                                                    $totalPaidAmount = "0.00";
                                                    $status = 0;
                                                }
                                            } else {
                                                $totalPaidAmount = "0.00";
                                                $status = 0;
                                            }
                                        }
                                    } else {
                                        $totalPaidAmount = "0.00";
                                        $status = 0;
                                    }



                                    if (isset($ownersdueData[$i - 1]->pendingAmount)) {
                                        $pendingAmount = $ownersdueData[$i - 1]->pendingAmount;
                                    } else {
                                        $pendingAmount =   $totalRent;
                                    }


                                ?>
                                    <tr>
                                        <td>
                                            <?php echo  $this->lang->line('OWNER_DUES') . "( " . $i . " )<br>  "; ?>
                                            <input type="text" id="contractNumber" value="<?php echo ($ownersdueData[0]->contractNumber); ?>" hidden>
                                            <input type="number" id="paymentMaxAmount" name="paymentMaxAmount[]" value="<?php echo $totalRent; ?>" hidden>
                                            <input type="number" id="totalInstallment" name="totalInstallment" value="<?php echo ($ownersdueData[0]->installments); ?>" hidden>


                                        </td>

                                        <td><input type="date" id="installmentDate" name="installmentDate" style="background: rgba(0, 0, 0, 0); border: none;" value="<?php $d = date_create($dates[$i - 1]);
                                                                                                                                                                        echo date_format($d, 'Y-m-d');
                                                                                                                                                                        ?>" readonly> </td>
                                        <td><input type="text" class="form-control input-lg paymentAmount" name="paymentAmount[]" id="paymentAmount" value="<?php echo  $totalRent; ?>" <?php
                                                                                                                                                                                        if ((isset($status) && ($status == 1)) || ($totalRent == 0)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> readonly></td>
                                        <td><input type="number" class="form-control input-lg" name="paidAmount" style="background: rgba(0, 0, 0, 0); border: none;" id="paidAmount" value="<?php echo $totalPaidAmount;    ?>" readonly></td>
                                        <td><input type="number" class="form-control input-lg" name="pendingAmount[]" style="background: rgba(0, 0, 0, 0); border: none; color:red;" id="pendingAmount" <?php if (isset($status) && ($status == 1)) { ?> value="0.00" <?php } else { ?> value="<?php echo $totalRent; ?>" <?php } ?> readonly></td>

                                        <td><input type="date" class="form-control" name="paymentDate[]" id="paymentDate" <?php
                                                                                                                            if ((isset($status) && ($status == 1)) || ($totalRent == 0)) {  ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> value="<?php if (isset($ownersdueData[$i - 1]->paidDate)) {
                                                                                                                                                                                                                                                                            echo ($ownersdueData[$i - 1]->paidDate);
                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                            echo  date('Y-m-d');
                                                                                                                                                                                                                                                                        } ?>"></td>

                                        <td>

                                            <input type="text" class="form-control input-lg" name="notes[]" id="notes" <?php
                                                                                                                        if ((isset($status) && ($status == 1)) || ($totalRent == 0)) {  ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?>>

                                        </td>
                                        <td> <?php

                                                if ((isset($status) && ($status == 1)) || ($totalRent == 0)) {
                                                    if (($totalRent == 0)) { ?>
                                                    <font color="blue"><b>-</b></font>

                                                <?php } else  if ((isset($status) && ($status == 1))) { ?>
                                                    <font color="blue"><b><?php echo $this->lang->line('COMPLETED'); ?></b></font>
                                                    <?php }
                                                } else {

                                                    if (isset($installmentStatus)) {
                                                        if ($installmentStatus == 1) {

                                                    ?>

                                                        <button id="<?php echo $i; ?>" onClick="receive(this.id)" title="<?php echo $this->lang->line('TRANSFER'); ?>" class="btn btn-sm btn-primary transferBtn">
                                                            <?php echo $this->lang->line('TRANSFER'); ?>
                                                        </button>
                                            <?php } else {
                                                            echo $this->lang->line('INSTALLMENT_NOT_YET_PAID');
                                                        }
                                                    }
                                                } ?>

                                        </td>
                                    </tr>
                                <?php }  ?>
                        </tbody>
                    <?php }
                    ?>
                    </table>
                </div>
            </div>

            <div id="Records" class="w3-container city" style="display:none">

                <div class="col-12 mt-4 table-responsive">
                    <table class="table" border="1" name="paymentTable" id="paymentTable">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('ITEM'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('TYPE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENT_NUMBER'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENT_DATE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('PAID_DATE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('PAID_AMOUNT'); ?> </th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('PENDING_AMOUNT'); ?> </th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('STATUS'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (sizeof($recordOwnersDueData) > 0) {
                                for ($i = 0; $i <= (sizeof($recordOwnersDueData) - 1); $i++) {
                            ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td><?php if ($recordOwnersDueData[$i]->type == 3) {
                                                echo $this->lang->line('OWNER_DUES');
                                            }   ?></td>

                                        <td><?php if ($recordOwnersDueData[$i]->installmentNumber == '') {
                                                echo "-";
                                            } else {
                                                echo $recordOwnersDueData[$i]->installmentNumber;
                                            } ?></td>
                                        <td><?php
                                            $d = date_create($recordOwnersDueData[$i]->installmentDate);
                                            echo date_format($d, 'd-m-Y'); ?></td>
                                        <td><?php
                                            $d = date_create($recordOwnersDueData[$i]->paidDate);
                                            echo date_format($d, 'd-m-Y'); ?></td>
                                        <td><?php echo $recordOwnersDueData[$i]->paidAmount; ?></td>
                                        <td><?php echo $recordOwnersDueData[$i]->pendingAmount; ?></td>
                                        <td><?php if ($recordOwnersDueData[$i]->paidStatus == 1) {
                                                echo   $this->lang->line('COMPLETELY_PAID');
                                            } else if ($recordOwnersDueData[$i]->paidStatus == 2) {
                                                echo  $this->lang->line('PARTIALLY_PAID');
                                            }

                                            ?></td>
                                    </tr>
                                <?php  }
                            } else { ?>
                                <tr>
                                    <td colspan="8">
                                        <center>
                                            <?php echo  $this->lang->line('NO_DATA_AVAILABLE'); ?></center>
                                    </td>
                                </tr>
                            <?php   } ?>
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
    <?php endif; ?>
</div>


<script>
    function openTab(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-border-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.firstElementChild.className += " w3-border-red";
    }
</script>
<script>
    $('.mgmtAmount').on('change', function() {
        var paymentMaxAmount = $("#paymentMaxAmount").val();
        var values = $("input[name='mgmtAmount[]']")
            .map(function() {
                if ((parseFloat(paymentMaxAmount) < parseFloat($(this).val()))) {
                    alert("Entered Amount Exceeds Installment Amount");
                    $(this).val(paymentMaxAmount);
                    $(this).focus();
                }
            }).get();
    });






    function receive(clicked) {
        var contractNumber = $("#contractNumber").val();
        var installmentDate = $("#installmentDate").val();
        var pendingAmount = $("#pendingAmount").val();
        var totalInstallment = $("#totalInstallment").val();
        if (totalInstallment == 1) {
            var installmentAmt = $("#paymentMaxAmount").val();
            var pAmt = $("#paymentAmount").val();
            var pDate = $("#paymentDate").val();
            var pNotes = $("#notes").val();

        } else {

            var installmentamount = $("input[name^='paymentMaxAmount']").map(function(idx, ele) {
                installmentAmt = paymentMaxAmount[clicked - 1].value;
            }).get();

            var values = $("input[name^='paymentDate']").map(function(idx, ele) {
                pDate = paymentDate[clicked - 1].value;
            }).get();

            var amount = $("input[name^='paymentAmount']").map(function(idx, ele) {
                pAmt = paymentAmount[clicked - 1].value;
            }).get();

            var n = $("input[name^='notes']").map(function(idx, ele) {
                pNotes = notes[clicked - 1].value;
            }).get();


        }

        $.ajax({
            url: "<?php echo site_url(); ?>contracts/getManagementFee",
            dataType: 'json',
            method: "POST",
            data: {
                paidDate: pDate,
                paidAmount: pAmt,
                installmentNumber: clicked,
                contractNumber: contractNumber,
                installmentAmount: installmentAmt,
                installmentDate: installmentDate,
                type: 3,
                notes: pNotes

            },
            cache: false,
            beforeSend: function() {
                $(".transferBtn").prop('disabled', true);
            },
            success: function(data) {
                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/ownersdue/' + contractNumber;
                    }, 4000);
                }
            }
        });
    }

    function payments(id) {

        window.location.href = '<?php echo base_url('contracts/payments/') ?>' + id;
    }

    function expenses(id) {

        window.location.href = '<?php echo base_url('contracts/expenses/') ?>' + id;
    }

    function management(id) {

        window.location.href = '<?php echo base_url('contracts/management/') ?>' + id;
    }


    function statement(id) {

        window.location.href = '<?php echo base_url('contracts/statement/') ?>' + id;
    }
</script>
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
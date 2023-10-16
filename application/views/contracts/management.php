<?php

use function PHPSTORM_META\type;

$sess = (object)($this->session->userdata); ?>
<link href="<?php echo base_url('assets/static/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css'); ?>" rel="stylesheet" />
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('EXPENSES'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('contracts') ?>" class="text-muted"><?php echo $this->lang->line('CONTRACTS'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('EXPENSES'); ?></li>
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
            <!-- <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button> -->
            <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button>
            <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button>

            <!-- <div class="w3-row">
                <a href="javascript:void(0)" onclick="openTab(event, 'Management');">
                    <div class="w3-third tablink w3-bottombar w3-border-red w3-padding"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?></div>
                </a>
                <a href="javascript:void(0)" onclick="openTab(event, 'Records');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><?php echo $this->lang->line('RECORDS'); ?></div>
                </a>
            </div> -->
            <div class="d-block mt-4">
                <button type="button" type="button" class="btn btn-sm btn-primary" onclick="openTab(event, 'Management');">
                    <div class="tablink">
                        <?php echo $this->lang->line('MANAGEMENT_FEES'); ?>
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
            <div id="Management" class="w3-container city mt-4">
                <div class="table-responsive">
                    <table class="table" border="1">
                        <table class="table" border="1" style="width: 200%">
                            <thead>
                                <tr>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('ITEM'); ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('DUE_DATE'); ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('DUE_AMOUNT');
                                                                            ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('RECEIVED_AMOUNT');
                                                                            ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('PENDING_AMOUNT');
                                                                            ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('PAYMENT_DATE'); ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('NOTES'); ?></th>
                                    <th style="font-weight: bold;width:0%;"><?php echo $this->lang->line('STATUS'); ?></th>
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



                                    //Agency Fee

                                    if (($agentData->paidAmount == "") && ($agentData->pendingAmount == "")) {
                                        $agentFeeAmount = $contractsData->agencyFee;
                                        $agencyFee = $contractsData->agencyFee;
                                    } else {
                                        $agentFeeAmount = $agentData->pendingAmount;
                                        $agencyFee = (($agentData->pendingAmount));
                                    }


                                    if ($agentData->paidAmount > 0) {
                                        $agencyPaidAmount =   ($agentData->paidAmount);
                                    } else {
                                        $agencyPaidAmount = "0.00";
                                    }

                                    if (($agentData->pendingAmount) != "") {

                                        $agencyPendingAmount =   ($agentData->pendingAmount);
                                        if (($agentData->pendingAmount) == 0) {
                                            $agencyPaidStatus = 1;
                                        } else {
                                            $agencyPaidStatus = 0;
                                        }
                                    } else if (($agentData->pendingAmount) == "") {

                                        $agencyPendingAmount = ($contractsData->agencyFee);
                                        $agencyPaidStatus = 0;
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $this->lang->line('AGENCY_FEE'); ?>
                                            <input type="text" id="contractNumber" value="<?php echo ($contractsData->contractNumber); ?>" hidden>
                                            <input type="text" id="agencyFee" name="agencyFee" value="<?php echo  $agencyFee; ?>" hidden>
                                        </td>
                                        <td><input type="text" id="agencyFeeDate" name="agencyFeeDate" style="background: rgba(0, 0, 0, 0); border: none;" value="<?php $d = date_create($contractsData->startDate);
                                                                                                                                                                    echo date_format($d, 'd-m-Y');
                                                                                                                                                                    ?>" readonly> </td>
                                        <td> <input type="text" id="agencyFeeAmount" class="form-control input-lg" name="agencyFeeAmount" value="<?php echo  $agentFeeAmount; ?>" <?php if ($agentFeeAmount == 0) { ?> readonly <?php } ?>> </td>
                                        <td><input type="number" class="form-control input-lg" name="agencyPaidAmount" style="background: rgba(0, 0, 0, 0); border: none;" id="agencyPaidAmount" value="<?php echo $agencyPaidAmount; ?>" readonly></td>
                                        <td><input type="number" class="form-control input-lg" name="agencyPendingAmount" style="background: rgba(0, 0, 0, 0); border: none; color:red;" id="agencyPendingAmount" value="<?php echo $agencyPendingAmount; ?>" readonly></td>

                                        <td><input type="date" class="form-control" name="agencyPaymentDate" id="agencyPaymentDate" <?php
                                                                                                                                    if (isset($agencyPaidStatus) && ($agencyPaidStatus == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> value="<?php if (isset($agentData->paidDate)) {
                                                                                                                                                                                                                                                                            echo ($agentData->paidDate);
                                                                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                                                                            echo  date('Y-m-d');
                                                                                                                                                                                                                                                                        }

                                                                                                                                                                                                                                                                        ?>"></td>

                                        <td>

                                            <input type="text" class="form-control input-lg" name="agencyNotes" id="agencyNotes">

                                        </td>
                                        <td> <?php
                                                if (isset($agencyPaidStatus) && ($agencyPaidStatus == 1)) { ?>

                                                <label>
                                                    <font color="blue"><b><?php echo $this->lang->line('COMPLETED'); ?></b></font>
                                                </label>
                                            <?php } else {
                                                    $i = 1;
                                            ?>
                                                <button id="<?php echo $i; ?>" onClick="receiveAgencyPayment(this.id)" title="<?php echo $this->lang->line('PAYMENTS'); ?>" class="btn btn-sm btn-primary transferBtn">
                                                    <?php echo $this->lang->line('RECEIVE'); ?>
                                                </button>
                                            <?php } ?>
                                    </tr>
                                    <?php
                                    for ($i = 1; $i <= $in; $i++) {
                                        $installmentStatus = 0;
                                        if ((isset($managementData[$i - 1]->pendingAmount)) && (($managementData[$i - 1]->pendingAmount) > 0)) {

                                            $totalRent = $managementData[$i - 1]->pendingAmount;
                                        } else {

                                            if ((($managementData[0]->mgmtFeesPercentage) != 0)) {

                                                $installmentAmount = (($managementData[0]->rentAmount + $managementData[0]->waterFee + $managementData[0]->electricityFee + $managementData[0]->otherFee) / $managementData[0]->installments);
                                                $totalRent = (($managementData[0]->mgmtFeesPercentage / 100) * $installmentAmount);
                                            } else   if ((($managementData[0]->mgmtFeesPercentage) == 0)) {

                                                $totalRent = (($managementData[0]->mgmtFeesFixed) / ($managementData[0]->installments));
                                            }
                                        }


                                        if (isset($managementData[$i - 1]->totalPaidAmount)) {
                                            $totalPaidAmount = $managementData[$i - 1]->totalPaidAmount;
                                        } else {
                                            $totalPaidAmount = "0.00";
                                        }

                                        if (isset($managementData[$i - 1]->pendingAmount)) {
                                            $pendingAmount = $managementData[$i - 1]->pendingAmount;
                                        } else {
                                            $pendingAmount =   $totalRent;
                                        }

                                        $status = 0;
                                        if (isset($managementData[$i - 1]->paidStatus)) {
                                            if ((($managementData[$i - 1]->paidStatus) == 1) && ($managementData[$i - 1]->type = 2)) {
                                                $status = 1;
                                            }
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

                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $this->lang->line('INSTALLMENT_NO_MGMT_FEE') . " ( " . $i . " )";
                                                ?>
                                                <input type="text" id="contractNumber" value="<?php echo ($managementData[0]->contractNumber); ?>" hidden>

                                                <input type="number" id="paymentMaxAmount" name="paymentMaxAmount[]" value="<?php echo $totalRent; ?>" hidden>
                                                <input type="number" id="totalInstallment" name="totalInstallment" value="<?php echo ($managementData[0]->installments); ?>" hidden>

                                            </td>

                                            <td><input type="date" id="installmentDate" name="installmentDate" style="background: rgba(0, 0, 0, 0); border: none;" value="<?php $d = date_create($dates[$i - 1]);
                                                                                                                                                                            echo date_format($d, 'Y-m-d');
                                                                                                                                                                            ?>" readonly> </td>
                                            <td><input type="text" class="form-control input-lg paymentAmount" name="paymentAmount[]" id="paymentAmount" value="<?php echo  $totalRent; ?>" <?php
                                                                                                                                                                                            if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?>></td>
                                            <td><input type="number" class="form-control input-lg" name="paidAmount" style="background: rgba(0, 0, 0, 0); border: none;" id="paidAmount" value="<?php echo $totalPaidAmount;    ?>" readonly></td>
                                            <td><input type="number" class="form-control input-lg" name="pendingAmount[]" style="background: rgba(0, 0, 0, 0); border: none; color:red;" id="pendingAmount" <?php if (isset($status) && ($status == 1)) { ?> value="0.00" <?php } else { ?> value="<?php echo $totalRent; ?>" <?php } ?> readonly></td>

                                            <td><input type="date" class="form-control" name="paymentDate[]" id="paymentDate" <?php
                                                                                                                                if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> value="<?php if (isset($managementData[$i - 1]->paidDate)) {
                                                                                                                                                                                                                                                    echo ($managementData[$i - 1]->paidDate);
                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                    echo  date('Y-m-d');
                                                                                                                                                                                                                                                } ?>"></td>
                                            <td>

                                                <input type="text" class="form-control input-lg" name="mgmtNotes[]" id="mgmtNotes">

                                            </td>
                                            <td> <?php
                                                    if (isset($status) && ($status == 1)) { ?>

                                                    <font color="blue"><b><?php echo $this->lang->line('COMPLETED'); ?></b></font>
                                                    <?php } else {
                                                        if (isset($installmentStatus)) {
                                                            if ($installmentStatus == 1) {
                                                                // if (($managementData[$i - 1]->mgmtFeesPercentage != 0) && ($managementData[$i - 1]->mgmtFeesFixed != 0)) {
                                                    ?>
                                                            <button id="<?php echo $i; ?>" onClick="receive(this.id)" title="<?php echo $this->lang->line('RECEIVE'); ?>" class="btn btn-sm btn-primary transferBtn">
                                                                <?php echo $this->lang->line('RECEIVE'); ?>
                                                            </button>
                                                <?php //} else {
                                                                //   echo "Zero Amount";
                                                                //}
                                                            } else {
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
                                <th style="font-weight: bold;"><?php echo $this->lang->line('PAID_AMOUNT');
                                                                ?> </th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('PENDING_AMOUNT');
                                                                ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('STATUS'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i <= (sizeof($recordMgmtData) - 1); $i++) {
                            ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php if ($recordMgmtData[$i]->type == 1) {
                                            echo $this->lang->line('AGENCY_FEE');
                                        } else {
                                            echo $this->lang->line('MANAGEMENT_FEES');
                                        } ?></td>

                                    <td><?php if ($recordMgmtData[$i]->installmentNumber == '') {
                                            echo "-";
                                        } else {
                                            echo $recordMgmtData[$i]->installmentNumber;
                                        } ?></td>
                                    <td><?php
                                        $d = date_create($recordMgmtData[$i]->installmentDate);
                                        echo date_format($d, 'd-m-Y'); ?></td>
                                    <td><?php

                                        $d = date_create($recordMgmtData[$i]->paidDate);
                                        echo date_format($d, 'd-m-Y');

                                        ?></td>
                                    <td><?php echo $recordMgmtData[$i]->paidAmount; ?></td>
                                    <td><?php echo $recordMgmtData[$i]->pendingAmount; ?></td>
                                    <td><?php if ($recordMgmtData[$i]->paidStatus == 1) {
                                            echo $this->lang->line('COMPLETELY_PAID');
                                        } else if ($recordMgmtData[$i]->paidStatus == 2) {
                                            echo $this->lang->line('PARTIALLY_PAID');
                                        }

                                        ?></td>
                                </tr>
                            <?php  }   ?>
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

    function receiveAgencyPayment() {

        var agencyFeeAmount = $("#agencyFeeAmount").val();
        var contractNumber = $("#contractNumber").val();
        var agencyFee = $("#agencyFee").val();
        var contractNumber = $("#contractNumber").val();
        var agencyFeeDate = $("#agencyFeeDate").val();
        var agencyPaymentDate = $("#agencyPaymentDate").val();
        var agencyNotes = $("#agencyNotes").val();

        $.ajax({
            url: "<?php echo site_url(); ?>contracts/getAgencyFee",
            dataType: 'json',
            method: "POST",
            data: {
                agencyFeeAmount: agencyFeeAmount,
                agencyFeeDate: agencyFeeDate,
                agencyPaymentDate: agencyPaymentDate,
                contractNumber: contractNumber,
                totalAmount: agencyFee,
                notes: agencyNotes
            },
            cache: false,
            beforeSend: function() {
                $(".transferBtn").prop('disabled', true);
            },
            success: function(data) {

                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/management/' + contractNumber;
                    }, 4000);
                }
            }

        });
    }

    $('#agencyFeeAmount').on('change', function() {
        var agencyFee = $("#agencyFee").val();
        var agencyFeeAmount = $("#agencyFeeAmount").val();
        if (agencyFeeAmount > agencyFee) {
            alert("Entered Amount Exceeds Agency Fee Amount");
            $(this).val(agencyFee);
            $(this).focus();
        }
        if (agencyFeeAmount == 0) {
            alert("Entered Agency Fee Amount");
            $(this).val(agencyFee);
            $(this).focus();
        }
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
            var mNotes = $("#mgmtNotes").val();

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

            var note = $("input[name^='mgmtNotes']").map(function(idx, ele) {
                mNotes = mgmtNotes[clicked - 1].value;
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
                notes: mNotes
            },
            cache: false,
            beforeSend: function() {
                $(".transferBtn").prop('disabled', true);
            },
            success: function(data) {
                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/management/' + contractNumber;
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

    function ownersdue(id) {

        window.location.href = '<?php echo base_url('contracts/ownersdue/') ?>' + id;
    }

    function statement(id) {

        window.location.href = '<?php echo base_url('contracts/statement/') ?>' + id;
    }
</script>
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
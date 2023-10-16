<div class="content-wrapper">
    <div class="page-header">
        <div class="container text-center">
            <!-- <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo $contractsData[0]->contractNumber; ?>');" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('PAYMENTS'); ?> </button> -->
            <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo $contractsData[0]->contractNumber; ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button>
            <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contractsData[0]->contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button>
            <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contractsData[0]->contractNumber; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button>
            <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contractsData[0]->contractNumber; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button>

            <div class="w3-row">
                <a href="javascript:void(0)" onclick="openTab(event, 'Payments');">
                    <div class="w3-third tablink w3-bottombar w3-border-red w3-padding"><?php echo $this->lang->line('PAYMENTS'); ?></div>
                </a>
                <a href="javascript:void(0)" onclick="openTab(event, 'Records');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><?php echo $this->lang->line('RECORDS'); ?></div>
                </a>

            </div>

            <div class="alert alertSuccess">

            </div>

            <div id="Payments" class="w3-container city mt-4">
                <div class="table-responsive">
                    <table class="table" border="1" style="width: 200%" id="showPaymentTable">
                        <thead>
                            <tr>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('ITEM'); ?></th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENT_DATE'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENT_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PAID_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PENDING_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PAYMENT_DATE'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('NOTES'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('action'); ?> </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($contractsData)) {
                                $in  = $contractsData[0]->installments;
                                $dt = strtotime($contractsData[0]->startDate);
                                $dates = [$contractsData[0]->startDate];
                                if ($in == 1) {
                                    $add = 12 * $contractsData[0]->contractPeriod;
                                    $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                    $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                    array_push($dates, $dt3);
                                } else  if ($in == 2) {
                                    $add = 6 * $contractsData[0]->contractPeriod;

                                    for ($i = 1; $i <= 2; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 4) {
                                    $add = 3 * $contractsData[0]->contractPeriod;
                                    for ($i = 1; $i <= 4; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 12) {
                                    $add = 1 * $contractsData[0]->contractPeriod;
                                    for ($i = 1; $i <= 12; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                }


                                for ($i = 1; $i <= $in; $i++) { ?>
                                    <?php
                                    if ((isset($contractsData[$i - 1]->pendingAmount)) && (($contractsData[$i - 1]->pendingAmount) > 0)) {
                                        $totalRent = $contractsData[$i - 1]->pendingAmount;
                                    } else {
                                        $totalRent = (($contractsData[0]->rentAmount + $contractsData[0]->waterFee + $contractsData[0]->electricityFee + $contractsData[0]->otherFee) / $contractsData[0]->installments);
                                    }
                                    if (isset($contractsData[$i - 1]->totalPaidAmount)) {
                                        $totalPaidAmount = $contractsData[$i - 1]->totalPaidAmount;
                                    } else {
                                        $totalPaidAmount = "0.00";
                                    }

                                    if (isset($contractsData[$i - 1]->pendingAmount)) {
                                        $pendingAmount = $contractsData[$i - 1]->pendingAmount;
                                    } else {
                                        $pendingAmount =   $totalRent;
                                    }
                                    $status = 0;
                                    if (isset($contractsData[$i - 1]->paidStatus)) {
                                        if (($contractsData[$i - 1]->paidStatus) == 1) {
                                            $status = 1;
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $this->lang->line('INSTALLMENT_NO_PAYMENT') . " (" . $i . " )"; ?>
                                            <input type="text" id="contractNumber" value="<?php echo ($contractsData[0]->contractNumber); ?>" hidden>

                                            <input type="number" id="paymentMaxAmount" name="paymentMaxAmount[]" value="<?php echo $totalRent; ?>" hidden>
                                            <input type="number" id="totalInstallment" name="totalInstallment" value="<?php echo ($contractsData[0]->installments); ?>" hidden>

                                        </td>

                                        <td><input type="date" id="installmentDate" name="installmentDate" style="background: rgba(0, 0, 0, 0); border: none;" value="<?php $d = date_create($dates[$i - 1]);
                                                                                                                                                                        echo date_format($d, 'Y-m-d');
                                                                                                                                                                        ?>" readonly> </td>
                                        <td><input type="text" class="form-control input-lg paymentAmount" name="paymentAmount[]" id="paymentAmount" value="<?php echo  $totalRent; ?>" <?php
                                                                                                                                                                                        if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?>></td>
                                        <td><input type="number" class="form-control input-lg" name="paidAmount" style="background: rgba(0, 0, 0, 0); border: none;" id="paidAmount" value="<?php echo $totalPaidAmount;    ?>" readonly></td>
                                        <td><input type="number" class="form-control input-lg" name="pendingAmount[]" style="background: rgba(0, 0, 0, 0); border: none; color:red;" id="pendingAmount" <?php if (isset($status) && ($status == 1)) { ?> value="0.00" <?php } else { ?> value="<?php echo $totalRent; ?>" <?php } ?> readonly></td>

                                        <td><input type="date" class="form-control" name="paymentDate[]" id="paymentDate" <?php
                                                                                                                            if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> value="<?php if (isset($contractsData[$i - 1]->paidDate)) {
                                                                                                                                                                                                                                                    echo ($contractsData[$i - 1]->paidDate);
                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                    echo  date('Y-m-d');
                                                                                                                                                                                                                                                } ?>"></td>
                                        <td>
                                            <input type="text" class="form-control input-lg" name="notes[]" id="notes">
                                        </td>

                                        <td> <?php
                                                if (isset($status) && ($status == 1)) { ?>

                                                <font color="blue"><b><?php echo $this->lang->line('COMPLETED'); ?></b></font>
                                            <?php } else {

                                            ?>
                                                <button id="<?php echo $i; ?>" onClick="receive(this.id)" title="<?php echo $this->lang->line('RECEIVE'); ?>" class="btn btn-sm btn-primary transferBtn">
                                                    <?php echo $this->lang->line('RECEIVE'); ?>
                                                </button>
                                            <?php } ?>
                                            <!-- <button type="button" value="receive(this.id)" class="btn btn-primary" id="but_workExperience">Save & Next</button> -->

                                        </td>
                                    </tr>
                                <?php }
                                ?>

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
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('ITEM'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENT_NUMBER'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PAID_DATE'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('PAID_AMOUNT'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('NOTES'); ?> </th>
                                <th scope="col" style="font-weight: bold;"><?php echo $this->lang->line('STATUS'); ?> </th>
                            </tr>
                        </thead>



                        <tbody>
                            <?php //if (!empty($installmentData)) {
                            for ($i = 0; $i <= (sizeof($installmentData) - 1); $i++) {
                            ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo $installmentData[$i]->installmentNumber; ?></td>
                                    <td><?php
                                        $d = date_create($installmentData[$i]->paidDate);
                                        echo date_format($d, 'd-m-Y'); ?></td>
                                    <td><?php echo $installmentData[$i]->paidAmount; ?></td>
                                    <td><?php echo $installmentData[$i]->notes; ?></td>
                                    <td><?php if ($installmentData[$i]->paidStatus == 1) {
                                            echo $this->lang->line('COMPLETELY_PAID');
                                        } else if ($installmentData[$i]->paidStatus == 2) {
                                            echo $this->lang->line('PARTIALLY_PAID');
                                        }
                                        ?></td>
                                </tr>
                            <?php  }
                            // }   
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>


        </div>
    </div>
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
    function receive(clicked) {

        //alert(clicked);
        // alert(paymentMaxAmount[0].val());
        var totalInstallment = $("#totalInstallment").val();

        var contractNumber = $("#contractNumber").val();
        var installmentDate = $("#installmentDate").val();
        var pendingAmount = $("#pendingAmount").val();
        if (totalInstallment == 1) {
            var installmentAmt = $("#paymentMaxAmount").val();
            var pAmt = $("#paymentAmount").val();
            var pDate = $("#paymentDate").val();
            var paidnotes = $("#notes").val();

        } else {
            var installmentamount = $("input[name^='paymentMaxAmount']").map(function(idx, ele) {
                installmentAmt = paymentMaxAmount[clicked - 1].value;
            }).get();
            var amount = $("input[name^='paymentAmount']").map(function(idx, ele) {
                pAmt = paymentAmount[clicked - 1].value;
            }).get();
            var values = $("input[name^='paymentDate']").map(function(idx, ele) {
                pDate = paymentDate[clicked - 1].value;
            }).get();
            var pnotes = $("input[name^='notes']").map(function(idx, ele) {
                paidnotes = notes[clicked - 1].value;
            }).get();


        }


        $.ajax({
            url: "<?php echo site_url(); ?>contracts/getPaymentInfo",
            dataType: 'json',
            method: "POST",
            data: {
                paidDate: pDate,
                paidAmount: pAmt,
                installmentNumber: clicked,
                contractNumber: contractNumber,
                installmentAmount: installmentAmt,
                installmentDate: installmentDate,
                notes: paidnotes
            },
            cache: false,
            beforeSend: function() {
                $(".transferBtn").prop('disabled', true);
            },
            success: function(data) {

                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/payments/' + contractNumber;
                    }, 4000);
                }
            }

        });
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
</script>
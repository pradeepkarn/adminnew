<div class="content-wrapper">
    <div class="page-header">
        <div class="container">

            <div class="w3-row">
                <a href="javascript:void(0)" onclick="openTab(event, 'Payments');">
                    <div class="w3-third tablink w3-bottombar w3-border-red w3-padding"><?php echo $this->lang->line('PAYMENTS'); ?></div>
                </a>
                <a href="javascript:void(0)" onclick="openTab(event, 'Records');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><?php echo $this->lang->line('RECORDS'); ?></div>
                </a>

            </div>
            <?php //print_r($installmentData);            
            ?>
            <div class="alert alertSuccess">
            </div>

            <div id="Payments" class="w3-container city mt-4">
                <div class="table-responsive">
                    <table class="table" border="1">
                        <thead>
                            <tr>
                                <th scope="col" style="font-weight: bold;">Item</th>
                                <th scope="col" style="font-weight: bold;">Installment <br>Date</th>
                                <th scope="col" style="font-weight: bold;">Installment <br>Amount (SAR)</th>
                                <th scope="col" style="font-weight: bold;">Paid<br> Amount (SAR)</th>
                                <th scope="col" style="font-weight: bold;">Pending<br> Amount (SAR)</th>
                                <th scope="col" style="font-weight: bold;">Payment<br> Date</th>
                                <th scope="col" style="font-weight: bold;"><?php echo "Action"; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($contractsData)) {
                                $in  = $contractsData[0]->installments;
                                $dt = strtotime($contractsData[0]->startDate);
                                $dates = [$contractsData[0]->startDate];
                                if ($in == 1) {
                                    $add = 12;
                                    $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                    $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                    array_push($dates, $dt3);
                                } else  if ($in == 2) {
                                    $add = 6;

                                    for ($i = 1; $i <= 2; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 4) {
                                    $add = 3;
                                    for ($i = 1; $i <= 4; $i++) {
                                        $dt2 = date("Y-m-d", strtotime("+$add month", $dt));
                                        $dt = strtotime($dt2);
                                        $dt3 = date('Y-m-d', (strtotime('-1 day', strtotime($dt2))));
                                        array_push($dates, $dt3);
                                    }
                                } else  if ($in == 12) {
                                    $add = 1;
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
                                            <?php echo "Installment <br> No. " . $i . "<br> Payment"; ?>
                                            <input type="text" id="contractNumber" value="<?php echo ($contractsData[0]->contractNumber); ?>" hidden>

                                            <input type="number" id="paymentMaxAmount" name="paymentMaxAmount[]" value="<?php echo $totalRent; ?>" hidden>

                                        </td>

                                        <td><input type="date" id="installmentDate" name="installmentDate" style="background: rgba(0, 0, 0, 0); border: none;" value="<?php $d = date_create($dates[$i - 1]);
                                                                                                                                                                        echo date_format($d, 'Y-m-d');
                                                                                                                                                                        ?>" readonly> </td>
                                        <td><input type="text" class="form-control input-lg paymentAmount" name="paymentAmount[]" id="paymentAmount" value="<?php echo  $totalRent; ?>" <?php
                                                                                                                                                                                        if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?>></td>
                                        <td><input type="number" class="form-control input-lg" name="paidAmount" style="background: rgba(0, 0, 0, 0); border: none;" id="paidAmount" value="<?php echo $totalPaidAmount;    ?>" readonly></td>
                                        <td><input type="number" class="form-control input-lg" name="pendingAmount[]" style="background: rgba(0, 0, 0, 0); border: none; color:red;" id="pendingAmount" <?php if (isset($status) && ($status == 1)) { ?> value="0.00" <?php } else { ?> value="<?php echo $totalRent; ?>" <?php } ?> readonly></td>

                                        <td><input type="date" class="form-control" name="paymentDate[]" id="paymentDate" <?php
                                                                                                                            if (isset($status) && ($status == 1)) { ?> style="background: rgba(0, 0, 0, 0); border: none;" <?php } ?> value="<?php echo date('Y-m-d'); ?>"></td>
                                        <td> <?php
                                                if (isset($status) && ($status == 1)) { ?>

                                                <font color="blue"><b>COMPLETED</b></font>
                                            <?php } else {

                                            ?>
                                                <button id="<?php echo $i; ?>" onClick="receive(this.id)" title="<?php echo $this->lang->line('RECEIVE'); ?>" class="btn btn-sm btn-primary">
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
                                <th style="font-weight: bold;">Item</th>
                                <th style="font-weight: bold;">Installment Number</th>
                                <th style="font-weight: bold;">Paid Date</th>
                                <th style="font-weight: bold;">Paid Amount</th>
                                <th style="font-weight: bold;">Status</th>

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
                                        echo date_format($d, 'd/m/Y'); ?></td>
                                    <td><?php echo $installmentData[$i]->paidAmount; ?></td>
                                    <td><?php if ($installmentData[$i]->paidStatus == 1) {
                                            echo "Completely Paid";
                                        } else if ($installmentData[$i]->paidStatus == 2) {
                                            echo "Partially Paid";
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
    // $('.paymentAmount').on('change', function() {

    //     var paymentMaxAmount = $("#paymentMaxAmount").val();
    //     // var maxAmount;
    //     // var values = $("input[name='paymentMaxAmount[]']")
    //     //     .map(function() {
    //     //         maxAmount = ($(this).val());
    //     //         var values = $("input[name='paymentAmount[]']")
    //     //             .map(function() {

    //     //                 if ((parseFloat(maxAmount) < parseFloat($(this).val()))) {
    //     //                     alert("Entered Amount Exceeds Installment Amount");
    //     //                     $(this).val(paymentMaxAmount);
    //     //                     $(this).focus();
    //     //                 }
    //     //             }).get();
    //     //     }).get();

    //     var values = $("input[name='paymentAmount[]']")
    //         .map(function() {

    //             if ((parseFloat(paymentMaxAmount) < parseFloat($(this).val()))) {
    //                 alert("Entered Amount Exceeds Installment Amount");
    //                 $(this).val(paymentMaxAmount);
    //                 $(this).focus();
    //             }
    //         }).get();
    // });



    function receive(clicked) {

        // var paymentMaxAmount = $("#paymentMaxAmount").val();
        var contractNumber = $("#contractNumber").val();
        var installmentDate = $("#installmentDate").val();
        var pendingAmount = $("#pendingAmount").val();

        var installmentamount = $("input[name^='paymentMaxAmount']").map(function(idx, ele) {
            installmentAmt = paymentMaxAmount[clicked - 1].value;
        }).get();

        var amount = $("input[name^='paymentAmount']").map(function(idx, ele) {
            pAmt = paymentAmount[clicked - 1].value;
        }).get();


        var values = $("input[name^='paymentDate']").map(function(idx, ele) {
            pDate = paymentDate[clicked - 1].value;
        }).get();


        // console.log("clicked==" + clicked);
        // console.log("InstallmentAmount==" + installmentAmt);
        // console.log("paidAmount==" + pAmt);
        // console.log("pendingAmount==" + installmentAmt);

        // console.log("paidDate==" + pDate);

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
                installmentDate: installmentDate
            },
            success: function(data) {

                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = '<?php echo base_url(); ?>contracts/payments/' + contractNumber;
                    }, 4000);
                }
            }
            // },
            // success: function(data) {
            //     if (data.status == "true") {
            //         $('.alertSuccess').html("<div class='p-3 mb-2 bg-success text-white' id='design_error_div'>" + data.message + "</div>");

            //     } else if (data.status == 'false') {
            //         $('.alertSuccess').html("<div class='p-3 mb-2 bg-danger text-white' id='design_error_div'>" + data.message + "</div>");
            //     }


            // success: function(response) {
            //     // console.log(response.notificationData[0].totalCount);
            // }
        });
    }


    (function($) {
        'use strict';
        $(function() {
            $('#paymentTable').DataTable({
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
            $('#paymentTable').each(function() {
                var datatable = $(this);
                var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
                search_input.attr('placeholder', 'Search');
                search_input.removeClass('form-control-sm');
                var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
                length_sel.removeClass('form-control-sm');
            });
        });
    })(jQuery);
</script>
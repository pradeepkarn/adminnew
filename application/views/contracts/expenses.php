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
            <!-- <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button> -->
            <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('PAYMENTS'); ?> </button>
            <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button>
            <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button>
            <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button>
            <!-- <div class="w3-row">
                <a href="javascript:void(0)" onclick="openTab(event, 'Expenses');">
                    <div class="w3-third tablink w3-bottombar w3-border-red w3-padding"><?php echo $this->lang->line('EXPENSES'); ?></div>
                </a>
                <a href="javascript:void(0)" onclick="openTab(event, 'Records');">
                    <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding"><?php echo $this->lang->line('RECORDS'); ?></div>
                </a>

            </div> -->
            <div class="d-block mt-4">
                <button type="button" type="button" class="btn btn-sm btn-primary" onclick="openTab(event, 'Expenses');">
                    <div class="tablink">
                        <?php echo $this->lang->line('EXPENSES'); ?>
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
            <div id="Expenses" class="w3-container city mt-4">
                <button id="addExpenseBtn" name="addExpenseBtn" title="<?php echo $this->lang->line('ADD_EXPENSES'); ?>" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('ADD_EXPENSES'); ?> </button><br>
                <div id="addExpenseDiv" name="addExpenseDiv" style="display:none;">

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title"></h4>
                                    <!-- <form id="addExpenseForm" class="form-sample" action="<?php echo base_url() . "contracts/addExpense"; ?>" method="post" enctype="multipart/form-data"> -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('EXPENSE_DATE'); ?> <font color="red">*</font></label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="contractNumber" name="contractNumber" value="<?php echo $ID; ?>" class="form-control" hidden>
                                                    <input type="date" id="expenseDate" name="expenseDate" class="form-control" autocomplete="off" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('EXPENSE_TYPE'); ?><font color="red">*</font> </label>
                                                <div class="col-sm-9">
                                                    <select class="form-control form-select" id="expenseType" name="expenseType" required>
                                                        <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_EXPENSE_TYPE'); ?></option>
                                                        <option value="1"><?php echo $this->lang->line('MAINTENANCE'); ?></option>
                                                        <option value="2"><?php echo $this->lang->line('ATTESTATION'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('EXPENSE_AMOUNT'); ?> <font color="red">*</font></label>
                                                <div class="col-sm-9">
                                                    <input type="number" id="expenseAmount" name="expenseAmount" class="form-control" autocomplete="off" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('NOTE'); ?><font color="red">*</font> </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="note" name="note" class="form-control" autocomplete="off" required="required" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('CHARGE_TO'); //$this->lang->line('EXPENSE_AMOUNT'); 
                                                                                        ?> <font color="red">*</font></label>
                                                <div class="col-sm-9">
                                                    <select class="form-control form-select" id="chargeTo" name="chargeTo" required>
                                                        <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_INSTALLMENT_NUMBER'); ?></option>
                                                        <?php
                                                        for ($i = 1; $i <= $contractsData->installments; $i++) {
                                                            echo $i;
                                                            echo "<br>";
                                                            echo ($installmentData[$i]->installmentNumber);
                                                            if (($installmentData[$i - 1]->installmentNumber) != $i) {



                                                        ?>
                                                                <option value="<?php echo $i; ?>"><?php echo $this->lang->line('INSTALLMENT_NUMBER') . " "; ?><?php echo $i; ?></option>
                                                        <?php  }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-4">
                                        </div>
                                        <div class="col-md-8">
                                            <button class="btn btn-outline-primary" name="addExpense" id="addExpense"><?php echo $this->lang->line('ADD_EXPENSES'); ?></button>
                                        </div>
                                    </div>
                                    <!-- </form> -->
                                </div>


                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div id="Records" class="w3-container city" style="display:none">

                <div class="col-12 mt-4 table-responsive">
                    <table class="table" border="1" id="expenseTable" name="expenseTable">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('ITEM'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('EXPENSE_TYPE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('EXPENSE_DATE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('EXPENSE_AMOUNT'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('NOTES'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('CHARGE_TO'); ?></th>

                            </tr>
                        </thead>



                        <tbody>
                            <?php if (!empty($expenseData)) {
                                for ($i = 0; $i <= (sizeof($expenseData) - 1); $i++) {
                            ?>
                                    <tr>
                                        <td><?php echo $i + 1; ?></td>
                                        <td>
                                            <select name="expenseType" class="form-select">
                                                <option <?php if ($expenseData[$i]->expenseType == 1) {
                                                            echo "selected";
                                                        } ?> value="1"><?php echo $this->lang->line('MAINTENANCE'); ?></option>
                                                <option <?php if ($expenseData[$i]->expenseType == 2) {
                                                            echo "selected";
                                                        } ?> value="2"><?php echo $this->lang->line('ATTESTATION'); ?></option>
                                            </select>
                                        </td>
                                        <td><?php echo $expenseData[$i]->expenseDate; ?></td>
                                        <td>
                                            <div class="d-flex align-items-start gap-2 justify-content-around">
                                                <div>
                                                    <input type="hidden" class="form-control upateTransId" value="<?php echo $expenseData[$i]->id; ?>">
                                                    <input type="number" class="form-control upateTransData" value="<?php echo $expenseData[$i]->expenseAmount; ?>">
                                                </div>
                                                <div>
                                                    <button id="<?php echo uniqid(rand(100, 999)); ?>" class="btn btn-primary upateTransBtn">
                                                        <span class="d-flex gap-2 align-items-center"><i class="fas fa-arrow-left"></i> Update</span>
                                                    </button>
                                                </div>
                                            </div>

                                        </td>
                                        <td><?php echo ($expenseData[$i]->note); ?></td>
                                        <!-- <td>
                                            <select name="chargeTo" class="form-select">
                                                <option <?php //if ($expenseData[$i]->chargeTo == 0) {echo "selected";} 
                                                        ?> value="0">-</option>
                                                <option <?php //if ($expenseData[$i]->expenseType == 2) {echo "selected";} 
                                                        ?> value="1">1</option>
                                            </select>
                                        </td> -->
                                        <td><?php if ($expenseData[$i]->chargeTo == 0) {
                                                echo "-";
                                            } else {
                                                echo $expenseData[$i]->chargeTo;
                                            } ?></td>
                                    </tr>
                                <?php  }
                            } else { ?>
                        <tbody>
                            <tr>
                                <td colspan=5>
                                    <center>No Data Available</center>
                                </td>
                            </tr>
                        <?php  }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
    <?php endif; ?>
</div>


<script>
     const upateTransId = document.querySelectorAll(".upateTransId");
    const upateTransData = document.querySelectorAll(".upateTransData");
    const updateBtnArr = document.querySelectorAll(".upateTransBtn");
    var cn = document.querySelector("#contractNumber").value;

    for (let i = 0; i < updateBtnArr.length; i++) {
        updateBtnArr[i].addEventListener("click", (function(index) {
            return function() {
                const data = {
                    recordId: upateTransId[index].value,
                    expenseAmt: upateTransData[index].value,
                    contractNumber: cn
                };
                sendViaJax(
                    data,
                    `contracts/updateExpenseFee`,
                    `contracts//expenses/${cn}`
                );
            };
        })(i));
    }

    function sendViaJax(data, reqUrl, returnUrl) {
        $.ajax({
            url: `<?php echo site_url(); ?>${reqUrl}`,
            dataType: 'json',
            method: "POST",
            data: data,
            cache: false,
            beforeSend: function() {
                $(".transferBtn").prop('disabled', true);
            },
            success: function(data) {
                if (data.status == "true") {
                    showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                    setTimeout(function() {
                        window.location.href = `<?php echo base_url(); ?>${returnUrl}`;
                    }, 4000);
                } else {
                    showDangerToast(data.message, '<?php echo $this->lang->line('danger')  ?>');
                    return false;
                }
            }
        });
    }
</script>

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
    $('#addExpenseBtn').on('click', function() {
        var contractNumber = $("#contractNumber").val();
        $.ajax({
            url: "<?php echo site_url(); ?>contracts/checkOwnersDue",
            dataType: 'json',
            method: "POST",
            data: {
                contractNumber: contractNumber
            },
            cache: false,
            beforeSend: function() {
                $("#addExpenseBtn").prop('disabled', true);
            },
            success: function(data) {

                if (data.status == "true") {
                    $('#addExpenseDiv').show();
                } else {
                    showDangerToast(data.message, '<?php echo $this->lang->line('danger')  ?>');
                }
            }

        });


    });


    $('#addExpense').on('click', function() {

        var contractNumber = $("#contractNumber").val();
        var expenseDate = $("#expenseDate").val();
        var expenseType = $("#expenseType").val();
        var expenseAmount = $("#expenseAmount").val();
        var note = $("#note").val();
        var chargeTo = $("#chargeTo").val();

        if (expenseDate == "") {
            var s = "<?php echo $this->lang->line('EXPENSE_DATE'); ?>";
            alert(s);
        } else
        if (expenseType == null) {
            var s = "<?php echo $this->lang->line('SELECT_EXPENSE_TYPE'); ?>";
            alert(s);
        } else
        if (expenseAmount == "") {
            var s = "<?php echo $this->lang->line('EXPENSE_AMOUNT'); ?>";
            alert(s);
        } else
        if (note == "") {
            var s = "<?php echo $this->lang->line('NOTES'); ?>";
            alert(s);
        } else
        if (chargeTo == null) {
            var s = "<?php echo $this->lang->line('CHARGE_TO'); ?>";
            alert(s);
        } else {


            $.ajax({
                url: "<?php echo site_url(); ?>contracts/addExpense",
                dataType: 'json',
                method: "POST",
                data: {
                    contractNumber: contractNumber,
                    expenseDate: expenseDate,
                    expenseType: expenseType,
                    expenseAmount: expenseAmount,
                    note: note,
                    chargeTo: chargeTo
                },
                cache: false,
                beforeSend: function() {
                    $("#addExpense").prop('disabled', true);
                },
                success: function(data) {

                    if (data.status == "true") {
                        showSuccessToast(data.message, '<?php echo $this->lang->line('success')  ?>');
                        setTimeout(function() {
                            window.location.href = '<?php echo base_url(); ?>contracts/expenses/' + contractNumber;
                        }, 4000);
                    }


                }

            });
        }
    });

    function payments(id) {

        window.location.href = '<?php echo base_url('contracts/payments/') ?>' + id;
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
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
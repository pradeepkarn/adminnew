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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('STATEMENT'); ?></h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('contracts') ?>" class="text-muted"><?php echo $this->lang->line('CONTRACTS'); ?></a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page"><?php echo $this->lang->line('STATEMENT'); ?></li>
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
            else:
                $contractNumber = $contractsData->contractNumber;
            endif;
            ?>
            <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button>
            <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('PAYMENTS'); ?> </button>
            <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button>
            <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button>
            <!-- <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo $contractNumber; ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button> -->

           

            <div class="alert alertSuccess">

            </div>
          

            <div id="Records" class="w3-container city">

                <div class="col-12 mt-4 table-responsive">
                    <table class="table" border="1" style="border-collapse: inherit;" name="paymentTable" id="paymentTable">
                        <thead>
                            <tr>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('DATE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('INSTALLMENTS'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('EXPENSES'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('FEE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('OWNER_BALANCE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('TENANT_BALANCE'); ?></th>
                                <th style="font-weight: bold;"><?php echo $this->lang->line('DESCRIPTION'); ?></th>
                            </tr>
                        </thead>


                    <?php  if (isset($contractsData->contractNumber)) : ?>
                        <tbody>
                            <tr>
                                <td><?php
                                    $d = date_create($contractsData->startDate);
                                    echo date_format($d, 'd-m-Y'); ?> </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                 <td><?php $totalOwnerDue = 0;
                                    for ($i = 0; $i <= (sizeof($allData) - 1); $i++) {
                                        if ($allData[$i]->tabletype == 2) {
                                            if ($allData[$i]->type == 3) {
                                                $totalOwnerDue += $allData[$i]->paidAmount;
                                            }
                                        }
                                    }
                                    echo number_format($totalOwnerDue, 2); ?></td>
                                <td><?php echo $contractsData->totalRent; ?></td>
                                <td><?php echo $this->lang->line('RENT_AMOUNT'); ?></td>

                            </tr>
                            <?php

                            //print_r($allData);
                            $tenantBalance = $contractsData->totalRent;
                            for ($i = 0; $i <= (sizeof($allData) - 1); $i++) {
                                //   echo "Tenant Balance= " . $tenantBalance;
                            ?>
                                <tr>
                                    <td><?php $d = date_create($allData[$i]->paidDate);
                                        echo date_format($d, 'd-m-Y'); ?></td>

                                    <!-- 2 -->
                                    <td><?php if ($allData[$i]->tabletype == 1) {
                                            echo $allData[$i]->paidAmount;
                                        } else {
                                            echo "";
                                        } ?></td>

                                    <!-- 3 -->
                                    <td><?php
                                        if ($allData[$i]->tabletype == 3) {
                                            echo $allData[$i]->paidAmount;
                                        }

                                        // if ($allData[$i]->tabletype == 2) {
                                        //     if ($allData[$i]->type == 3) {
                                        //         echo $allData[$i]->paidAmount;
                                        //     } else {
                                        //         echo "";
                                        //     }
                                        // } else {
                                        //     echo "";
                                        // } 
                                        ?>
                                    </td>

                                    <!-- 4 -->
                                    <td><?php if ($allData[$i]->tabletype == 2) {
                                            if ($allData[$i]->type != 3) {
                                                echo $allData[$i]->paidAmount;
                                            }
                                        } ?></td>
                                    <!-- 5 -->
                                    <td><?php
                                        if ($allData[$i]->tabletype == 2) {
                                            if ($allData[$i]->type == 3) {
                                                echo $allData[$i]->paidAmount;
                                            }
                                        }
                                        ?></td>
                                    <!-- 6 -->
                                    <td><?php

                                        if ($allData[$i]->tabletype == 1) {
                                            $tenantBalance = $tenantBalance - ($allData[$i]->paidAmount);
                                            echo number_format($tenantBalance, 2);
                                        } else {
                                            echo "";
                                        } ?></td>
                                    <!-- 7 -->
                                    <td><?php
                                        if ($allData[$i]->tabletype == 1) {


                                            echo $allData[$i]->notes . "  ( " . $allData[$i]->installmentNumber . " )" . $this->lang->line('INSTALLMENT_PAYMENT_FROM_TENANT');
                                        } else if ($allData[$i]->tabletype == 2) {
                                            if ($allData[$i]->type == 3) {

                                                echo ($allData[$i]->notes . "  " . $this->lang->line('OWNER_DUE_FOR_INSTALLMENT') . "( " . $allData[$i]->installmentNumber . " )");

                                                // if ($allData[$i]->expenseType == 1) {
                                                //    
                                                //     echo ("Attestation to be charged on " . $allData[$i]->installmentNumber . $s . " Installment");
                                                // } else if ($allData[$i]->expenseType == 2) {
                                                //    
                                                //     echo ("Maintenance to be charged on " . $allData[$i]->installmentNumber . $s . " Installment");
                                                // }
                                            }
                                            if ($allData[$i]->type == 2) {

                                                echo $allData[$i]->notes . "  " . $this->lang->line('MANAGEMENT_FEES');
                                            }
                                            if ($allData[$i]->type == 1) {

                                                echo ($allData[$i]->notes . "  " . $this->lang->line('MANAGEMENT_FEES') . "(" . $this->lang->line('AGENCY_FEE') . ")");
                                            }
                                        } else if ($allData[$i]->tabletype == 3) {

                                            if ($allData[$i]->expenseType == 2) {

                                                echo ($allData[$i]->notes . "  " . $this->lang->line('ATTESTATION_FOR_INSTALLMENT') . "( " . $allData[$i]->installmentNumber .  " )");
                                            } else {

                                                echo ($allData[$i]->notes . "  " . $this->lang->line('MAINTENANCE_FOR_INSTALLMENT') . "( " . $allData[$i]->installmentNumber .  " )");
                                            }
                                        }
                                        ?></td>
                                </tr>
                            <?php  }
                            // }   
                            ?>
                        </tbody>
                        <?php endif; ?>
                    </table>
                </div>
            </div>




        </div>
    <?php endif; ?>
</div>


<script>
    function payments(id) {

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
</script>
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
<div class="content-wrapper">
    <div class="page-header">
        <div class="container text-center">
            <button title="<?php echo $this->lang->line('PAYMENTS'); ?>" onclick="payments('<?php echo ($contractsData->contractNumber); ?>');" type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('PAYMENTS'); ?> </button>
            <button title="<?php echo $this->lang->line('EXPENSES'); ?>" onclick="expenses('<?php echo ($contractsData->contractNumber); ?>');" type="button" class="btn btn-sm btn-danger"><?php echo $this->lang->line('EXPENSES'); ?> </button>
            <button title="<?php echo $this->lang->line('MANAGEMENT_FEES'); ?>" onclick="management('<?php echo ($contractsData->contractNumber); ?>');" type="button" class="btn btn-sm btn-success"><?php echo $this->lang->line('MANAGEMENT_FEES'); ?> </button>
            <button title="<?php echo $this->lang->line('OWNER_DUES'); ?>" onclick="ownersdue('<?php echo ($contractsData->contractNumber); ?>');" type="button" class="btn btn-sm btn-info"><?php echo $this->lang->line('OWNER_DUES'); ?> </button>
            <!-- <button title="<?php echo $this->lang->line('STATEMENT'); ?>" onclick="statement('<?php echo ($contractsData->contractNumber); ?>');" type="button" class="btn btn-sm btn-secondary"><?php echo $this->lang->line('STATEMENT'); ?> </button> -->



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
                    </table>
                </div>
            </div>
        </div>
    </div>
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
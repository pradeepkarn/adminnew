<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"></h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="< ?php echo base_url('permission') ?>">< ?php echo $this->lang->line('permissions'); ?></a></li>-->
                <li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('CONTRACTS'); ?></li>
            </ol>
        </nav>
    </div>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title"><?php // echo " Tenant Payment Status"; //$this->lang->line('CONTRACTS'); 
                                    ?>

            </h4><?php
                    // print_r($installmentData);

                    ?>

            <div class="row">
                <div class="col-12">
                    <div class="">

                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <div class="custom-control custom-switch">
                                <table class="table" border="1">
                                    <thead>
                                        <tr>

                                            <th scope="col" style="font-weight: bold;"><?php echo " Tenant Payment Status"; ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php


                                        for ($i = 0; $i <= sizeof($installmentData) - 1; $i++) { ?>
                                            <tr>

                                                <td>

                                                    <?php if ($installmentData[$i]->paidStatus == 1) {
                                                        echo "Installment No. " . $installmentData[$i]->installmentNumber . " is Completely Paid";
                                                    } else if ($installmentData[$i]->paidStatus == 2) {
                                                        echo "Installment No. " . $installmentData[$i]->installmentNumber . " is Partially Paid";
                                                    }

                                                    ?></td>
                                            </tr>

                                        <?php
                                        }
                                        for ($j = $paidInstallmentData[0]->maxInstallment + 1; $j <= $contractsData->installments; $j++) { ?>
                                            <tr>

                                                <td><?php echo "Installment No. " . $j . " Not yet Paid"; ?></td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
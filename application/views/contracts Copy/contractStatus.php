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
            <h4 class="card-title"><?php echo "Contracts Status"; ?>

            </h4><br /><br />

            <div class="row">
                <div class="col-12">
                    <div class="">
                        <div class="col-sm-12 col-xs-12 col-md-12">
                            <div class="custom-control custom-switch">

                                <input type="checkbox" class="custom-control-input" id="IsActive" name="IsActive">
                                <label class="custom-control-label" for="IsActive"><?php echo $this->lang->line('ACTIVE'); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                </div>
                <div class="col-12">
                    <button onClick="submit(this.id)" title="<?php echo $this->lang->line('submit'); ?>" class="btn btn-sm btn-primary">
                        <?php echo $this->lang->line('submit'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submit(clicked) {

        if ($('#IsActive').is(":checked")) {
            status = 1;
        } else {
            status = 0;
        }
        $.ajax({
            url: "<?php echo site_url(); ?>contracts/changeContractStatus",
            dataType: 'json',
            method: "POST",
            data: {
                status: status

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
</script>
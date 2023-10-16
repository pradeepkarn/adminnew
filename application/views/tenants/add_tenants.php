<?php $sess = (object)($this->session->userdata); ?>
  <div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
      <div class="row">
        <div class="col-7 align-self-center">
          <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tenants</h4>
          <div class="d-flex align-items-center">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb m-0 p-0">
                <li class="breadcrumb-item"><a href="index.html" class="text-muted"></a></li>
                <li class="breadcrumb-item text-muted active" aria-current="page">Add Tenants</li>
              </ol>
            </nav>
          </div>
        </div>
        <div class="col-5 align-self-center">
          <div class="customize-input float-right">
            <button type="button" style="border-radius: 50px;" class="btn btn-primary">Add</button>
          </div>
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
              <h4 class="card-title"> <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add'); ?> <?php echo $this->lang->line('TENANTS'); ?>
              </h4>

              <div class="row">
                <div class="col-12 grid-margin">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title"></h4>
                      <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1 ) : ?>
                      <form id="frmTenants" class="form-sample" action="<?php echo base_url() . "tenants/inserttenants"; ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('FULLNAME'); ?> <font color="red">*</font></label>
                              <div class="col-sm-9">
                                <input type="text" id="action" name="action" class="form-control" autocomplete="off" <?php if (isset($tenantsData)) { ?> value="Edit" <?php } ?> hidden />
                                <input type="text" id="tenantId" name="tenantId" class="form-control" autocomplete="off" <?php if (isset($tenantsData)) { ?> value="<?php echo $tenantsData->id; ?>" <?php } ?> hidden />
                                <input type="text" id="fullName" name="fullName" maxlength="100" class="form-control" autocomplete="off" <?php if (isset($tenantsData)) { ?>value="<?php echo $tenantsData->fullName;
                                                                                                                                                                                    ?>" <?php } ?> required="required" />
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group row">
                              <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('MOBILE'); ?><font color="red">*</font> </label>
                              <div class="col-sm-9">
                                <input type="number" id="mobileNumber" name="mobileNumber" class="form-control" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" <?php if (isset($tenantsData)) { ?>value="<?php echo $tenantsData->mobileNumber;
                                                                                                                                                                                                                                                                                                            ?>" <?php } ?> required="required" />
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>


                    <div class="modal-footer">
                    </div>
                  </div>
                </div>
              </div>

              <input class="btn btn-success mr-2" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
              <input class="btn btn-inverse-dark btn-fw mr-2" type="reset" value="<?php echo $this->lang->line('reset'); ?>">
              <a href="<?php echo base_url('tenants'); ?>" class="btn btn-inverse-dark btn-fw mr-2"> <?php echo $this->lang->line('exit'); ?></a>
              </form>
              <?php endif; ?>
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



<!--This page plugins -->
<script>
   var frm_validator;
   $(document).ready(function(e) {
     $("#frmTenants").submit(function(e) {
       frm_validator = $("#frmTenants").valid();
     });

     $('#frmTenants').ajaxForm({
       target: '',
       dataType: 'json',
       beforeSerialize: function($form, options) {

       },
       beforeSubmit: function() {
         if (frm_validator == true) {
           $("#cmdsubmit").text('<?php echo $this->lang->line('loading'); ?>');
           $("#cmdsubmit").prop("disabled", true);
         } else {
           return false;
         }
       },
       success: function(res_data) {

         $("#cmdsubmit").prop("disabled", false);
         $("#cmdsubmit").text("<?php echo $this->lang->line('submit'); ?>");
         if (res_data[0].resSuccess == 1) {

           showSuccessToast(res_data[0].msg, '<?php echo $this->lang->line('success')  ?>');
           setTimeout(function() {
             window.location.href = '<?php echo base_url(); ?>tenants';
           }, 4000);
         } else {
           if (res_data[0].errtype == 'Validation') {
             showDangerToast(res_data[0].msg, '<?php echo $this->lang->line('danger')  ?>');
             return false;
           } else {
             showDangerToast(res_data[0].msg, '<?php echo $this->lang->line('danger')  ?>');
             return false;
           }
         }
       }
     });


     <?php if ($ln == 'ar') { ?>
       $.extend($.validator.messages, {
         required: "هذا الحقل إلزامي",
         remote: "يرجى تصحيح هذا الحقل للمتابعة",
         email: "رجاء إدخال عنوان بريد إلكتروني صحيح",
         url: "رجاء إدخال عنوان موقع إلكتروني صحيح",
         date: "رجاء إدخال تاريخ صحيح",
         dateISO: "رجاء إدخال تاريخ صحيح (ISO)",
         number: "رجاء إدخال عدد بطريقة صحيحة",
         digits: "رجاء إدخال أرقام فقط",
         creditcard: "رجاء إدخال رقم بطاقة ائتمان صحيح",
         equalTo: "رجاء إدخال نفس القيمة",
         extension: "رجاء إدخال ملف بامتداد موافق عليه",
         maxlength: $.validator.format("الحد الأقصى لعدد الحروف هو {0}"),
         minlength: $.validator.format("الحد الأدنى لعدد الحروف هو {0}"),
         rangelength: $.validator.format("عدد الحروف يجب أن يكون بين {0} و {1}"),
         range: $.validator.format("رجاء إدخال عدد قيمته بين {0} و {1}"),
         max: $.validator.format("رجاء إدخال عدد أقل من أو يساوي {0}"),
         min: $.validator.format("رجاء إدخال عدد أكبر من أو يساوي {0}")
       });
     <?php } ?>

     $("#frmTenants").validate({
       errorPlacement: function(label, element) {
         label.addClass('mt-2 text-danger <?php echo ($ln == 'ar') ? 'lbl-error' : ''; ?>');
         label.insertAfter(element);
       },
       highlight: function(element, errorClass) {

       }
     });


     $("#flasherr").fadeTo(2000, 500).slideUp(500, function() {
       $("#flasherr").slideUp(500);
     });


   });
 </script>

 
<?php $sess = (object)($this->session->userdata); ?>
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-7 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
          <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add'); ?> <?php echo $this->lang->line('OWNERS'); ?>
        </h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url('properties') ?>"><?php echo $this->lang->line('PROPERTIES'); ?></a></li>
              <li class="breadcrumb-item text-muted active" aria-current="page">
                <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add') ?> <?php echo $this->lang->line('PROPERTIES'); ?>
              </li>
            </ol>
          </nav>
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
            <h4 class="card-title"> <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add'); ?> <?php echo $this->lang->line('PROPERTIES'); ?>
            </h4>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1 ) : ?>
                    <form id="frmproperties" class="form-sample" action="<?php echo base_url() . "properties/insertProperties"; ?>" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('OWNER'); ?> <font color="red">*</font></label>
                            <div class="col-sm-9">
                              <input type="text" id="action" name="action" class="form-control" autocomplete="off" <?php if (isset($propertiesData)) { ?> value="Edit" <?php } ?> hidden />
                              <input type="text" id="propertyId" name="propertyId" class="form-control" autocomplete="off" <?php if (isset($propertiesData)) { ?> value="<?php echo $propertiesData->id; ?>" <?php } ?> hidden />

                              <select id="ownerId" name="ownerId" class="form-control form-select" required>
                                <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_OWNER'); ?></option>
                                <?php
                                foreach ($ownerData as $row) {
                                  echo '<option value="' . $row->id . '"';
                                  if (isset($propertiesData)) {
                                    if ($propertiesData->ownerId == $row->id) { ?>
                                      selected
                                <?php  }
                                  }
                                  echo ' >' . $row->fullName . '</option>';
                                } ?>

                              </select>



                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('PROPERTY_NAME'); ?><font color="red">*</font> </label>
                            <div class="col-sm-9">
                              <input type="text" id="propertyName" name="propertyName" class="form-control" autocomplete="off" <?php if (isset($propertiesData)) { ?>value="<?php echo $propertiesData->propertyName;
                                                                                                                                                                            ?>" <?php } ?> required="required" />
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('NUMBER_OF_RESIDENTIAL_UNITS'); ?> <font color="red">*</font></label>
                            <div class="col-sm-9">
                              <input type="number" id="residentialUnits" name="residentialUnits" class="form-control" autocomplete="off" <?php if (isset($propertiesData)) { ?>value="<?php echo $propertiesData->residentialUnits;
                                                                                                                                                                                      ?>" readonly <?php } ?> required="required" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('NUMBER_OF_COMMERCIAL_UNITS'); ?><font color="red">*</font> </label>
                            <div class="col-sm-9">
                              <input type="number" id="commercialUnits" name="commercialUnits" class="form-control" autocomplete="off" <?php if (isset($propertiesData)) { ?>value="<?php echo $propertiesData->commercialUnits;
                                                                                                                                                                                    ?>" readonly<?php } ?> required="required" />
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
            <a href="<?php echo base_url('properties'); ?>" class="btn btn-inverse-dark btn-fw mr-2"> <?php echo $this->lang->line('exit'); ?></a>
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


<script>
  var frm_validator;
  $(document).ready(function(e) {
    $("#frmproperties").submit(function(e) {
      frm_validator = $("#frmproperties").valid();
    });

    $('#frmproperties').ajaxForm({
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
            window.location.href = '<?php echo base_url(); ?>properties';
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

    $("#frmproperties").validate({
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
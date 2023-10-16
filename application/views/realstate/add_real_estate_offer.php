<?php $sess = (object)($this->session->userdata); ?>
<div class="page-wrapper">
  <!-- ============================================================== -->
  <!-- Bread crumb and right sidebar toggle -->
  <!-- ============================================================== -->
  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-7 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $this->lang->line('REAL_ESTATE_OFFERS'); ?></h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item"><a href="index.html" class="text-muted"></a></li>
              <li class="breadcrumb-item text-muted active" aria-current="page">Add <?php echo $this->lang->line('REAL_ESTATE_OFFERS'); ?></li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="col-5 align-self-center">
        <!-- <div class="customize-input float-right">
            <button type="button" style="border-radius: 50px;" class="btn btn-primary">Add</button>
          </div> -->
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
            <?php if ($sess->ag_can_create == 1 || $sess->ag_can_update == 1 || $sess->ad_offer == 1) : ?>
              <form id="frmOffers" action="<?php echo base_url() . "realstate/insertestate"; ?>" method="post">
                <div class="form-body">
                  <div class="row">



                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('Purpose'); ?></label>
                        <select name="purpose" class="form-control">
                          <option <?php if (isset($offerData) && $offerData->purpose == "تأجير") {
                                    echo "selected";
                                  } ?> value="تأجير"><?php echo $this->lang->line('lease'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->purpose == "بيع") {
                                    echo "selected";
                                  } ?> value="بيع"><?php echo $this->lang->line('sale'); ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <?php
                        // print_r($offerData);
                        ?>
                        <label class="form-label"><?php echo $this->lang->line('Title'); ?></label>
                        <input type="text" id="action" name="action" class="form-control" autocomplete="off" <?php if (isset($offerData)) { ?> value="Edit" <?php } ?> hidden />
                        <input type="text" id="offerId" name="offerId" class="form-control" autocomplete="off" <?php if (isset($offerData)) { ?> value="<?php echo $offerData->id; ?>" <?php } ?> hidden />
                        <input type="text" id="fullName" name="title" maxlength="100" class="form-control" autocomplete="off" <?php if (isset($offerData)) { ?>value="<?php echo $offerData->title;
                                                                                                                                                                      ?>" <?php } ?> required="required" />
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('District'); ?></label>
                        <input name="district" value="<?php echo isset($offerData) ? $offerData->district : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('District'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('City'); ?></label>
                        <input name="city" value="<?php echo isset($offerData) ? $offerData->city : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('City'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('Site'); ?></label>
                        <input name="site" value="<?php echo isset($offerData) ? $offerData->site : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('Site'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('PropertyType'); ?></label>
                        <select name="property_type" class="form-control">
                          <option <?php if (isset($offerData) && $offerData->property_type == "شقق") {
                                    echo "selected";
                                  } ?> value="شقق"><?php echo $this->lang->line('property_type_apartments'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "فيلا") {
                                    echo "selected";
                                  } ?> value="فيلا"><?php echo $this->lang->line('property_type_villa'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "أدوار") {
                                    echo "selected";
                                  } ?> value="أدوار"><?php echo $this->lang->line('property_type_roles'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "كسر") {
                                    echo "selected";
                                  } ?> value="كسر"><?php echo $this->lang->line('property_type_break'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "غرف") {
                                    echo "selected";
                                  } ?> value="غرف"><?php echo $this->lang->line('property_type_rooms'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "محطة") {
                                    echo "selected";
                                  } ?> value="محطة"><?php echo $this->lang->line('property_type_station'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "منزل") {
                                    echo "selected";
                                  } ?> value="منزل"><?php echo $this->lang->line('property_type_house'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "محلات") {
                                    echo "selected";
                                  } ?> value="محلات"><?php echo $this->lang->line('property_type_shops'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "ورش عمل") {
                                    echo "selected";
                                  } ?> value="ورش عمل"><?php echo $this->lang->line('property_type_workshops'); ?></option>
                          <option <?php if (isset($offerData) && $offerData->property_type == "أخرى") {
                                    echo "selected";
                                  } ?> value="أخرى"><?php echo $this->lang->line('property_type_others'); ?></option>
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group mb-3">
                        <?php
                        $imgs = [];
                        $id = null;
                        if (isset($offerData) && $offerData->images != null) {
                          $imgs = json_decode($offerData->images);
                          $id = $offerData->id;
                          // $numimgs = count($imgs);
                          // $img = $numimgs > 0 ? $imgs[0] : null;
                        }
                        ?>
                        <label class="form-label"><?php echo $this->lang->line('PropertyPictures'); ?></label>
                        <?php
                        foreach ($imgs as $key => $img) { ?>
                          <img style="height: 50px; width:50px; object-fit:contain;" src="<?php echo base_url($img); ?>" alt="">
                          <i onclick="deleteImg(id=<?php echo $id; ?>, src=`<?php echo $img; ?>`)" class="fas fa-trash"></i>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-4 d-flex gap-2">


                      <div id="fileInputs">
                        <input name="offer_img[]" type="file" class="form-control" accept=".jpg,.jpeg,.png">
                      </div>
                      <div>
                        <button type="button" class="btn btn-primary" id="addMore">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                      <script>
                        $(document).ready(function() {
                          $("#addMore").click(function() {
                            $("#fileInputs").append('<input name="offer_img[]" type="file" class="form-control" accept=".jpg,.jpeg,.png">');
                          });
                        });
                      </script>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('PropertyAge'); ?></label>
                        <input name="property_age" value="<?php echo isset($offerData) ? $offerData->property_age : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('PropertyAge'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('PropertyArea'); ?></label>
                        <input name="property_area" value="<?php echo isset($offerData) ? $offerData->property_area : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('PropertyArea'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('NumberOfTurns'); ?></label>
                        <input name="no_of_turns" value="<?php echo isset($offerData) ? $offerData->no_of_turns : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('NumberOfTurns'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('NumberOfRooms'); ?></label>
                        <input name="no_of_rooms" value="<?php echo isset($offerData) ? $offerData->no_of_rooms : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('NumberOfRooms'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('NumberOfBathrooms'); ?></label>
                        <input name="no_of_bathrooms" value="<?php echo isset($offerData) ? $offerData->no_of_bathrooms : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('NumberOfBathrooms'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('IsFurnished'); ?></label>
                        <input name="furnished" value="<?php echo isset($offerData) ? $offerData->furnished : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('IsFurnished'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('LicenseNumber'); ?></label>
                        <input name="licence_no" value="<?php echo isset($offerData) ? $offerData->licence_no : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('LicenseNumber'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('PaymentMethod'); ?></label>
                        <input name="payment_method" value="<?php echo isset($offerData) ? $offerData->payment_method : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('PaymentMethod'); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('TheValue'); ?></label>
                        <input name="the_value" value="<?php echo isset($offerData) ? $offerData->the_value : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('TheValue'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="form-label"><?php echo $this->lang->line('Details'); ?></label>
                        <input name="details" value="<?php echo isset($offerData) ? $offerData->details : null; ?>" type="text" class="form-control" placeholder="<?php echo $this->lang->line('Details'); ?>" required>
                      </div>
                    </div>
                  </div>


                </div>
                <div class="form-actions mt-4">

                  <input class="btn btn-success mr-2" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
                  <input class="btn btn-inverse-dark btn-fw mr-2" type="reset" value="<?php echo $this->lang->line('reset'); ?>">
                  <a href="<?php echo base_url('realstate-offer-list'); ?>" class="btn btn-inverse-dark btn-fw mr-2"> <?php echo $this->lang->line('exit'); ?></a>



                </div>

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
    $("#frmOffers").submit(function(e) {
      frm_validator = $("#frmOffers").valid();
    });

    $('#frmOffers').ajaxForm({
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
            window.location.href = '<?php echo base_url('realstate-offer-list'); ?>';
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

    $("#frmOffers").validate({
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

  function deleteImg(id, src) {

    swal.fire({
      title: '<?php echo $this->lang->line('are_you_sure'); ?>',
      text: "<?php echo $this->lang->line('you_wont_revert_this'); ?>",
      icon: 'warning',
      showCancelButton: true,
      <?php if ($ln == 'ar') { ?>
        confirmButtonText: 'نعم',
        cancelButtonText: 'لا',
      <?php } ?>
      reverseButtons: true
    }).then((result) => {
      if (result.value) {
        src = src.replace(/\//g, '|');
        window.location.href = '<?php echo base_url('delete-offfer-image/') ?>' + id + "/" + src;

      } else if (result.dismiss === Swal.DismissReason.cancel) {

      }
    })

  }
</script>
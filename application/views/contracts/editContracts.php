<div class="page-wrapper">
  <?php 
   $formlink = isset($contractsData)?"updateContracts":"insertContracts";
  ?>

  <div class="page-breadcrumb">
    <div class="row">
      <div class="col-7 align-self-center">
        <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
          <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add'); ?> <?php echo $this->lang->line('OWNERS'); ?>
        </h4>
        <div class="d-flex align-items-center">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0 p-0">
              <li class="breadcrumb-item"><a href="<?php echo base_url('contracts') ?>"><?php echo $this->lang->line('CONTRACTS'); ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add') ?> <?php echo $this->lang->line('CONTRACTS'); ?></li>
            </ol>
          </nav>
        </div>
      </div>

    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title"> <?php echo !empty($offer->ID) ? $this->lang->line('edit') : $this->lang->line('add'); ?> <?php echo $this->lang->line('CONTRACTS'); ?>
      </h4>

      <div class="row">
        <div class="col-12 grid-margin">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title"></h4>
              <form id="frmcontracts" class="form-sample" action="<?php echo base_url() . "contracts/{$formlink}"; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('PROPERTY_NAME'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="text" id="action" name="action" class="form-control" autocomplete="off" <?php if (isset($contractsData)) { ?> value="Edit" <?php } ?> hidden />
                        <input type="text" id="contractId" name="contractId" class="form-control" autocomplete="off" <?php if (isset($contractsData)) { ?> value="<?php echo $contractsData->id; ?>" <?php } ?> hidden />
                        <input type="hidden" name="propertyId" value="<?php echo $contractsData->propertyId; ?>">
                        <select disabled id="propertyId" class="form-select form-control" required>
                          <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_PROPERTY_NAME'); ?></option>

                          <?php

                          foreach ($propertyData as $row) {

                          ?>
                            <option <?php if($row->pId==$contractsData->propertyId){echo "selected";} ?> data-r="<?php echo $row->rCount; ?>" data-c="<?php echo $row->cCount ?>" value="<?php echo $row->pId ?>"> <?php echo $row->propertyName ?></option>;


                          <?php }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('TENANT_NAME'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <select disabled id="tenantId" name="tenantId" class="form-control form-select" required>
                          <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_TENANT'); ?></option>
                          <?php
                          foreach ($tenantsData as $row) {
                            echo '<option value="' . $row->id . '"';
                            if (isset($contractsData)) {
                              if ($contractsData->tenantId == $row->id) { ?>
                                selected
                          <?php  }
                            }
                            echo ' >' . $row->fullName . '</option>';
                          } ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('AVAILABLE_UNITS'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select disabled id="units" name="units[]" class="form-control form-select" required multiple>
                          <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_TENANT'); ?></option>
                        </select>
                      </div>
                    </div>
                  </div>

                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('CONTRACT_NUMBER'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input readonly type="text" id="contractNumber" name="contractNumber" class="form-control" autocomplete="off" <?php if (isset($contractsData)) { ?>value="<?php echo $contractsData->contractNumber;
                                                                                                                                                                          ?>" <?php } ?> required="required" />
                        <span class="errorCls" id="err_contractNumber" style="display: none;color: red;font-size: 10px;"> <?php echo $this->lang->line('CONTRACT_NUMBER_ALREADY_EXIST'); ?> </span>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('CONTRACT_PERIOD'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <select id="contractPeriod" name="contractPeriod" class="form-control form-select" required>
                          <option value=""  disabled hidden><?php echo $this->lang->line('SELECT_TENANT'); ?></option>
                          <?php
                          for ($i = 1; $i <= 5; $i++) {
                            echo '<option value="' . $i . '"';
                            if (isset($contractsData)) {
                              if ($contractsData->contractPeriod == $i) {
                                echo "selected";  
                              }
                            }
                            echo ' >' . $i . ' Year</option>';
                          } ?>

                        </select>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('START_DATE'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="date" value="<?php echo isset($contractsData->startDate)?$contractsData->startDate:null; ?>" name="startDate" id="startDate" class="form-control" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('EXPIRY_DATE'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input type="date" value="<?php echo isset($contractsData->expiryDate)?$contractsData->expiryDate:null; ?>" id="expiryDate" name="expiryDate" class="form-control" autocomplete="off" readonly />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('INSTALLMENTS'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <select disabled id="installments" name="installments" class="form-control form-select" required>
                          <option value="" selected disabled hidden><?php echo $this->lang->line('SELECT_TENANT'); ?></option>
                          <option <?php if(isset($contractsData->installments) && $contractsData->installments=="1"){echo "selected";} ?> value="1">1</option>
                          <option <?php if(isset($contractsData->installments) && $contractsData->installments=="2"){echo "selected";} ?> value="2">2</option>
                          <option <?php if(isset($contractsData->installments) && $contractsData->installments=="4"){echo "selected";} ?> value="4">4</option>
                          <option <?php if(isset($contractsData->installments) && $contractsData->installments=="12"){echo "selected";} ?> value="12">12</option>
                        </select>

                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('RENT_AMOUNT'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input readonly value="<?php echo isset($contractsData->rentAmount)?$contractsData->rentAmount:null; ?>" type="number" id="rentAmount" name="rentAmount" class="form-control" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" required="required" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('WATER_FEE'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->waterFee)?$contractsData->waterFee:null; ?>" id="waterFee" name="waterFee" class="form-control" autocomplete="off" required="required" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('ELECTRICITY_FEE'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->electricityFee)?$contractsData->electricityFee:null; ?>" id="electricityFee" name="electricityFee" class="form-control" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" required="required" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('OTHER_FEE'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->otherFee)?$contractsData->otherFee:null; ?>" id="otherFee" name="otherFee" class="form-control" autocomplete="off"  required="required" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('TOTAL_RENT'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input type="number" readonly value="<?php echo isset($contractsData->totalRent)?$contractsData->totalRent:null; ?>" id="totalRent" name="totalRent" class="form-control" autocomplete="off" required="required" />
                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <!--<div class="col-md-6">-->
                  <!--  <div class="form-group row">-->
                  <!--    <label class="col-sm-3 col-form-label"><?php //echo $this->lang->line('INSURANCE'); 
                                                                  ?> <font color="red">*</font></label>-->
                  <!--    <div class="col-sm-9">-->
                  <!--      <input type="number" id="insurance" name="insurance" class="form-control" autocomplete="off" 
                    <?php //if (isset($contractsData)) { 
                    ?>value="<?php //echo $contractsData->propertyId;
                                                                  ?>" <?php //} 
                                                                                                              ?> required="required" />
                    <!--    </div>-->
                  <!--  </div>-->
                  <!--</div>-->
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('AGENCY_FEE'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->agencyFee)?$contractsData->agencyFee:null; ?>" id="agencyFee" name="agencyFee" class="form-control" autocomplete="off" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="12" required="required" />
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('MGMT_FEE_PERCENTAGE'); ?> <font color="red">*</font></label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->mgmtFeesPercentage)?$contractsData->mgmtFeesPercentage:null; ?>" id="mgmtFeesPercentage" name="mgmtFeesPercentage" class="form-control" autocomplete="off" />
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group row">
                      <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('MGMT_FEE_FIXED'); ?><font color="red">*</font> </label>
                      <div class="col-sm-9">
                        <input type="number" value="<?php echo isset($contractsData->mgmtFeesFixed)?$contractsData->mgmtFeesFixed:null; ?>" id="mgmtFeesFixed" name="mgmtFeesFixed" class="form-control" autocomplete="off" />
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
      <input type="hidden" name="contractNumber" value="<?php echo isset($contractsData->contractNumber)?$contractsData->contractNumber:null; ?>">
      <input class="btn btn-success mr-2" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
      <input class="btn btn-inverse-dark btn-fw mr-2" type="reset" value="<?php echo $this->lang->line('reset'); ?>">
      <a href="<?php echo base_url('contracts'); ?>" class="btn btn-inverse-dark btn-fw mr-2"> <?php echo $this->lang->line('exit'); ?></a>
      </form>
    </div>
  </div>
</div>



<script>
  $("#contractNumber").focusout(function() {
    var contractNumber = $('#contractNumber').val();
    $.ajax({
      url: "<?php echo site_url(); ?>contracts/checkContractNumber",
      dataType: 'json',
      method: "POST",

      data: {
        contractNumber: contractNumber
      },
      success: function(data) {

        if (data.status == "true") {
          $("#err_contractNumber").hide();

        } else {
          $("#err_contractNumber").show();
          $("#contractNumber").val('');

        }
      },

    });
  });
  $(document).ready(function() {
    $("#mgmtFeesPercentage").change(function() {
      $('#mgmtFeesFixed').attr("disabled", true);
    });

    $("#mgmtFeesFixed").change(function() {
      $('#mgmtFeesPercentage').attr("disabled", true);
    });

    $("#contractPeriod, #startDate").change(function() {
      var str = $("#startDate").val();
      var j = str.split('-');
      var str = j[2] + "/" + j[1] + "/" + j[0];
      // console.log(str)
      // if (/^\d{2}\/\d{2}\/\d{4}$/i.test(str)) {

      var parts = str.split("/");

      var day = parts[0] && parseInt(parts[0], 10);
      var month = parts[1] && parseInt(parts[1], 10);
      var year = parts[2] && parseInt(parts[2], 10);
      var duration = parseInt($("#contractPeriod").val(), 10);

      if (day <= 31 && day >= 1 && month <= 12 && month >= 1) {

        var expiryDate = new Date(year, month - 1, day);
        expiryDate.setFullYear(expiryDate.getFullYear() + duration);

        var day = ('0' + expiryDate.getDate()).slice(-2);
        var month = ('0' + (expiryDate.getMonth() + 1)).slice(-2);
        var year = expiryDate.getFullYear();
        d = (day + "-" + month + "-" + year);
        var k = (year + "-" + month + "-" + day + "T00:00:00");

        var pastDate = new Date(k);
        var fiveDaysAgo = new Date(new Date(k).setDate(pastDate.getDate() - 1));

        // $("#expiryDate").val(day + "-" + month + "-" + year);
        $("#expiryDate").val(convert(fiveDaysAgo));

      } else {
        // display error message
      }
      // }
    });
  });

  function convert(str) {
    var date = new Date(str),
      mnth = ("0" + (date.getMonth() + 1)).slice(-2),
      day = ("0" + date.getDate()).slice(-2);
    return [date.getFullYear(),mnth,day].join("-");
  }

  $("#rentAmount, #waterFee,#electricityFee,#otherFee").change(function() {
    var rentAmount = $("#rentAmount").val();
    var waterFee = $("#waterFee").val();
    var electricityFee = $("#electricityFee").val();
    var otherFee = $("#otherFee").val();
    var totalAmt = parseFloat(rentAmount) + parseFloat(waterFee) + parseFloat(electricityFee) + parseFloat(otherFee);
    $("#totalRent").val(totalAmt);
    $('#totalRent').attr('readonly', 'readonly');
    //  $('#totalRent').attr("disabled", true);
  });



  <?php if (isset($contractsData)) { 
    function units($contractsData){
        $rdata = [];
        foreach ($contractsData->arr as $cd) {
            $rdata[] = $cd->unitNumber;
        }
        return $rdata;
    }
    $units = units($contractsData);
    echo "var units = " . json_encode($units) . ";";
?>

$(document).ready(function() {
    var propertyId = $('#propertyId').val();
    $('#candidateId').html('');
    var listItems;
    listItems = "<option value='' selected disabled hidden>Select</option> ";
    $.ajax({
        url: "<?php echo site_url(); ?>contracts/<?php echo isset($contractsData)?'getOccupiedUnits':'getVacantUnits'; ?>",
        method: "POST",
        data: {
            propertyId: propertyId
        },
        dataType: "json",
        success: function(data) {
            if (data.status == "true") {
                for (var i = 0; i < data.result.length; i++) {
                    if (data.result[i].unitName.charAt(0) == "R") {
                        res = "<?php echo $this->lang->line('R'); ?>";
                    } else {
                        res = "<?php echo $this->lang->line('C'); ?>";
                    }
                    var optionValue = data.result[i].id;
                    var optionText = res + data.result[i].unitName.substring(1);
                    
                    // Check if the optionValue is in the units array
                    var isSelected = units.indexOf(optionValue) !== -1;

                    listItems += "<option value='" + optionValue + "' " + (isSelected ? 'selected' : '') + ">" + optionText + "</option>";
                }
                $('#units').html(listItems);
            } else {
                $('#units').html(listItems);
            }
        }
    });
});

<?php } ?>

  $('#propertyId').change(function() {
    var propertyId = $('#propertyId').val();
    $('#candidateId').html('');
    var listItems;
    listItems = "<option value='' selected disabled hidden>Select</option> ";
    $.ajax({
      url: "<?php echo site_url(); ?>contracts/<?php echo isset($contractsData)?'getOccupiedUnits':'getVacantUnits'; ?>",
      method: "POST",
      data: {
        propertyId: propertyId
      },
      dataType: "json",
      success: function(data) {

        if (data.status == "true") {
          for (var i = 0; i < data.result.length; i++) {

            if (data.result[i].unitName.charAt(0) == "R") {

              res = "<?php echo $this->lang->line('R'); ?>";
            } else {
              res = "<?php echo $this->lang->line('C'); ?>";
            }
            listItems += "<option value='" + data.result[i].id + "'>" + res + data.result[i].unitName.substring(1); + "</option>";

          }

          $('#units').html(listItems);
        } else {

          $('#units').html(listItems);
        }
      }
    });


  });



  var frm_validator;
  $(document).ready(function(e) {
    $("#frmcontracts").submit(function(e) {
      frm_validator = $("#frmcontracts").valid();
    });

    $('#frmcontracts').ajaxForm({
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
            window.location.href = '<?php echo base_url(); ?>contracts';
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

    $("#frmcontracts").validate({
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
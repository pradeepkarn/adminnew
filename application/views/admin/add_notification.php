<?php ?>
<style>
.sel-color{ color:#343a40 !important}
</style>
<!-- Dropify file upload - You can choose a theme from css/themes instead of get all themes -->
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"></h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('notification') ?>"><?php echo $this->lang->line('notifications'); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo !empty($notification->ID)?$this->lang->line('edit'):$this->lang->line('add') ?> <?php echo $this->lang->line('notification'); ?></li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> <?php echo !empty($notification->ID)?$this->lang->line('edit'):$this->lang->line('add'); ?> <?php echo $this->lang->line('notification'); ?>
        </h4>
                        
   		<div class="row">
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form  id="frmNotification" class="form-sample" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('screen'); ?></label>
                            <div class="col-sm-9">
                              <input type="tel" id="Screen" name="Screen" maxlength="2" class="form-control only-numeric" autocomplete="off" value="<?php echo !empty($notification->Screen)?$notification->Screen:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('link'); ?></label>
                            <div class="col-sm-9">
                              <input type="url" id="Link" name="Link" maxlength="500"  class="form-control" autocomplete="off" value="<?php echo !empty($notification->Link)?$notification->Link:''; ?>"  required="required"/>                              
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('text_ar'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="TextAr" name="TextAr" maxlength="500" class="form-control" autocomplete="off" value="<?php echo !empty($notification->TextAr)? stripslashes(htmlspecialchars($notification->TextAr)):''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('text_en'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="TextEn" name="TextEn" maxlength="500"  class="form-control" autocomplete="off" value="<?php echo !empty($notification->TextEn)? stripslashes(htmlspecialchars($notification->TextEn)):''; ?>"  required="required"/>                              
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                      	<div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('sex'); ?></label>
                            <div class="col-sm-9">
                            	<select id="Sex" name="Sex" class="form-control" required="required">
                                	<option value="">--</option>
									<?php foreach($sex as $key_ms => $val_ms){ ?>
                                    	<option value="<?php echo $key_ms; ?>" <?php if(!empty($notification->Sex) && $notification->Sex == $key_ms){ echo "selected"; } ?>><?php  echo $val_ms; ?></option>
                                    <?php } ?>
                                </select>                              
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('city'); ?></label>
                            <div class="col-sm-9">
                            	<select id="CityID" name="CityID" class="form-control" required="required">
                                	<option value=""><?php echo $this->lang->line('city'); ?></option>
									<?php foreach($notification_city as $ncity){ ?>
                                    	<option value="<?php echo $ncity->ID; ?>" <?php if(!empty($notification->CityID) && $notification->CityID == $ncity->ID){ echo "selected"; } ?>><?php  if($ln == 'ar'){ echo $ncity->NameAr; }else{ echo  $ncity->NameEn; } ?></option>
                                    <?php } ?>
                                </select>                                    
                            </div>
                          </div>
                        </div>                        
                      </div>
                      
                      <div class="row">                        
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('from_age'); ?></label>
                            <div class="col-sm-9">
                              <input type="tel" id="FromAge" name="FromAge" maxlength="3"  class="form-control only-numeric" autocomplete="off" value="<?php if(isset($notification->FromAge) && $notification->FromAge != ""){ echo $notification->FromAge; } ?>"  required="required"/>                              
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('to_age'); ?></label>
                            <div class="col-sm-9">
                              <input type="tel" id="ToAge" name="ToAge" maxlength="3" class="form-control only-numeric" autocomplete="off" value="<?php if(isset($notification->ToAge) && $notification->ToAge != ""){ echo $notification->ToAge; } ?>" required="required" />
                            </div>
                          </div>
                        </div>
                      </div>
                      
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('from_date'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="FromDate" name="FromDate" maxlength="10" class="form-control" autocomplete="off" value="<?php echo !empty($notification->FromDate)?$notification->FromDate:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('to_date'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="ToDate" name="ToDate" maxlength="10"  class="form-control" autocomplete="off" value="<?php echo !empty($notification->ToDate)?$notification->ToDate:''; ?>"  required="required"/>                              
                            </div>
                          </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('one_time'); ?></label>
                            <div class="col-sm-9">
                              <input type="tel" id="OneTime" name="OneTime" maxlength="5" class="form-control only-numeric" autocomplete="off" value="<?php echo !empty($notification->OneTime)?$notification->OneTime:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-xs-3 col-md-3 col-form-label"><?php echo $this->lang->line('is_active'); ?></label>
                            <div class="col-sm-9 col-xs-9 col-md-9">
                              <div class="custom-control custom-switch">
                                  <input type="checkbox" class="custom-control-input" id="IsActive" name="IsActive" <?php echo !empty($notification->IsActive)?'checked':''; ?>>
                                  <label class="custom-control-label" for="IsActive" style="margin-top:10px;">&nbsp;</label>
                              </div>
                          	</div>
                          </div>
                        </div>
                     </div>                      
                     <div class="col-sm-12">&nbsp;</div>
                      <input type="hidden" id="recid" name="recid"  value="<?php echo !empty($notification->ID)?$notification->ID:'0'; ?>" />
                      <input type="hidden" id="task" name="task" value="<?php echo !empty($notification->ID)?'2':'1'; ?>" />
                      <input class="btn btn-success" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
                      <input class="btn btn-inverse-dark btn-fw" type="reset" value="<?php echo $this->lang->line('reset'); ?>" >
                      <a  href="<?php echo base_url('notification'); ?>" class="btn btn-inverse-dark btn-fw"> <?php echo $this->lang->line('exit'); ?></a>
                    </form>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
</div>
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js'); ?>"></script>
<!-- Dropify Plugin Js -->
<script src="<?php echo base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/inputmask.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js'); ?>"></script>
<!-- content-wrapper ends -->
<script>
var frm_validator;
$(document).ready(function(e) {
	
  $('.only-numeric').inputmask('numeric', {rightAlign: true});

	$('#FromDate').datepicker({
		autoclose: true,
	    format: 'dd-mm-yyyy',
		todayHighlight: true
	});
	
	$('#ToDate').datepicker({
		autoclose: true,
	    format: 'dd-mm-yyyy',
		todayHighlight: true
	});
	
	$('input[type="url"]').on('blur', function(){
	   var string = $(this).val();
	   if (!string.match(/^https?:/) && string.length) {
		 string = "http://" + string;
		  $(this).val(string)
	   }
	});
	
  
  $.validator.setDefaults({
		submitHandler: function() {
			
			var frmNotification = $("#frmNotification").serialize();
			$.ajax({
				type: "POST",
				dataType: "json", 
				url: "<?php echo base_url(); ?>savenotification",
				data: frmNotification,
				beforeSend: function (xhr) {
			  
				  $("#cmdsubmit").text('<?php echo $this->lang->line('loading'); ?>');
				  $("#cmdsubmit").prop("disabled",true);
				},
				success: function(res_data) { 
					$("#cmdsubmit").prop("disabled",false);	
					$("#cmdsubmit").text("<?php echo $this->lang->line('submit'); ?>");
					if (res_data[0].resSuccess == 1) { 
					
						showSuccessToast(res_data[0].msg,'<?php echo $this->lang->line('success')  ?>');
						setTimeout(function(){ 
							window.location.href='<?php echo base_url(); ?>notification';
						 }, 4000);
		
					}else if (res_data[0].resSuccess == 2){
						showDangerToast(res_data[0].msg,'<?php echo $this->lang->line('danger')  ?>');
						return false;	
					}					
				}
			});
    	}
  });
  
   
  		
	<?php if($ln == 'ar'){ ?>	
		$.extend( $.validator.messages, {
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
				maxlength: $.validator.format( "الحد الأقصى لعدد الحروف هو {0}" ),
				minlength: $.validator.format( "الحد الأدنى لعدد الحروف هو {0}" ),
				rangelength: $.validator.format( "عدد الحروف يجب أن يكون بين {0} و {1}" ),
				range: $.validator.format( "رجاء إدخال عدد قيمته بين {0} و {1}" ),
				max: $.validator.format( "رجاء إدخال عدد أقل من أو يساوي {0}" ),
				min: $.validator.format( "رجاء إدخال عدد أكبر من أو يساوي {0}" )
		} );
	<?php } ?>		
		
		 $("#frmNotification").validate({
		  errorPlacement: function(label, element) {
			label.addClass('mt-2 text-danger <?php echo ($ln == 'ar')? 'lbl-error' : ''; ?>');
			label.insertAfter(element);
		  },
		  highlight: function(element, errorClass) {
			//$(element).parent().addClass('has-danger');
			//$(element).addClass('form-control-danger');
		  }
		});
		
		
		$("#flasherr").fadeTo(2000, 500).slideUp(500, function(){
    		$("#flasherr").slideUp(500);
		});
		
		
    });

</script>
<style>
.sel-color{ color:#343a40 !important}
</style>
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"></h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('appusers') ?>"><?php echo $this->lang->line('app_users'); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo !empty($appuser->ID)?$this->lang->line('edit'):$this->lang->line('add') ?> <?php echo $this->lang->line('app_user'); ?></li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> 

<div class="float-right" >
<?php
$imgurl = base_url('/showimage/appuserimage/' . $appuser->ID . getImageExtension($appuser->profile_image));
?>
<img class=" img-lg " src="<?php echo $imgurl; ?>" onclick="displayProfileImage('<?php echo $imgurl; ?>')" style="cursor:pointer;" alt="ProfileImage" />
</div>

<?php echo !empty($appuser->ID)?$this->lang->line('edit'):$this->lang->line('add'); ?> <?php echo $this->lang->line('app_user');  ?> 
<!--            <a href="http://192.168.0.112/web6/offersproject/users" class="btn btn-success btn-fw <?php echo ($ln == 'en')?'pull-right':'pull-left' ?>"> <?php echo $this->lang->line('import_app_user');  ?></a>
-->       

 </h4>
 
<br />
<br />
<br />

         
     
   <div class="row">
          <div class="col-12 grid-margin">
                
<form  id="frmAddappUser" class="form-sample" method="post">
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('first_name'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="FirstName" name="FirstName" maxlength="100"  class="form-control" autocomplete="off" value="<?php echo !empty($appuser->FirstName)?$appuser->FirstName:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12 ">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('second_name'); ?>  </label>
                            <div class="col-sm-9">
                              <input type="text" id="SecondName" name="SecondName" maxlength="100" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->SecondName)?$appuser->SecondName:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('third_name'); ?> </label>
                            <div class="col-sm-9">
                              <input type="text" id="ThirdName" name="ThirdName" maxlength="100"  class="form-control" autocomplete="off" value="<?php echo !empty($appuser->ThirdName)?$appuser->ThirdName:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('last_name'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="LastName" name="LastName" maxlength="100" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->LastName)?$appuser->LastName:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('id_number'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="IDNumber" name="IDNumber" maxlength="100" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->IDNumber)?$appuser->IDNumber:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('email'); ?> </label>
                            <div class="col-sm-9">
                              <input type="email" id="Email" name="Email" maxlength="100" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->Email)?$appuser->Email:''; ?>" required="required"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('mobile'); ?> </label>
                            <div class="col-sm-9">
                              <input type="text" id="Mobile" name="Mobile" maxlength="100" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->Mobile)?$appuser->Mobile:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('age'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="Age" name="Age" maxlength="3" class="form-control" autocomplete="off" value="<?php echo !empty($appuser->Age)?$appuser->Age:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('password'); ?> </label>
                            <div class="col-sm-9">
                              <input type="password" id="Password" name="Password" maxlength="100"  class="form-control" autocomplete="off" value="<?php echo !empty($appuser->Password)?$appuser->Password:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>  
                        
                        <div class="col-md-6 col-sm-12">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('sex'); ?></label>
                            <div class="col-sm-9">
                           		<select id="SEX" name="SEX" class="form-control sel-color" required="required">
                                <option value="">--</option>
                                	<option <?php echo (!empty($appuser->SEX) && $appuser->SEX == 1 )?'selected':''; ?> value="1">Male</option>
                                    <option <?php echo (!empty($appuser->SEX) && $appuser->SEX == 2 )?'selected':''; ?> value="2">Female</option>
                                </select>
                            </div>
                          </div>
                        </div>                                              
                      </div>


                     
                                            

                        
                      
                       
                        
                      
                        
                        
                        <div class="col-sm-6 col-xs-12 col-md-6">
                            <div class="row">
                                <label class="col-sm-3 col-xs-3 col-md-3 "><?php echo $this->lang->line('is_active'); ?></label>
                                <div class="col-sm-9 col-xs-9 col-md-9">
                                  <div class="custom-control custom-switch">
                                      <input type="checkbox" class="custom-control-input" id="IsActive" name="IsActive" <?php echo !empty($appuser->IsActive)?'checked':''; ?>>
                                      <label class="custom-control-label" for="IsActive"></label>
                                  </div>
                                </div>
                            </div>
                        </div>   
                        
         


                                             
                      <div class="col-sm-12">&nbsp;</div>
                      <input type="hidden" id="recid" name="recid"  value="<?php echo !empty($appuser->ID)?$appuser->ID:'0'; ?>" />
                      <input type="hidden" id="task" name="task" value="<?php echo !empty($appuser->ID)?'2':'1'; ?>" />
                      <input class="btn btn-success" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
                      <input class="btn btn-inverse-dark btn-fw" type="reset" value="<?php echo $this->lang->line('reset'); ?>" >
                      <a  href="<?php echo base_url('appusers'); ?>" class="btn btn-inverse-dark btn-fw"> <?php echo $this->lang->line('exit'); ?></a>


                    </form>
                
           </div>
        </div>
      </div>
    </div>
</div>

<!-- content-wrapper ends -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js'); ?>"></script>
<script>
   	$(document).ready(function(e) {
		
  $.validator.setDefaults({
    submitHandler: function() {
      	
				var frmAddappUser = $("#frmAddappUser").serialize();
	  			$.ajax({
					type: "POST",
					dataType: "json", 
					url: "<?php echo base_url(); ?>saveappuser",
					data: frmAddappUser,
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
								window.location.href='<?php echo base_url(); ?>appusers';
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
		
		 $("#frmAddappUser").validate({
		  errorPlacement: function(label, element) {
			label.addClass('mt-2 text-danger <?php echo ($ln == 'ar')? 'lbl-error' : ''; ?>');
			label.insertAfter(element);
		  },
		  highlight: function(element, errorClass) {
			$(element).parent().addClass('has-danger')
			$(element).addClass('form-control-danger')
		  }
		});
		
		
		$("#flasherr").fadeTo(2000, 500).slideUp(500, function(){
    		$("#flasherr").slideUp(500);
		});
		
		
    });


	function displayProfileImage(catLogo){
		$('#modalProviderLogo').modal({
			show: true
		});
		var display_img = "";
		display_img = '<img src="' + catLogo + '" style="width:70%;">';
		$("#modalProviderLogo #divModalProviderLogo").html('').html(display_img);			
	}

</script>

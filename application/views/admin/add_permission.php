<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"></h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo base_url('permission') ?>"><?php echo $this->lang->line('permissions'); ?></a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo !empty($permission->ID)?$this->lang->line('edit'):$this->lang->line('add') ?> <?php echo $this->lang->line('permission'); ?></li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"> <?php echo !empty($permission->ID)?$this->lang->line('edit'):$this->lang->line('add'); ?> <?php echo $this->lang->line('permission'); ?>
        </h4>
                        
   <div class="row">
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"></h4>
                    <form  id="frmAddPermission" class="form-sample" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('name_arabic'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="NameAr" name="NameAr"  class="form-control" autocomplete="off" value="<?php echo !empty($permission->NameAr)?$permission->NameAr:''; ?>"  required="required"/>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-3 col-form-label"><?php echo $this->lang->line('name_english'); ?></label>
                            <div class="col-sm-9">
                              <input type="text" id="NameEn" name="NameEn" class="form-control" autocomplete="off"  required="required" value="<?php echo !empty($permission->NameEn)?$permission->NameEn:''; ?>"/>
                            </div>
                          </div>
                        </div>
                      </div>
                      <p class="card-description"> <strong>Set Permission</strong> </p>
                      <div class="row" style="border:dashed 1px #ccc;">
                      
                      	<div class="col-sm-12">&nbsp;</div>
                      
                      
                       
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('user_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="UsersManagement" name="UsersManagement" <?php echo !empty($permission->UsersManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="UsersManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('cards_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="CardsManagement" name="CardsManagement" <?php echo !empty($permission->CardsManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="CardsManagement"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            
							<div class="col-sm-12">&nbsp;</div>      
                                                  
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('copuns_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="CopunsManagement"  name="CopunsManagement" <?php echo !empty($permission->CopunsManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="CopunsManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('providers_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="ProvidersManagement" name="ProvidersManagement" <?php echo !empty($permission->ProvidersManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="ProvidersManagement"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            
								<div class="col-sm-12">&nbsp;</div>                              
                            
                                                        
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('media_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="MediaManagement" name="MediaManagement" <?php echo !empty($permission->MediaManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="MediaManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('offers_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="OffersManagement" name="OffersManagement" <?php echo !empty($permission->OffersManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="OffersManagement"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            
								<div class="col-sm-12">&nbsp;</div>                

                                                        
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('withdraw_requests_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="WithdrawRequestsManagement" name="WithdrawRequestsManagement" <?php echo !empty($permission->WithdrawRequestsManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="WithdrawRequestsManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('offers_requests_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="OffersRequestsManagement" name="OffersRequestsManagement" <?php echo !empty($permission->OffersRequestsManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="OffersRequestsManagement"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            
                            
								<div class="col-sm-12">&nbsp;</div>                
                            
                                                        
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('market_management'); ?> </label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="MarketManagement" name="MarketManagement" <?php echo !empty($permission->MarketManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="MarketManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('notification_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="NotificationManagement" name="NotificationManagement" <?php echo !empty($permission->NotificationManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="NotificationManagement"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            
								<div class="col-sm-12">&nbsp;</div> 
                                
                                
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('admin_management'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="AdminManagement" name="AdminManagement" <?php echo !empty($permission->AdminManagement)?'checked':''; ?>>
                                          <label class="custom-control-label" for="AdminManagement"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('reviewer'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                               			 <input type="text" class="range_01" id="Reviewer" name="Reviewer" value="<?php echo !empty($permission->Reviewer)?$permission->Reviewer:'0'; ?>" />

                                    </div>
                                </div>
                            </div>
                            
                              <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('groups'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="Groups" name="Groups" <?php echo !empty($permission->Groups)?'checked':''; ?>>
                                          <label class="custom-control-label" for="Groups"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                              <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('reviewwf'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="Reviewwf" name="Reviewwf" <?php echo !empty($permission->Reviewwf)?'checked':''; ?>>
                                          <label class="custom-control-label" for="Reviewwf"></label>
                                      </div>
                                    </div>
                                </div>
                    
                            </div>
                            
                            
								<div class="col-sm-12">&nbsp;</div> 
                                                        
                        
                      </div>
                      
                      		<div class="col-sm-12">&nbsp;</div>
                      
                            <div class="col-sm-6 col-xs-6 col-md-6">
                            	<div class="row">
                                    <label class="col-sm-7 col-xs-7 col-md-7 "><?php echo $this->lang->line('is_active'); ?></label>
                                    <div class="col-sm-5 col-xs-5 col-md-5">
                                      <div class="custom-control custom-switch">
                                          <input type="checkbox" class="custom-control-input" id="IsActive" name="IsActive" <?php echo !empty($permission->IsActive)?'checked':''; ?>>
                                          <label class="custom-control-label" for="IsActive"></label>
                                      </div>
                                    </div>
                                </div>
                            </div>                        
                      <div class="col-sm-12">&nbsp;</div>
                      <input type="hidden" id="recid" name="recid"  value="<?php echo !empty($permission->ID)?$permission->ID:'0'; ?>" />
                      <input type="hidden" id="task" name="task" value="<?php echo !empty($permission->ID)?'2':'1'; ?>" />
                      <input class="btn btn-success" id="cmdsubmit" type="submit" value="<?php echo $this->lang->line('submit'); ?>">
                      <input class="btn btn-inverse-dark btn-fw" type="reset" value="<?php echo $this->lang->line('reset'); ?>" >
                      <a  href="<?php echo base_url('permission'); ?>" class="btn btn-inverse-dark btn-fw"> <?php echo $this->lang->line('exit'); ?></a>


                    </form>
                  </div>
                </div>
              </div>
        </div>
      </div>
    </div>
</div>

<!-- content-wrapper ends -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/ion-rangeslider/js/ion.rangeSlider.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js'); ?>"></script>

<script>

    (function($) {
      'use strict';

      if ($('.range_01').length) {
        $(".range_01").ionRangeSlider({
            min: 0,
            max: 5,
        });
      }
    
    })(jQuery);
</script>   

<script>
$(document).ready(function(e) {
    
$.validator.setDefaults({
submitHandler: function() {
    
            var frmAddPermission = $("#frmAddPermission").serialize();
            $.ajax({
                type: "POST",
                dataType: "json", 
                url: "<?php echo base_url(); ?>savepermission",
                data: frmAddPermission,
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
                            window.location.href='<?php echo base_url(); ?>permission';
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
    
     $("#frmAddPermission").validate({
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

</script>




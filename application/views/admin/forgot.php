<!DOCTYPE html>
<html <?php echo ($ln == 'ar')? 'lang="ar" dir="rtl"' : 'lang="en"' ;?>>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $this->lang->line('project_name'); ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/simple-line-icons/css/simple-line-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/css/vendor.bundle.base.css'); ?>">
    
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/demo_1/style.css'); ?>">
    <!-- End layout styles -->
   <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" />
    <style>
    	.txt-rtl{ text-align:right; }
		.langarea a{ 
			 /*-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)"; 
			  filter: alpha(opacity=20); 
			  opacity: 0.2;*/
		}
		
		.langarea a.map-active i{ 
			/* -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; 
			  filter: alpha(opacity=100); 
			  opacity: 1;*/
			  
			  box-shadow: 1px 1px 5px #000;
			  border:1px dashed #fff;

		}
		.lbl-error{
			text-align:right;
			width:100%	
		}
	
		.logo-align-right{ float:right;}

		
	/*.content-wrapper{background-size:cover; background-image:url('assets/images/lights.jpg');}*/	
		
    </style>
    
  </head>
  <body <?php echo ($ln == 'ar')? 'class="rtl"' : '' ;?>>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">              	
               <div class="brand-logo">
                 <img class="<?php echo ($ln == 'ar')? 'logo-align-right' : ''; ?>" src="<?php echo base_url('assets/images/logo.png'); ?>" style="margin-bottom:10px;">
                	
                    <div class="langarea row col-sm-12 <?php echo ($ln == 'ar')?'text-right':'text-left';?>">
                        <a title="Switch to Arabic" class="<?php echo ($ln == 'ar')?'map-active':'';?> " href="<?php echo base_url('switchlanguage/ar') ?>" <?php echo ($ln == 'ar')? 'class="txt-rtl"' : '' ;?>><i class="flag-icon flag-icon-ae"></i></a>
                       	&nbsp;
                        <a title="Switch to English" class="<?php echo ($ln == 'en')?'map-active':'';?>" href="<?php echo base_url('switchlanguage/en') ?>" <?php echo ($ln == 'ar')? 'class="txt-rtl"' : '' ;?>> <i class="flag-icon flag-icon-us"></i></a>
                    </div>                 	
                </div>
                <h1 <?php echo ($ln == 'ar')? 'class="txt-rtl"' : '' ;?>><?php echo $this->lang->line('project_name'); ?></h1>
                <div class="alert alert-success" role="alert" id="reset_msg" style="display:none;"></div>
                <div id="div_forgotpwd">                    
                    <h6 class="font-weight-light <?php echo ($ln == 'ar')? 'txt-rtl' : ''; ?>"><?php echo $this->lang->line('forgot_pwd'); ?></h6>
                    <form class="pt-3 cmxform" id="forgotpwdForm"  method="post">
                      <div class="msg <?php echo ($ln == 'ar')? 'txt-rtl' : ''; ?> text-danger" style="display:none;">&nbsp;</div>
                      <div class="form-group">
                        <input type="email" class="form-control form-control-lg" name="user_email" id="user_email" placeholder="<?php echo $this->lang->line('username'); ?>" required autocomplete="off">
                      </div>
                      <div class="mt-3">
                        <button type="submit" id="reset-pwd"class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><?php echo $this->lang->line('submit'); ?></button>
                      </div>                      
                    </form>                    
				</div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                    <a href="<?php echo base_url('/'); ?>" class="auth-link text-black <?php echo ($ln == 'ar')? 'txt-rtl' : ''; ?>"><?php echo $this->lang->line('goback_login'); ?></a>
                </div>                    
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?php echo base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendors/sweetalert/sweetalert.min.js'); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url('assets/js/off-canvas.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/hoverable-collapse.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/misc.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/settings.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/todolist.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendors/jquery-validation/jquery.validate.min.js') ?>"></script>
<!--    <script src="<?php echo base_url('assets/js/form-validation.js') ?>"></script>
-->   
   <script>
   
   	$(document).ready(function(e) {
		
  $.validator.setDefaults({
    submitHandler: function() {
      	$("#reset_msg").hide();
		var forgotpwdForm = $("#forgotpwdForm").serialize();
		$.ajax({
			type: "POST",
			dataType: "json", 
			url: "<?php echo base_url(); ?>admin/sendForgotPwd",
			data: forgotpwdForm,
			beforeSend: function (xhr) {
		  
			  $("#reset-pwd").text('<?php echo $this->lang->line('loading'); ?>');
			  $("#reset-pwd").prop("disabled",true);
			},
			success: function(res_data) {
				
				if (res_data[0].resSuccess == 1) { 
					if(res_data[0].msg == 'Success'){
						$("#user_email").val('');
						$("#reset-pwd").prop("disabled",false);	
						$("#reset-pwd").text("<?php echo $this->lang->line('submit'); ?>");					
						//swal('Password reset!', 'Reset password has been sent to your email', 'OK');						
						$("#div_forgotpwd").hide();
						$("#reset_msg").show().html('').html('<?php echo $this->lang->line('reset_password_has_been_sent_to_your_email'); ?>');
						/*setTimeout(function(){ 
							window.location.href='< ?php echo base_url(); ?>';
						}, 3000);
*/						
					}
				}else if (res_data[0].resSuccess == 2){
					$("#reset-pwd").prop("disabled",false);
					$("#reset-pwd").text("<?php echo $this->lang->line('submit'); ?>");
					if(res_data[0].errtype == 'Validation'){
						$(".msg").html(res_data[0].arrError);
						$(".msg").fadeIn('fast');
					}					
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
		
		 $("#forgotpwdForm").validate({
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
   
   
/*   	$("#loginForm").validate({
      rules: {
        exampleInputEmail1: {
          required: true,
          email: true
        },
        exampleInputPassword1: {
          required: true,
        },
      messages: {
       
        exampleInputPassword1: {
          required: "Please provide a password",
        },
        exampleInputEmail1: "Please enter a valid email address",
      },
      errorPlacement: function(label, element) {
        label.addClass('mt-2 text-danger');
        label.insertAfter(element);
      },
      highlight: function(element, errorClass) {
        $(element).parent().addClass('has-danger')
        $(element).addClass('form-control-danger')
      }
	  }
	  });
*/	
   </script>
   
   
    <!-- endinject -->
  </body>
</html>
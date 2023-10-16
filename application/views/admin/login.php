<!DOCTYPE html>
<html <?php echo ($ln == 'ar') ? 'lang="ar" dir="rtl"' : 'lang="en"'; ?>>

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
	<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />
	<style>
		.txt-rtl {
			text-align: right;
		}

		.langarea a {
			/*-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=20)"; 
			  filter: alpha(opacity=20); 
			  opacity: 0.2;*/
		}

		.langarea a.map-active i {
			/* -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; 
			  filter: alpha(opacity=100); 
			  opacity: 1;*/

			box-shadow: 1px 1px 5px #000;
			border: 1px dashed #fff;

		}

		.lbl-error {
			text-align: right;
			width: 100%
		}

		.logo-align-right {
			float: right;
		}

		.form-check .form-check-label input[type="checkbox"]+.input-helper:after {
			right: 6px !important
		}

		/* .content-wrapper {
			background-size: cover;
			background-image: url('assets/images/favicon.png');
		} */
	</style>

</head>

<body <?php echo ($ln == 'ar') ? 'class="rtl"' : ''; ?>>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div class="content-wrapper d-flex align-items-center auth">
				<div class="row flex-grow">
					<div class="col-lg-4 mx-auto">
						<div class="auth-form-light text-left p-5">
							<div class="brand-logo">
								<img class="<?php echo ($ln == 'ar') ? 'logo-align-right' : ''; ?>" src="<?php echo base_url('assets/images/logo.png');
																											?>" style="margin-bottom:10px;">

								<div class="langarea row col-sm-12 <?php echo ($ln == 'ar') ? 'text-right' : 'text-left'; ?>">
									<a title="Switch to Arabic" class="<?php echo ($ln == 'ar') ? 'map-active' : ''; ?> " href="<?php echo base_url('switchlanguage/ar') ?>" <?php echo ($ln == 'ar') ? 'class="txt-rtl"' : ''; ?>><i class="flag-icon flag-icon-sa"></i></a>
									&nbsp;
									<a title="Switch to English" class="<?php echo ($ln == 'en') ? 'map-active' : ''; ?>" href="<?php echo base_url('switchlanguage/en') ?>" <?php echo ($ln == 'ar') ? 'class="txt-rtl"' : ''; ?>> <i class="flag-icon flag-icon-us"></i></a>
								</div>

							</div>
							<!--<h1 < ?php echo ($ln == 'ar')? 'class="txt-rtl"' : '' ;?>>< ?php echo $this->lang->line('project_name'); ?></h1>-->
							<!--                <h4 < ?php echo ($ln == 'ar')? 'class="txt-rtl"' : '' ;?>>< ?php echo $this->lang->line('get_started'); ?></h4>
-->
							<h6 class="font-weight-light <?php echo ($ln == 'ar') ? 'txt-rtl' : ''; ?>"><?php echo $this->lang->line('signin_continue'); ?></h6>
							<form class="pt-3 cmxform" id="loginForm" method="post">
								<?php if (!empty($this->session->flashdata('errmsg'))) { ?>
									<div id="flasherr" class="alert alert-danger <?php echo ($ln == 'ar') ? 'txt-rtl' : ''; ?>" role="alert">
										<?php echo $this->session->flashdata('errmsg');  ?>
									</div>
								<?php } ?>


								<div class="msg <?php echo ($ln == 'ar') ? 'txt-rtl' : ''; ?>" style="display:none;">&nbsp;</div>
								<div class="form-group">
									<input type="email" class="form-control form-control-lg" name="user_email" id="user_email" placeholder="<?php echo $this->lang->line('username'); ?>" required autocomplete="off">
								</div>
								<div class="form-group">
									<input type="password" class="form-control form-control-lg" name="user_pwd" id="user_pwd" placeholder="<?php echo $this->lang->line('password'); ?>" required autocomplete="off">
								</div>
								<div class="mt-3">
									<button type="submit" id="sign-in" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"><?php echo $this->lang->line('signin'); ?></button>
								</div>
								<div class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<label class="form-check-label text-muted">
											<!-- <input type="checkbox" id='remember_me' name="remember_me" class="form-check-input"> <?php //echo $this->lang->line('keep_me_signed_in'); 
																																		?> </label> -->
									</div>
									<a href="<?php echo base_url('forgot'); ?>" class="auth-link text-black <?php echo ($ln == 'ar') ? 'txt-rtl' : ''; ?>"><?php //echo $this->lang->line('forgot_password'); 
																																							?></a>
								</div>
							</form>
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
	<script>
		$(document).ready(function(e) {

			<?php if (isset($_COOKIE['ttttt']) && $_COOKIE['ttttt'] == true) { ?>
				var userrandom = parseInt(Math.random() * 1000);
				window.location.href = '<?php echo base_url('rememberme') ?>/' + userrandom;
			<?php } ?>





			$.validator.setDefaults({
				submitHandler: function() {

					var loginForm = $("#loginForm").serialize();
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "<?php echo base_url(); ?>login",
						data: loginForm,
						beforeSend: function(xhr) {

							$("#sign-in").text('<?php echo $this->lang->line('loading'); ?>');
							$("#sign-in").prop("disabled", true);
						},
						success: function(res_data) {

							if (res_data[0].resSuccess == 1) {
								if (res_data[0].msg == 'Success') {
									window.location.href = '<?php echo base_url(); ?>dashboard';
								}
							} else if (res_data[0].resSuccess == 2) {
								$("#sign-in").prop("disabled", false);
								$("#sign-in").text("<?php echo $this->lang->line('signin'); ?>");
								if (res_data[0].errtype == 'Validation') {
									$(".msg").html(res_data[0].arrError);
									$(".msg").fadeIn('fast');
								}
								return false;
							}
						}
					});


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

			$("#loginForm").validate({
				errorPlacement: function(label, element) {
					label.addClass('mt-2 text-danger <?php echo ($ln == 'ar') ? 'lbl-error' : ''; ?>');
					label.insertAfter(element);
				},
				highlight: function(element, errorClass) {
					$(element).parent().addClass('has-danger')
					$(element).addClass('form-control-danger')
				}
			});


			$("#flasherr").fadeTo(2000, 500).slideUp(500, function() {
				$("#flasherr").slideUp(500);
			});

		});
	</script>

	<!-- endinject -->
</body>

</html>
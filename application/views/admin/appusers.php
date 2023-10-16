<style>
.dataTables_length{ display:none;}
<?php if($ln == 'ar'){ ?>
.dataTables_filter{ float:left;} 
#user-listing_paginate { float:left;} 
<?php }else{ ?>
.dataTables_filter { float:right;} 
#user-listing_paginate { float:right;}
.mg-left-10{ margin-left:10px !important; }
.mg-right-10{ margin-right:10px !important; }
.margin-custom{ margin: -25px 240px -31px auto !important;}
<?php } ?>
</style>
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"></h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <!--<li class="breadcrumb-item"><a href="< ?php echo base_url('permission') ?>">< ?php echo $this->lang->line('permissions'); ?></a></li>-->
          <li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('app_users'); ?></li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?php echo $this->lang->line('app_users'); ?>
        	<a  href="<?php echo base_url('addappuser'); ?>" class="<?php echo ($ln == 'en')? 'pull-right mg-left-10':'pull-left mg-right-10'; ?> btn btn-sm btn-success text-white"> <?php echo $this->lang->line('add'); ?> </a>
        	<a data-toggle="modal" data-target="#uploadExcelModal"  href="javascript:void(0);"   class="<?php echo ($ln == 'en')? 'pull-right':'pull-left'; ?> btn btn-sm btn-success text-white" <?php if($ln == 'ar') { echo "style='margin-left:10px;'"; } ?> > <?php echo $this->lang->line('import_app_user'); ?> </a>
        </h4><br/><br/>
                        
   <div class="row">
   
   				<!--<ul>
                	<li>102 Records inserted succeffully</li>
                    <li>102 Records failed to insert</li>
                
                
                </ul>
   -->
   
          <div class="col-12">
            <div class="table-responsive">
            
              <table id="user-listing" class="table table-header-rotated">
                <thead>
                  <tr>
                  	<th><?php echo $this->lang->line('action'); ?></th>
                    <th><?php echo $this->lang->line('first_name'); ?></th>
                    <th><?php echo $this->lang->line('second_name'); ?></th>
                    <th><?php echo $this->lang->line('third_name'); ?></th>
                    <th><?php echo $this->lang->line('last_name'); ?> </th>
                    <th><?php echo $this->lang->line('id_number'); ?></th>
                    <th><?php echo $this->lang->line('email'); ?> </th>
                    <th><?php echo $this->lang->line('mobile'); ?>  </th>
                    <th><?php echo $this->lang->line('age'); ?> </th>
                    <th><?php echo $this->lang->line('sex'); ?> </th>
                  </tr>
                </thead>
                <tbody>
                <?php if(!empty($users)){ foreach($users as $user){ ?>
                
                  <tr   <?php if($user->IsActive == 0){ echo 'bgcolor="#CCCCCC"' . 'Title="' . $this->lang->line('this_user_is_inactive') .'"'; } ?>> 
                    <td>
                  
					<div class="btn-group" role="group" aria-label="Basic example">
                        <button title="<?php echo $this->lang->line('edit_row'); ?>" onclick="editUser(<?php echo $user->ID ?>)" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
<!--                        <button title="< ?php echo $this->lang->line('delete_row'); ?>" onclick="deleteUser(< ?php echo $user->ID ?>)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
-->                        
						<button title="<?php echo $this->lang->line('click_to_view_card'); ?>" onclick="viewCardDetails(<?php echo $user->ID ?>)" type="button" class="btn btn-sm btn-inverse-success"><i class="fa fa-credit-card"></i></button>
                    </div>
					</td>
                    <td><?php echo $user->FirstName; ?></td>
                    <td><?php echo $user->SecondName; ?></td>
                    <td><?php echo $user->ThirdName; ?></td>
                    <td><?php echo $user->LastName; ?></td>
                    <td><?php echo $user->IDNumber; ?></td>
                    <td><?php echo $user->Email; ?></td>
                    <td><?php echo $user->Mobile; ?></td>
                    <td><?php echo $user->Age; ?></td>
                    <td><?php echo ($user->SEX == '1')?'Male':'Female'; ?></td>
                  </tr>
                 <?php }} ?> 

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<!-- content-wrapper ends -->
<div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('user_card_details') ?> </h5>
        <button type="button" style=" <?php echo ($ln == 'ar')?'margin: -25px 240px -31px auto':''; ?>" class="close <?php echo ($ln == 'ar')?'pull-left margin-custom':'pull-right'; ?>" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      </div>
<!--      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
-->   
 </div>
  </div>
</div>


<div class="modal fade" id="uploadExcelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form id="frmExcelUpload" name="frmExcelUpload" action="<?php echo base_url('uploadexcel');?>" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('import_excel'); ?> </h5>
        <button type="button" style=" <?php echo ($ln == 'ar')?'margin: -25px 309px -31px auto':''; ?>" class="close <?php echo ($ln == 'ar')?'pull-left margin-custom':'pull-right'; ?>" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input id="userexcel" name='userexcel' type="file" title="<?php echo $this->lang->line('no_file_chosen'); ?>" class="dropify" data-allowed-file-extensions="xlsx"  onchange="uploadFile(this)"/>
       
        <div class="progress progress-lg mt-2" style="display:block;">
            <div class="progress-bar bg-danger" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">hj</div>
        </div>     	
      </div>
      

<!--      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
-->
 </div>
   </form>
  </div>
</div>

<div class="modal fade" id="uploadExcelModalResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
  <form id="frmExcelUpload" name="frmExcelUpload" action="<?php echo base_url('uploadexcel');?>" method="post" enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('import_excel'); ?> </h5>
        <button type="button" style=" <?php echo ($ln == 'ar')?'margin: -25px 1008px -31px auto':''; ?>" class="close <?php echo ($ln == 'ar')?'pull-left margin-custom':'pull-right'; ?>" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
   	
      </div>

<!--  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
-->
 </div>
   </form>
  </div>
</div>

<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendors/dropify/dropify.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
<!-- <script src="< ?php echo base_url('assets/vendors/sweetalert/sweetalert.min.js') ?>"></script>	-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js?v=2'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/dropify/dropify.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/progressbar.js/progressbar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/progress-bar.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/jquery-fileupload/jquery.form.js'); ?>"></script>

<script>
 (function($) {
      'use strict';
      $(function() {
        $('#user-listing').DataTable({
          "aLengthMenu": [
            [5, 10, 15, -1],
            [5, 10, 15, "All"]
          ],
          "iDisplayLength": 10,
           "ordering": false,
          "language": {
            <?php if($ln == 'ar') {?>  
                "url": "<?php echo base_url('assets/vendors/datatables.net/Arabic.json'); ?>"
            <?php }else{ ?>
                "url": ""
            <?php } ?>
          }
        });
        $('#user-listing').each(function() {
          var datatable = $(this);
          // SEARCH - Add the placeholder for Search and Turn this into in-line form control
          var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
          search_input.attr('placeholder', 'Search');
          search_input.removeClass('form-control-sm');
          // LENGTH - Inline-Form control
          var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
          length_sel.removeClass('form-control-sm');
        });
      });
	  
	  
	  
		$('.dropify').dropify({
			messages: {
				'default': '<?php echo $this->lang->line('drag_and_drop_a_file_here_or_click'); ?>',
				'replace': '<?php echo $this->lang->line('drag_and_drop_or_click_to_replace'); ?>',
				'remove':  '<?php echo $this->lang->line('remove'); ?>',
				'error':   '<?php echo $this->lang->line('something_wrong_happended'); ?>'
			}
		});	
		
		  
  $('#frmExcelUpload').ajaxForm({
		target: '',
		dataType:'json',
		beforeSerialize: function($form, options) {
						
		},
		beforeSubmit: function(){
			$('.progress').show();
			progressbar();
		},
		success: function(res_data){
			
			$("#cmdsubmit").prop("disabled",false);	
			$("#cmdsubmit").text("<?php echo $this->lang->line('submit'); ?>");	
			if(res_data[0].resSuccess == 1){	
								
				showSuccessToast(res_data[0].msg,'<?php echo $this->lang->line('success')  ?>');
				
				$('#uploadExcelModal').modal('hide');
				$('#uploadExcelModalResult').modal('show');
				$('#uploadExcelModalResult .modal-body').html(res_data[0].error_view);
				
				
				setTimeout(function(){ 
					//window.location.href='<?php echo base_url(); ?>category';
				 }, 4000);
			}
			else
			{				
				if(res_data[0].errtype == 'Validation'){					
					showDangerToast(res_data[0].msg,'<?php echo $this->lang->line('danger')  ?>');
					return false;					
				}else{
					showDangerToast(res_data[0].msg,'<?php echo $this->lang->line('danger')  ?>');
					return false;
				}					
			}
	   }	
   });	 
   
   
   	   		// [[ =======  reset the Modal form  ======= ]]
	   $('#cardModal').on('hidden.bs.modal', function () {
			$('#cardModal .modal-body').html(''); 			  
		});
		

   
   		// [[ =======  reset the Modal form  ======= ]]
	   $('#uploadExcelModal').on('hidden.bs.modal', function () {
					resetExcelUpload()				  
		});
		
   		// [[ =======  reset the Modal form  ======= ]]
	   $('#uploadExcelModalResult').on('hidden.bs.modal', function () {
			$('#uploadExcelModalResult .modal-body').html(''); 
			window.location.href='<?php echo base_url(); ?>appusers'; 
		});
		
   
	  
    })(jQuery);
    
    function editUser(id){
        window.location.href='<?php echo base_url('editappuser/') ?>' + id;
    }
       
	   
	function uploadFile(obj){
		$(obj).attr('title','');
		var fileExtension = ['xlsx', 'xls'];
        if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1) { 
            //alert("Only formats are allowed : "+fileExtension.join(', '));
        }else{ 
			$('#frmExcelUpload').submit();
		}
	}
	
	
	function resetExcelUpload(){
		   	$('.dropify-clear').click();
				$(".progress-bar")
					  .css("width", "0%")
					  .attr("aria-valuenow", '0')
					  .text("0% Complete");
					  
				$('.progress-bar').removeClass('bg-success');
				$('.progress-bar').addClass('bg-danger');
				$('.progress').hide();
		
		
	}
	
	
	function progressbar(){
		 var current_progress = 0;
		  var interval = setInterval(function() {
			  current_progress += 10;
			  $(".progress-bar")
			  .css("width", current_progress + "%")
			  .attr("aria-valuenow", current_progress)
			  .text(current_progress + "% Complete");
			  if (current_progress >= 100){ 
					$('.progress-bar').removeClass('bg-danger');
					$('.progress-bar').addClass('bg-success');
				  clearInterval(interval);
			  }
		  }, 100);
	
		
	}
     
     function deleteUser(ID){
         
        swal.fire({
          title: '<?php echo $this->lang->line('are_you_sure'); ?>',
          text: "<?php echo $this->lang->line('you_wont_revert_this'); ?>",
          icon: 'warning',
          showCancelButton: true,
          <?php if($ln == 'ar'){ ?>
              confirmButtonText: 'نعم',
              cancelButtonText: 'لا',
          <?php } ?>
          reverseButtons: true
        }).then((result) => {
          if (result.value) {
              window.location.href='<?php echo base_url('deleteappuser/') ?>' + ID;
              
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            
          }
        })					
                            
    }	
	
	
	
	function viewCardDetails(ID){
		var params = {"ID":ID};
		$('#cardModal').modal('show', {backdrop: 'static'});
		$.get('<?php echo base_url("viewcarddetails"); ?>', params, function (html) {
			$('#cardModal .modal-body').html(html);
			$('#cardModal').modal('show', {backdrop: 'static'});
		});
		
		
	}
	
	
	function showCardNo(cardno){
		$('#shw-tk').hide();
		$('#card-no').html(cardno);
		
	}
     
    <?php if(!empty($this->session->flashdata('erruser'))){  ?>
            showDangerToast('<?php echo $this->session->flashdata('erruser') ?>', '<?php echo $this->lang->line('danger')  ?>');
    <?php  } ?>
     
    <?php if(!empty($this->session->flashdata('successuser'))){ ?>
            showSuccessToast('<?php echo $this->session->flashdata('successuser') ?>', '<?php echo $this->lang->line('success')  ?>');
    <?php  } ?>
</script>
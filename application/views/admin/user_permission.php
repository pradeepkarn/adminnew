<?php //print_r($permissions); die(); ?>
<style>

.table-header-rotated th.row-header{
  width: auto;
}

/*.table-header-rotated td{
  width: 40px;
  border-top: 1px solid #dddddd;
  border-left: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
  vertical-align: middle;
  text-align: center;
}*/

.table-header-rotated th.rotate-45{
  height: 150px;
  width: 40px;
  min-width: 40px;
  max-width: 40px;
  position: relative;
  vertical-align: bottom;
  padding: 0;
  font-size: 12px;
  line-height: 0.8;
}

.table-header-rotated th.rotate-45 > div{
  position: relative;
  top: 0px;
  left: 0px; /* 80 * tan(45) / 2 = 40 where 80 is the height on the cell and 45 is the transform angle*/
  height: 200px;
  -ms-transform:skew(-0deg,0deg);
  -moz-transform:skew(-0deg,0deg);
  -webkit-transform:skew(-0deg,0deg);
  -o-transform:skew(-0deg,0deg);
  transform:skew(-0deg,0deg);
  overflow: hidden;
  border-left: 1px solid #dddddd;
  border-right: 1px solid #dddddd;
  border-top: 1px solid #dddddd;
}

.table-header-rotated th.rotate-45 span {
  -ms-transform:skew(0deg,0deg) rotate(270deg);
  -moz-transform:skew(0deg,0deg) rotate(270deg);
  -webkit-transform:skew(0deg,0deg) rotate(270deg);
  -o-transform:skew(0deg,0deg) rotate(270deg);
  transform:skew(0deg,0deg) rotate(270deg);
  position: absolute;
  <?php if($ln == 'ar'){ ?>
  bottom: 145px; /* 40 cos(45) = 28 with an additional 2px margin*/
 <?php } else{?>
 	bottom: 45px; 
 <?php } ?>
  left: -25px; /*Because it looked good, but there is probably a mathematical link here as well*/
  display: inline-block;
  // width: 100%;
  width: 85px; /* 80 / cos(45) - 40 cos (45) = 85 where 80 is the height of the cell, 40 the width of the cell and 45 the transform angle*/
  text-align: left;
  // white-space: nowrap; /*whether to display in one line or not*/
}

.dataTables_length{ display:none;}
<?php if($ln == 'ar'){ ?>
.dataTables_filter{ float:left;} 
<?php } ?>

</style>
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"></h3>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <!--<li class="breadcrumb-item"><a href="< ?php echo base_url('permission') ?>">< ?php echo $this->lang->line('permissions'); ?></a></li>-->
          <li class="breadcrumb-item active" aria-current="page"><?php echo $this->lang->line('permissions'); ?></li>
        </ol>
      </nav>
    </div>
    <div class="card">
      <div class="card-body">
        <h4 class="card-title"><?php echo $this->lang->line('permissions'); ?>
        	<a  href="<?php echo base_url('addpermission'); ?>" class="<?php echo ($ln == 'en')? 'pull-right':'pull-left'; ?> btn btn-sm btn-success text-white"> <?php echo $this->lang->line('add'); ?></a>
        </h4><br/><br/>
                        
   <div class="row">
          <div class="col-12">
            <div class="table-responsive">
            
              <table id="permission-listing" class="table table-header-rotated">
                <thead>
                  <tr>
                    <th><?php echo $this->lang->line('action'); ?></th>
                    <th><?php echo $this->lang->line('name_arabic'); ?></th>
                    <th><?php echo $this->lang->line('name_english'); ?></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('user_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('cards_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('copuns_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('providers_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('media_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('offers_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('withdraw_requests_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('offers_requests_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('market_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('notification_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('admin_management'); ?></span></div></th>
                    <th class="rotate-45"><div><span><?php echo $this->lang->line('reviewer'); ?></span></div></th>
                     <th class="rotate-45"><div><span><?php echo $this->lang->line('groups'); ?></span></div></th>
                      <th class="rotate-45"><div><span><?php echo $this->lang->line('reviewwf'); ?></span></div></th>
                  </tr>
                </thead>
                <tbody>
                <?php  foreach($permissions as $permission){ ?>
                
                  <tr <?php if($permission->IsActive == 0){ echo 'class="text-muted"' . 'Title="' . $this->lang->line('this_permission_is_inactive') .'"'; } ?>> 
                    <td>
                  
					<div class="btn-group" role="group" aria-label="Basic example">
                        <button title="<?php echo $this->lang->line('edit_row'); ?>" onclick="editPermission(<?php echo $permission->ID ?>)" type="button" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></button>
                        <button title="<?php echo $this->lang->line('delete_row'); ?>" onclick="deletePermission(<?php echo $permission->ID ?>)" type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash-o"></i></button>
                    </div>
					</td>
                    <td><?php echo $permission->NameAr; ?></td>
                    <td><?php echo $permission->NameEn; ?></td>
                    <td><?php echo ($permission->UsersManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->CardsManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->CopunsManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->ProvidersManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->MediaManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->OffersManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->WithdrawRequestsManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->OffersRequestsManagement== 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->MarketManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->NotificationManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->AdminManagement == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                    <td><?php echo ($permission->Reviewer == 0)?"<i class='text-danger fa fa-times'></i>":$permission->Reviewer; ?></td>
                     <td><?php echo ($permission->Groups == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                      <td><?php echo ($permission->Reviewwf == 1)?"<i class='text-success fa fa-check'></i>":"<i class='text-danger fa fa-times'></i>"; ?></td>
                  </tr>
                 <?php } ?> 

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

<!-- content-wrapper ends -->
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
<!-- <script src="< ?php echo base_url('assets/vendors/sweetalert/sweetalert.min.js') ?>"></script>	-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js?v=2'); ?>"></script>

<script>
 (function($) {
      'use strict';
      $(function() {
        $('#permission-listing').DataTable({
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
        $('#permission-listing').each(function() {
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
    })(jQuery);
    
    function editPermission(id){
        window.location.href='<?php echo base_url('editpermission/') ?>' + id;
    }
        
     
     function deletePermission(ID){
         
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
              window.location.href='<?php echo base_url('deletepermission/') ?>' + ID;
              
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            
          }
        })					
                            
    }	
     
	<?php if(!empty($this->session->flashdata('errpermission'))){  ?>
			showDangerToast('<?php echo $this->session->flashdata('errpermission') ?>', '<?php echo $this->lang->line('danger')  ?>');
	<?php  } ?>
	 
	<?php if(!empty($this->session->flashdata('successpermission'))){ ?>
			showSuccessToast('<?php echo $this->session->flashdata('successpermission') ?>', '<?php echo $this->lang->line('success')  ?>');
	<?php  } ?>
             
    
</script>
            
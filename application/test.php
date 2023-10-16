<?php ?>      

 <div class="card">
                      <div class="card-body">
                        <div class="form-group">
                            <label for="lblLatitude"><?php echo 'TEST'; ?></label>                    
                            <input type="text" id="Latitude" name="Latitude" maxlength="100" class="form-control only-float" autocomplete="off" value="<?php echo !empty($providerloc->Latitude)?$providerloc->Latitude:''; ?>" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="lblLongitude"></label>                    
                            <input type="text" id="Longitude" name="Longitude" maxlength="100" class="form-control only-float" autocomplete="off" value="<?php echo !empty($providerloc->Longitude)?$providerloc->Longitude:''; ?>" required="required"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="lblOpenFrom"></label>                    
                            <div class="form-group date" id="OpenFrom" data-target-input="nearest">
                              <div class="form-group" data-target="#OpenFrom">                                
                                <input type="text" id="OpenFrom" name="OpenFrom" maxlength="10" class="form-control datetimepicker-input" data-target="#OpenFrom" autocomplete="off" value="<?php echo !empty($providerloc->OpenFrom)? $providerloc->OpenFrom : ''; ?>" required="required" />
                              	<!--<div class="input-group-addon input-group-append"><i class="icon-clock input-group-text"></i></div>-->
                           	  </div>
                        	</div>
                        </div>
                        <div class="form-group">
                            <label for="lblOpenTo"><?php echo 'TEST@'; ?></label>
                            <div class="form-group date" id="OpenFrom" data-target-input="nearest">
                              <div class="form-group" data-target="#OpenTo">
                              	<input type="text" id="OpenTo" name="OpenTo" maxlength="10" class="form-control datetimepicker-input" data-target="#OpenTo" autocomplete="off" value="<?php echo !empty($providerloc->OpenTo)? $providerloc->OpenTo : ''; ?>" required="required" />                                                                
                              <!--<div class="input-group-addon input-group-append"><i class="icon-clock input-group-text"></i></div>-->
                            </div>                                               
                        </div>                              
                    </div>
                   </div>
                </div>


                      
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/inputmask.js'); ?>"></script>

<?php ?>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<div id="map"></div>

 <div class="card">
                      <div class="card-body">
                        <div class="form-group">
                            <label for="lblLatitude"><?php echo 'Latitude'; ?></label>
                            <input type="text" id="Latitude" name="Latitude" maxlength="100" class="form-control only-float" autocomplete="off" value="<?php echo !empty($providerloc->Latitude)?$providerloc->Latitude:''; ?>" required="required"/>
                        </div>
                        <div class="form-group">
                            <label for="lblLongitude">Longitude</label>
                            <input type="text" id="Longitude" name="Longitude" maxlength="100" class="form-control only-float" autocomplete="off" value="<?php echo !empty($providerloc->Longitude)?$providerloc->Longitude:''; ?>" required="required"/>
                        </div>
                        

                   </div>
                </div>

<script type="application/javascript">
    window.onload = function() {
        var latlng = new google.maps.LatLng(24.737036, 46.686215);
        var map = new google.maps.Map(document.getElementById('map'), {
            center: latlng,
            zoom: 11,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: 'Set lat/lon values for this property',
            draggable: true
        });
        google.maps.event.addListener(marker, 'dragend', function(a) {
            console.log(a);
            var div = document.createElement('div');
            div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
            document.getElementById("Longitude").value = a.latLng.lng();
            document.getElementById("Latitude").value = a.latLng.lat();
            document.getElementsByTagName('body')[0].appendChild(div);
        });
    };
</script>
<style>
#map {
height: 300px;
border: 1px solid #000;
}
</style>
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css'); ?>">
<script src="<?php echo base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/toastDemo.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js'); ?>"></script>
<script src="<?php echo base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/inputmask.js'); ?>"></script>

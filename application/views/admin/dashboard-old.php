<?php
$curr_month = date('m');
$months = array(
  '01' => $this->lang->line('january'), '02' => $this->lang->line('february'), '03' => $this->lang->line('march'),
  '04' => $this->lang->line('april'), '05' => $this->lang->line('may'), '06' => $this->lang->line('june'),
  '07' => $this->lang->line('july'), '08' => $this->lang->line('august'), '09' => $this->lang->line('september'),
  '10' => $this->lang->line('october'), '11' => $this->lang->line('november'), '12' => $this->lang->line('december')
);
?>

<style>
  .chart-legend li span {
    display: inline-block;
    width: 12px;
    height: 12px;
    margin-right: 5px;
  }

  .chart-legend {
    height: 250px;
    overflow: auto;
  }
</style>

<div class="content-wrapper">


  <div class="row">

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="aligner-wrapper py-3">
            <p id="rentPara"></p>
            <canvas id="num-rent" height="210"></canvas>

          </div>
          <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
            <div class="d-flex">
              <span class="square-indicator bg-danger ml-2"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('TOTAL_RENT');
                                    ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator bg-warning ml-2"></span>
              <p class="mb-0 ml-2"><?php echo $this->lang->line('TOTAL_COLLECTION');
                                    ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="aligner-wrapper py-3">
            <p id="ownersDuesPara"></p>
            <canvas id="num-ownersDues" height="210"></canvas>
          </div>
          <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#97cbff;"></span>
              <p class="mb-0 ml-2"><?php echo $this->lang->line('PAID_OWNERS_DUE');
                                    ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#123456;"></span>
              <p class="mb-0 ml-2"><?php echo $this->lang->line('UNPAID_OWNERS_DUE');
                                    ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="aligner-wrapper py-3">
            <p id="incomePara"></p>
            <canvas id="num-Income" height="210"></canvas>
          </div>
          <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#f0d887"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('MANAGEMENT_FEES');
                                    ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#789de7"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('AGENCY_FEE');
                                    ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="aligner-wrapper py-3">
            <p id="unitsPara"></p>
            <canvas id="num-units" height="210"></canvas>
          </div>
          <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#946456"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('VACANT_UNITS'); ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#567345"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('OCCUPIED_UNITS');
                                    ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="aligner-wrapper py-3">
            <p id="statusPara"></p>
            <canvas id="num-status" height="210"></canvas>
          </div>
          <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#dda792"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('ACTIVE'); ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#929edd"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('INACTIVE');
                                    ?></p>
            </div>
            <div class="d-flex">
              <span class="square-indicator ml-2" style="background-color:#949523"></span>
              <p class="mb-0 ml-2"><?php echo  $this->lang->line('SUSPENDED');
                                    ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>



  </div>
</div>
</div>
</div>
<!-- content-wrapper ends -->
<script src="<?php echo base_url('assets'); ?>/vendors/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/jvectormap/jquery-jvectormap.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/daterangepicker/daterangepicker.js"></script>
<script src="<?php echo base_url('assets'); ?>/vendors/chartist/chartist.min.js"></script>

<!-- End plugin js for this page -->
<!-- inject:js -->
<!-- endinject -->
<!-- Custom js for this page -->
<?php //if ($this->session->userdata('sess_user_permission_id') == 1) { 
?>
<script>
  var jsn_wdrequests = null;


  var fn1 = null;
  var fn2 = null;
  var fn3 = null;
  var fn4 = null;
  var fn5 = null;
  var fn6 = null;

  $(document).ready(function(e) {

    $.when(fn1).then(function(a1) {
      displayRentGraph();
      $.when(fn2).then(function(a2) {
        displayOwnersDuesGraph();
        $.when(fn3).then(function(a3) {
          displayIncomeGraph();
          $.when(fn4).then(function(a4) {
            displayUnitsGraph();
            $.when(fn5).then(function(a4) {
              displayStatusGraph();
            });
          });
        });
      });
    });


    function getRentGraph() {

      var doughnutChartCanvas = $("#num-rent").get(0).getContext("2d");
      var doughnutPieData = {
        labels: jsn_wdrequests.stat,
        datasets: [{
          data: jsn_wdrequests.cnt,
          backgroundColor: jsn_wdrequests.bgcolor,
          borderColor: jsn_wdrequests.bgcolor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        //labels: jsn_wdrequests.stat,



      };
      var doughnutPieOptions = {
        cutoutPercentage: 0,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legend: {
          display: false,
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        },

      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions,


      });
      var s = "<?php echo  $this->lang->line('RENT_AMOUNT');  ?>";
      var totalRent = "<?php echo  $this->lang->line('TOTAL_RENT');  ?>";
      var totalCollection = "<?php echo  $this->lang->line('TOTAL_COLLECTION');  ?>";
      var sar = "<?php echo   $this->lang->line('SAR') . "  ";  ?>";
      $("#rentPara").html("<h2>" + s + "</h2><hr><table width='100%'><tr><td width='40%'><h4> " + totalRent + " </h4></td><td style='width:60%;text-align:right;' >   <b>  " + sar + jsn_wdrequests.cnt[1] + "</b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + totalCollection + " </h4></td><td style='width:60%;text-align:right;'><b> " + sar + jsn_wdrequests.cnt[0] + "</b></td></tr></table>");
    }

    function displayRentGraph() {

      fn3 = $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url('admin/rentrequest/'); ?>",
          data: {
            task: 2
          },
          beforeSend: function(xhr) {
            //
          }
        }).done(function(res_data) {

          if (res_data[0].resSuccess == 1) {
            jsn_wdrequests = res_data[0].wdrequest;
            console.log(jsn_wdrequests)
            getRentGraph();

          } else if (res_data[0].resSuccess == 2) {

          }
        })
        .fail(function() {

        });
    }

    function displayOwnersDuesGraph() {

      fn3 = $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url('admin/ownersDuesrequest/'); ?>",
          data: {
            task: 2
          },
          beforeSend: function(xhr) {
            //
          }
        }).done(function(res_data) {

          if (res_data[0].resSuccess == 1) {
            jsn_wdrequests = res_data[0].wdrequest;

            getOwnersDuesGraph();

          } else if (res_data[0].resSuccess == 2) {

          }
        })
        .fail(function() {

        });
    }

    function getOwnersDuesGraph() {

      var doughnutChartCanvas = $("#num-ownersDues").get(0).getContext("2d");
      var doughnutPieData = {
        datasets: [{
          data: jsn_wdrequests.cnt,
          backgroundColor: jsn_wdrequests.bgcolor,
          borderColor: jsn_wdrequests.bgcolor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: jsn_wdrequests.stat,


      };
      var doughnutPieOptions = {
        cutoutPercentage: 0,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legend: {
          display: false,
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        }
      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
      var s = "<?php echo  $this->lang->line('OWNER_DUES');  ?>";
      var paidownersDue = "<?php echo  $this->lang->line('PAID_OWNERS_DUE');  ?>";
      var unpaidownersDue = "<?php echo  $this->lang->line('UNPAID_OWNERS_DUE');  ?>";
      var sar = "<?php echo   $this->lang->line('SAR') . "  ";  ?>";
      $("#ownersDuesPara").html("<h2>" + s + "</h2><hr><table width='100%'><tr><td width='40%'><h4> " + paidownersDue + " </h4></td><td style='width:60%;text-align:right;' >   <b>  " + sar + jsn_wdrequests.cnt[1] + "</b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + unpaidownersDue + " </h4></td><td style='width:60%;text-align:right;'><b> " + sar + jsn_wdrequests.cnt[0] + "</b></td></tr></table>");

    }

    function getIncomeGraph() {

      var doughnutChartCanvas = $("#num-Income").get(0).getContext("2d");
      var doughnutPieData = {
        datasets: [{
          data: jsn_wdrequests.cnt,
          backgroundColor: jsn_wdrequests.bgcolor,
          borderColor: jsn_wdrequests.bgcolor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: jsn_wdrequests.stat,


      };
      var doughnutPieOptions = {
        cutoutPercentage: 0,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legend: {
          display: false,
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        }
      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
      var s = "<?php echo  $this->lang->line('INCOME');  ?>";
      var managementFee = "<?php echo  $this->lang->line('MANAGEMENT_FEES');  ?>";
      var agencyFee = "<?php echo  $this->lang->line('AGENCY_FEE');  ?>";
      var sar = "<?php echo   $this->lang->line('SAR') . "  ";  ?>";
      $("#incomePara").html("<h2>" + s + "</h2><hr><table width='100%'><tr><td width='40%'><h4> " + managementFee + " </h4></td><td style='width:60%;text-align:right;' > <b>  " + sar + jsn_wdrequests.cnt[1] + "</b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + agencyFee + " </h4></td><td style='width:60%;text-align:right;'><b> " + sar + jsn_wdrequests.cnt[0] + "</b></td></tr></table>");

    }

    function displayIncomeGraph() {

      fn3 = $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url('admin/incomerequest/'); ?>",
          data: {
            task: 2
          },
          beforeSend: function(xhr) {
            //
          }
        }).done(function(res_data) {

          if (res_data[0].resSuccess == 1) {
            jsn_wdrequests = res_data[0].wdrequest;

            getIncomeGraph();

          } else if (res_data[0].resSuccess == 2) {

          }
        })
        .fail(function() {

        });
    }





    function getUnitsGraph() {

      var doughnutChartCanvas = $("#num-units").get(0).getContext("2d");
      var doughnutPieData = {
        datasets: [{
          data: jsn_wdrequests.cnt,
          backgroundColor: jsn_wdrequests.bgcolor,
          borderColor: jsn_wdrequests.bgcolor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: jsn_wdrequests.stat,


      };
      var doughnutPieOptions = {
        cutoutPercentage: 0,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legend: {
          display: false,
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        }
      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
      var s = "<?php echo  $this->lang->line('UNITS');  ?>";
      var vacantUnits = "<?php echo  $this->lang->line('VACANT_UNITS');
                          ?>";
      var occupiedUnits = "<?php echo $this->lang->line('OCCUPIED_UNITS');
                            ?>";
      var sar = "<?php echo   $this->lang->line('SAR') . "  ";  ?>";
      $("#unitsPara").html("<h2>" + s + "</h2><hr><table width='100%'><tr><td width='40%'><h4> " + vacantUnits + " </h4></td><td style='width:60%;text-align:right;' > <b>  " + jsn_wdrequests.cnt[1] + "</b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + occupiedUnits + " </h4></td><td style='width:60%;text-align:right;'><b> " + jsn_wdrequests.cnt[0] + "</b></td></tr></table>");

    }

    function displayUnitsGraph() {

      fn4 = $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url('admin/unitsrequest/'); ?>",
          data: {
            task: 2
          },
          beforeSend: function(xhr) {
            //
          }
        }).done(function(res_data) {

          if (res_data[0].resSuccess == 1) {
            jsn_wdrequests = res_data[0].wdrequest;

            getUnitsGraph();

          } else if (res_data[0].resSuccess == 2) {

          }
        })
        .fail(function() {

        });
    }


    //--------------------Contract Status

    function getStatusGraph() {

      var doughnutChartCanvas = $("#num-status").get(0).getContext("2d");
      var doughnutPieData = {
        datasets: [{
          data: jsn_wdrequests.cnt,
          backgroundColor: jsn_wdrequests.bgcolor,
          borderColor: jsn_wdrequests.bgcolor,
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: jsn_wdrequests.stat,


      };
      var doughnutPieOptions = {
        cutoutPercentage: 0,
        animationEasing: "easeOutBounce",
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: true,
        showScale: true,
        legend: {
          display: false,
        },

        layout: {
          padding: {
            left: 0,
            right: 0,
            top: 0,
            bottom: 0
          }
        }
      };
      var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
      });
      var s = "<?php echo  $this->lang->line('CONTRACT_STATUS');  ?>";
      var active = "<?php echo  $this->lang->line('ACTIVE'); ?>";
      var inactive = "<?php echo $this->lang->line('INACTIVE'); ?>";
      var suspended = "<?php echo $this->lang->line('SUSPENDED');  ?>";
      $("#statusPara").html("<h2>" + s + "</h2><hr><table width='100%'><tr><td width='40%'><h4> " + active + " </h4></td><td style='width:60%;text-align:right;' > <b>  " + jsn_wdrequests.cnt[0] + "</b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + inactive + " </h4></td><td style='width:60%;text-align:right;'><b> " + jsn_wdrequests.cnt[1] + "</b></td> </b></td></tr><tr><td colspan='2'><hr></td></tr><tr><td><h4>" + suspended + " </h4></td><td style='width:60%;text-align:right;'><b> " + jsn_wdrequests.cnt[2] + "</b></td></tr></table>");

    }

    function displayStatusGraph() {

      fn5 = $.ajax({
          type: "POST",
          dataType: "json",
          url: "<?php echo base_url('admin/contractStatus/'); ?>",
          data: {
            task: 3
          },
          beforeSend: function(xhr) {
            //
          }
        }).done(function(res_data) {

          if (res_data[0].resSuccess == 1) {
            jsn_wdrequests = res_data[0].wdrequest;

            getStatusGraph();

          } else if (res_data[0].resSuccess == 2) {

          }
        })
        .fail(function() {

        });
    }

  });
</script>
 <!-- Page wrapper  -->
 <!-- ============================================================== -->
 <div class="page-wrapper" style="min-height: 100vh;">
 <?php 
 $sess = (object)($this->session->userdata);
 if ($sess->ag_view_stats == 1) : ?>
   <!-- ============================================================== -->
   <!-- Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <div class="page-breadcrumb">
     <div class="row">
       <div class="col-7 align-self-center">
         <h3 class="page-title text-truncate text-dark text-start font-weight-medium mb-1">
           <?php echo $this->lang->line('WELCOME'); ?>
         </h3>
         <div class="d-flex align-items-center">
           <nav aria-label="breadcrumb">
             <ol class="breadcrumb m-0 p-0">
               <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>"><?php echo $this->lang->line('DASHBOARD'); ?></a>
               </li>
             </ol>
           </nav>
         </div>
       </div>
       <div class="col-5 align-self-center">
         <div class="customize-input float-<?php echo rtl ? 'left' : 'right'; ?>">
           <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
             <option selected>Aug 19</option>
             <option value="1">July 19</option>
             <option value="2">Jun 19</option>
           </select>
         </div>
       </div>
     </div>
   </div>
   <!-- ============================================================== -->
   <!-- End Bread crumb and right sidebar toggle -->
   <!-- ============================================================== -->
   <!-- ============================================================== -->
   <!-- Container fluid  -->
   <!-- ============================================================== -->
   <div class="container-fluid">
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
     <script>
       // Load the Google Charts library
       google.charts.load('current', {
         'packages': ['corechart']
       });
     </script>

     <!-- *************************************************************** -->
     <!-- Start First Cards -->
     <!-- *************************************************************** -->
     <!-- <div class="card-group">
       <div class="card border-right">
         <div class="card-body">
           <div class="d-flex d-lg-flex d-md-block align-items-center">
             <div>
               <div class="d-inline-flex align-items-center">
                 <h2 class="text-dark mb-1 font-weight-medium">236</h2>
                 <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+18.33%</span>
               </div>
               <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Clients</h6>
             </div>
             <div class="ml-auto mt-md-3 mt-lg-0">
               <img src="assets/images/icons/contract.png" width="40px" alt="">
             </div>
           </div>
         </div>
       </div>
       <div class="card border-right">
         <div class="card-body">
           <div class="d-flex d-lg-flex d-md-block align-items-center">
             <div>
               <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup class="set-doller">$</sup>18,306</h2>
               <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Earnings of Month
               </h6>
             </div>
             <div class="ml-auto mt-md-3 mt-lg-0">
               <span class="opacity-7 text-muted"><img src="assets/images/icons/partnership.png" width="40px" alt=""></span>
             </div>
           </div>
         </div>
       </div>
       <div class="card border-right">
         <div class="card-body">
           <div class="d-flex d-lg-flex d-md-block align-items-center">
             <div>
               <div class="d-inline-flex align-items-center">
                 <h2 class="text-dark mb-1 font-weight-medium">1538</h2>
                 <span class="badge bg-danger font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">-18.33%</span>
               </div>
               <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">New Projects</h6>
             </div>
             <div class="ml-auto mt-md-3 mt-lg-0">
               <span class="opacity-7 text-muted"><img src="assets/images/icons/real-estate-agent.png" width="40px" alt=""></span>
             </div>
           </div>
         </div>
       </div>
       <div class="card">
         <div class="card-body">
           <div class="d-flex d-lg-flex d-md-block align-items-center">
             <div>
               <h2 class="text-dark mb-1 font-weight-medium">864</h2>
               <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Projects</h6>
             </div>
             <div class="ml-auto mt-md-3 mt-lg-0">
               <span class="opacity-7 text-muted"><img src="assets/images/icons/teamwork.png" alt="" width="40px"></span>
             </div>
           </div>
         </div>
       </div>
     </div> -->
     <!-- *************************************************************** -->
     <!-- End First Cards -->
     <!-- *************************************************************** -->
     <!-- *************************************************************** -->
     <!-- Start Sales Charts Section -->
     <!-- *************************************************************** -->
     <div class="row">
       <div class="col-md-6 my-3">
         <div class="card h-100">
           <div class="card-body">
             <h4 class="card-title">
               <?php echo  $this->lang->line('RENT_AMOUNT');
                ?>
             </h4>

             <div id="donutchart" style="width: 100%; min-height: 70vh;"></div>
             <script>
               async function displayRentGraph() {
                 try {
                   const res_data = await $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "<?php echo base_url('admin/rentrequest/'); ?>",
                     data: {
                       task: 2
                     }
                   });

                   if (res_data[0].resSuccess == 1) {
                     const graphData = res_data[0].wdrequest;
                     drawChart({
                       graphData: graphData,
                       title: "<?php echo  $this->lang->line('RENT_AMOUNT'); ?>",
                       chartId: "donutchart"
                     });
                   } else if (res_data[0].resSuccess == 2) {
                     // Handle resSuccess === 2 scenario
                   }
                 } catch (error) {
                   console.error(error);
                 }
               }



               // Set the callback to display the chart after the library is loaded
               google.charts.setOnLoadCallback(displayRentGraph);
             </script>

           </div>
         </div>
       </div>
       <div class="col-md-6 my-3">
         <div class="card h-100">
           <div class="card-body">
             <h4 class="card-title"><?php echo $this->lang->line('OWNER_DUES'); ?></h4>

             <div id="ownserDuechart" style="width: 100%; min-height: 70vh;"></div>
             <script>
               async function displayOwnersDuesGraph() {
                 try {
                   const res_data = await $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "<?php echo base_url('admin/ownersDuesrequest/'); ?>",
                     data: {
                       task: 2
                     }
                   });

                   if (res_data[0].resSuccess == 1) {
                     const graphData = res_data[0].wdrequest;
                     drawChart({
                       graphData: graphData,
                       title: "<?php echo $this->lang->line('OWNERS_DUE'); ?>",
                       chartId: "ownserDuechart"
                     });
                   } else if (res_data[0].resSuccess == 2) {
                     // Handle resSuccess === 2 scenario
                   }
                 } catch (error) {
                   console.error(error);
                 }
               }



               // Set the callback to display the chart after the library is loaded
               google.charts.setOnLoadCallback(displayOwnersDuesGraph);
             </script>

           </div>
         </div>
       </div>
       <div class="col-md-6 my-3">
         <div class="card h-100">
           <div class="card-body">
             <h4 class="card-title"><?php echo $this->lang->line('INCOME'); ?></h4>

             <div id="incomechart" style="width: 100%; min-height: 70vh;"></div>
             <script>
               async function displayIncomeGraph() {
                 try {
                   const res_data = await $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "<?php echo base_url('admin/incomerequest/'); ?>",
                     data: {
                       task: 2
                     }
                   });

                   if (res_data[0].resSuccess == 1) {
                     const graphData = res_data[0].wdrequest;
                     drawChart({
                       graphData: graphData,
                       title: "<?php echo $this->lang->line('INCOME'); ?>",
                       chartId: "incomechart"
                     });
                   } else if (res_data[0].resSuccess == 2) {
                     // Handle resSuccess === 2 scenario
                   }
                 } catch (error) {
                   console.error(error);
                 }
               }



               // Set the callback to display the chart after the library is loaded
               google.charts.setOnLoadCallback(displayIncomeGraph);
             </script>

           </div>
         </div>
       </div>
       <div class="col-md-6 my-3">
         <div class="card h-100">
           <div class="card-body">
             <h4 class="card-title"><?php echo $this->lang->line('UNITS'); ?></h4>

             <div id="unitschart" style="width: 100%; min-height: 70vh;"></div>
             <script>
               async function displayUnitsGraph() {
                 try {
                   const res_data = await $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "<?php echo base_url('admin/unitsrequest/'); ?>",
                     data: {
                       task: 2
                     }
                   });

                   if (res_data[0].resSuccess == 1) {
                     const graphData = res_data[0].wdrequest;
                     drawChart({
                       graphData: graphData,
                       title: "<?php echo $this->lang->line('UNITS'); ?>",
                       chartId: "unitschart"
                     });
                   } else if (res_data[0].resSuccess == 2) {
                     // Handle resSuccess === 2 scenario
                   }
                 } catch (error) {
                   console.error(error);
                 }
               }



               // Set the callback to display the chart after the library is loaded
               google.charts.setOnLoadCallback(displayUnitsGraph);
             </script>

           </div>
         </div>
       </div>
       <div class="col-md-6 my-3">
         <div class="card h-100">
           <div class="card-body">
             <h4 class="card-title"><?php echo $this->lang->line('CONTRACT_STATUS'); ?></h4>

             <div id="contarctStatuschart" style="width: 100%; min-height: 70vh;"></div>
             <script>
               async function displayContractStatusGraph() {
                 try {
                   const res_data = await $.ajax({
                     type: "POST",
                     dataType: "json",
                     url: "<?php echo base_url('admin/contractStatus/'); ?>",
                     data: {
                       task: 2
                     }
                   });

                   if (res_data[0].resSuccess == 1) {
                     const graphData = res_data[0].wdrequest;
                     drawChart({
                       graphData: graphData,
                       title: "<?php echo $this->lang->line('CONTRACT_STATUS'); ?>",
                       chartId: "contarctStatuschart"
                     });
                   } else if (res_data[0].resSuccess == 2) {
                     // Handle resSuccess === 2 scenario
                   }
                 } catch (error) {
                   console.error(error);
                 }
               }



               // Set the callback to display the chart after the library is loaded
               google.charts.setOnLoadCallback(displayContractStatusGraph);
             </script>


           </div>
         </div>
       </div>
     </div>
   </div>
   <?php endif; ?>
 </div>

 <script>
   function drawChart(sd) {
     var chartData = sd.graphData;

     var rows = chartData.stat.length;

     var data = new google.visualization.DataTable();
     data.addColumn('string', 'Task');
     data.addColumn('number', 'Count');

     for (var i = 0; i < rows; i++) {
       data.addRow([chartData.stat[i], parseFloat(chartData.cnt[i])]);
     }

     var options = {
       title: sd.title,
       pieHole: 0.4, // Adjust the pieHole value to control the hole size
     };

     var chart = new google.visualization.PieChart(document.getElementById(sd.chartId));
     chart.draw(data, options);
   }
 </script>
 <!-- content-wrapper ends -->

 <!-- End plugin js for this page -->
 <!-- inject:js -->
 <!-- endinject -->
 <!-- Custom js for this page -->
 <?php //if ($this->session->userdata('sess_user_permission_id') == 1) { 
  ?>

 <!-- ============================================================== -->
 <!-- End Container fluid  -->
 <!-- ============================================================== -->
 <!-- ============================================================== -->
 <!-- footer -->
 <!-- ============================================================== -->
 <footer class="footer text-center text-muted">
   All Rights Reserved by Web Art vision. Designed and Developed by <a href="https://webartvision.com">Web Art Vision</a>.
 </footer>
 <!-- ============================================================== -->
 <!-- End footer -->
 <!-- ============================================================== -->
 </div>
 <!-- ============================================================== -->
 <!-- End Page wrapper  -->
 <!-- ============================================================== -->
 </div>
 <!-- ============================================================== -->
 <!-- End Wrapper -->
 <!-- ============================================================== -->
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
             <select id="yearFilter" class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
               <option value="2023" <?php if (isset($_GET['year']) && $_GET['year'] == '2023') echo 'selected'; ?>>2023</option>
               <option value="2022" <?php if (isset($_GET['year']) && $_GET['year'] == '2022') echo 'selected'; ?>>2022</option>
               <option value="2021" <?php if (isset($_GET['year']) && $_GET['year'] == '2021') echo 'selected'; ?>>2021</option>
               <option value="2020" <?php if (isset($_GET['year']) && $_GET['year'] == '2020') echo 'selected'; ?>>2020</option>
               <option value="2019" <?php if (isset($_GET['year']) && $_GET['year'] == '2019') echo 'selected'; ?>>2019</option>
               <option value="2018" <?php if (isset($_GET['year']) && $_GET['year'] == '2018') echo 'selected'; ?>>2018</option>
             </select>
           </div>

           <script>
             // Get a reference to the select element for year filter
             const yearFilterSelect = document.getElementById("yearFilter");

             // Add an event listener to detect changes
             yearFilterSelect.addEventListener("change", function() {
               // Get the selected year value
               const selectedYear = yearFilterSelect.value;

               // Construct the new URL with the year filter parameter
               const currentUrl = window.location.href;
               const baseUrl = currentUrl.split('?')[0]; // Get the base URL without query parameters

               // Check if the selected year is not empty
               if (selectedYear !== "") {
                 const newUrl = `${baseUrl}?year=${selectedYear}`;
                 // Redirect to the new URL
                 window.location.href = newUrl;
               } else {
                 // If the selected year is empty, remove the year filter parameter from the URL
                 window.location.href = baseUrl;
               }
             });
           </script>

         </div>
       </div>
       <div class="row">
         <div class="col-md-3 ms-auto my-3">
           <select id="filter" name="filter" class="form-select">
             <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '') {
                        echo "selected";
                      } ?> value=""><?php echo $this->lang->line('ALL'); ?></option>
             <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '1') {
                        echo "selected";
                      } ?> value="1"><?php echo $this->lang->line('ACTIVE'); ?></option>
             <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '0') {
                        echo "selected";
                      } ?> value="0"><?php echo $this->lang->line('INACTIVE'); ?></option>
             <option <?php if (isset($_GET['filter']) && $_GET['filter'] == '2') {
                        echo "selected";
                      } ?> value="2"><?php echo $this->lang->line('SUSPENDED'); ?></option>
           </select>
           <script>
             // Get a reference to the select element
             const filterSelect = document.getElementById("filter");

             // Add an event listener to detect changes
             filterSelect.addEventListener("change", function() {
               // Get the selected value
               const selectedValue = filterSelect.value;

               // Construct the new URL with the filter parameter
               const currentUrl = window.location.href;
               const baseUrl = currentUrl.split('?')[0]; // Get the base URL without query parameters

               // Check if the selected value is not empty
               if (selectedValue !== "") {
                 const newUrl = `${baseUrl}?filter=${selectedValue}`;
                 // Redirect to the new URL
                 window.location.href = newUrl;
               } else {
                 // If the selected value is empty, remove the filter parameter from the URL
                 window.location.href = baseUrl;
               }
             });
           </script>
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


               <canvas id="donutchart" style="width:100%;max-width:600px"></canvas>
               <script>
                 async function displayRentGraph() {
                   try {
                     const res_data = await $.ajax({
                       type: "POST",
                       dataType: "json",
                       url: "<?php echo base_url('admin/rentrequest'); ?><?php echo isset($_GET['filter']) ? "?filter=" . strval($_GET['filter']) : null; ?>",
                       data: {
                         task: 2
                       }
                     });

                     if (res_data[0].resSuccess == 1) {
                       const graphData = res_data[0].wdrequest;
                       drawChartJs({
                         type: "pie",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
                         title: "<?php echo $this->lang->line('OWNERS_DUE'); ?>",
                         chartId: "donutchart"
                       });
                     } else if (res_data[0].resSuccess == 2) {
                       // Handle resSuccess === 2 scenario
                     }
                   } catch (error) {
                     console.error(error);
                   }
                 }

                 displayRentGraph();
               </script>

             </div>
           </div>
         </div>
         <div class="col-md-6 my-3">
           <div class="card h-100">
             <div class="card-body">
               <h4 class="card-title"><?php echo $this->lang->line('OWNER_DUES'); ?></h4>

               <!-- <div id="ownserDuechart" style="width: 100%; min-height: 70vh;"></div> -->
               <canvas id="ownserDuechart" style="width:100%;max-width:600px"></canvas>
               <script>
                 async function displayOwnersDuesGraph() {
                   try {
                     const res_data = await $.ajax({
                       type: "POST",
                       dataType: "json",
                       url: "<?php echo base_url('admin/ownersDuesrequest'); ?><?php echo isset($_GET['filter']) ? "?filter=" . strval($_GET['filter']) : null; ?>",
                       data: {
                         task: 2
                       }
                     });

                     if (res_data[0].resSuccess == 1) {
                       const graphData = res_data[0].wdrequest;
                       drawChartJs({
                         type: "pie",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
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
                 displayOwnersDuesGraph();
               </script>

             </div>
           </div>
         </div>
         <div class="col-md-6 my-3">
           <div class="card h-100">
             <div class="card-body">
               <h4 class="card-title"><?php echo $this->lang->line('INCOME'); ?></h4>

               <!-- <div id="incomechart" style="width: 100%; min-height: 70vh;"></div> -->
               <canvas id="incomechart" style="width:100%;max-width:600px"></canvas>
               <script>
                 async function displayIncomeGraph() {
                   try {
                     const res_data = await $.ajax({
                       type: "POST",
                       dataType: "json",
                       url: "<?php echo base_url('admin/incomerequest'); ?><?php echo isset($_GET['filter']) ? "?filter=" . strval($_GET['filter']) : null; ?>",
                       data: {
                         task: 2
                       }
                     });

                     if (res_data[0].resSuccess == 1) {
                       const graphData = res_data[0].wdrequest;
                       drawChartJs({
                         type: "pie",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
                         title: "<?php echo $this->lang->line('OWNERS_DUE'); ?>",
                         chartId: "incomechart"
                       });
                     } else if (res_data[0].resSuccess == 2) {
                       // Handle resSuccess === 2 scenario
                     }
                   } catch (error) {
                     console.error(error);
                   }
                 }
                 displayIncomeGraph();
               </script>

             </div>
           </div>
         </div>
         <div class="col-md-6 my-3">
           <div class="card h-100">
             <div class="card-body">
               <h4 class="card-title"><?php echo $this->lang->line('UNITS'); ?></h4>


               <canvas id="unitschart" style="width:100%;max-width:600px"></canvas>
               <script>
                 async function displayUnitsGraph() {
                   try {
                     const res_data = await $.ajax({
                       type: "POST",
                       dataType: "json",
                       url: "<?php echo base_url('admin/unitsrequest'); ?><?php echo isset($_GET['filter']) ? "?filter=" . strval($_GET['filter']) : null; ?>",
                       data: {
                         task: 2
                       }
                     });

                     if (res_data[0].resSuccess == 1) {
                       const graphData = res_data[0].wdrequest;
                       drawChartJs({
                         type: "pie",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
                         title: "<?php echo $this->lang->line('OWNERS_DUE'); ?>",
                         chartId: "unitschart"
                       });
                     } else if (res_data[0].resSuccess == 2) {
                       // Handle resSuccess === 2 scenario
                     }
                   } catch (error) {
                     console.error(error);
                   }
                 }

                 displayUnitsGraph();
               </script>

             </div>
           </div>
         </div>
         <div class="col-md-6 my-3">
           <div class="card h-100">
             <div class="card-body">
               <h4 class="card-title"><?php echo $this->lang->line('CONTRACT_STATUS'); ?></h4>
               <canvas id="contarctStatuschart" style="width:100%;max-width:600px"></canvas>
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
                       drawChartJs({
                         type: "pie",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
                         title: "<?php echo $this->lang->line('OWNERS_DUE'); ?>",
                         chartId: "contarctStatuschart"
                       });
                     } else if (res_data[0].resSuccess == 2) {
                       // Handle resSuccess === 2 scenario
                     }
                   } catch (error) {
                     console.error(error);
                   }
                 }

                 displayContractStatusGraph();
               </script>


             </div>
           </div>
         </div>
         <div class="col-md-6 my-3">
           <div class="card h-100">
             <div class="card-body">
               <h4 class="card-title"><?php echo $this->lang->line('CONTRACT_STATS'); ?></h4>
               <canvas id="contarctStatschart" style="width:100%;max-width:600px"></canvas>
               <script>
                 async function displayContractStatsGraph() {
                   try {
                     const selectedYear = document.getElementById("yearFilter").value;
                     const res_data = await $.ajax({
                       type: "POST",
                       dataType: "json",
                       url: "<?php echo base_url('admin/contract_stats'); ?><?php echo isset($_GET['year']) ? "?year=" . strval($_GET['year']) : null; ?><?php echo isset($_GET['year']) ? "?year=" . strval($_GET['year']) : null; ?>",
                       data: {
                         task: 2
                       }
                     });

                     // Check if the response data is an array with a "wdrequest" property
                     if (Array.isArray(res_data) && res_data.length > 0 && res_data[0].wdrequest) {
                       const graphData = res_data[0].wdrequest;
                      //  console.log(graphData);
                       // Update your chart with graphData (assuming drawChartJs handles this)
                       drawChartJs({
                         type: "line",
                         xValues: graphData.stat,
                         yValues: graphData.cnt,
                         bgColors: graphData.bgcolor,
                         title: graphData.title,
                         chartId: "contarctStatschart"
                       });
                     } else {
                       // Handle the case when there is no data or data structure is unexpected
                       console.error("Invalid or empty data returned.");
                     }
                   } catch (error) {
                     console.error(error);
                   }
                 }

                 displayContractStatsGraph();
               </script>


             </div>
           </div>
         </div>
       </div>
     </div>
   <?php endif; ?>
 </div>

 <script>
   function drawChartJs(sd) {
     new Chart(sd.chartId, {
       type: sd.type,
       data: {
         labels: sd.xValues,
         datasets: [{
           label: sd.title ? sd.title : null,
           backgroundColor: sd.barColors,
           data: sd.yValues
         }]
       },
       options: {
         title: {
           display: true,
           text: sd.title
         }
       }
     });
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
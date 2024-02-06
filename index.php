<?php
require_once'inc.func.php';
$cm->get_header();
?>
<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script><script type="text/javascript">
//<![CDATA[
        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
  //]]>
  </script><!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper" id="loadpage"> 
    <!-- Content Header (Page header) --> 
    
    <!-- Main content -->
    <section class="content">
      <section class="content-header" style="padding-bottom: 14px;padding-top:0px !important;">
        <h1> Dashboard <small>Control panel</small> </h1>
        <ol class="breadcrumb" style="padding:0px 5px !important;top:5px !important;;">
          <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
          <li class="active">Dashboard</li>
        </ol>
      </section>
      <!-- Small boxes (Stat box) -->
      <!-- Calendar --> 
      <?php echo $dashboard->calendar(); ?> 
      <!-- /.row --> 
      <!-- Main row -->
      <div class="row"> 
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable"> 
          <!-- Map box -->
          <div class="box box-info" style="height:400px;">
            <canvas id="myChart" width="1200" height="380" style="padding:10px;"></canvas>
          </div>
          <!-- /.box --> 
        </section>
        <!-- right col --> 
      </div>
      <!-- /.row (main row) --> 
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script> 
      <script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["JAN", "FEB", "MARCH", "APRIL", "MAY", "JUNE", "JULY","AUG", "SEP","OCT", "NOV", "DEC"],
        datasets: [{
            label: 'Sale Graph',
            data: [5000, 5000, 2000, 2000, 7000, 9000,1000,2000,30000,7000,9000,8000],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
				'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        },
		legend: { display: false }
    }
});
</script> 
    </section>
    <!-- /.content --> 
 </div>
  <!-- /.content-wrapper -->
  <?php 
$cm->get_footer();
?>
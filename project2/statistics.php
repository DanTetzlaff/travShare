<?php
require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php');
include('lib/model/VisitTableGateway.class.php');

//echo daily visits for regional map
function areaMap() {
	$gate = new VisitTableGateway($dbAdapter);
	$count = $gate->countVisitsForDate('2015-11-20');
	foreach ($count as $result) {
		echo $result->num; }
}

//create string for Geo map
function getGeo() { 
		$gate = new VisitTableGateway($dbAdapter);
		$count = $gate->countSixMonths();
		$string = '';
		for ($i = 0; $i<count($count); $i++) {
		   $string .= ("['" . $count[i]->CountryName . "', '" . $count[i]->num . "']"); 
		   if ($i<count($count)) { $string .= ", ";}
	    }
		echo $string;
}

//make dropdowns
function dropdown() {
		echo "<select>";
		$gate = new VisitTableGateway($dbAdapter);
		$countries = $gate->dropdownCountries();
		foreach ($countries as $c) {
			echo '<option value="$c->countryCode">$c->countryName</option>';
		}
		echo "</select>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
   <!--<script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript" src="js/makeGraphs.js"></script>-->
   
  

  

   <!--Area map -->
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
   <script type="text/javascript">
   google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Visits'],
          ['1',  20],
          ['10',  14],
          ['20',  16],
          ['30',  18]
        ]);

        var options = {
          title: 'November 2015',
          hAxis: {title: 'Day',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }

   
   
    <!--Geo map -->
     google.load("visualization", "1", {packages:["geochart"]});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visits'],
          ['Germany', 200],
          ['United States', 300],
          ['Brazil', 400],
          ['Canada', 500],
          ['France', 600],
          ['RU', 700]
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }
    

	<!--Column map 1-->
	google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawColumn);
      function drawColumn() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Country1', 'Country2', 'Country3'],
          ['2014', 7, 28, 356],
          ['2015', 34, 22, 472],
          ['2016', 65, 42, 298]
        ]);

        var options = {
          chart: {
            title: 'SiteVisits',
            subtitle: '2014-2016',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
	
	
	<!--Column map 2-->
	/*google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawColumn);
      function drawColumn() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Country1', 'Country2', 'Country3'],
          ['2014', 7, 28, 356],
          ['2015', 34, 22, 472],
          ['2016', 65, 42, 298]
        ]);

        var options = {
          chart: {
            title: 'SiteVisits',
            subtitle: '2014-2016',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart2_material'));

        chart.draw(data, options);
      }*/
	
	</script>


</head>

<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'includes/travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="index.php">Home</a></li>
           <li class="active">Statistics</li>
         </ol>          
		
		<div class="panel panel-default">
		  <div class="panel-heading">Site Visits Per Month</div>
		  <div class="panel-body">
				<!--display area chart-->
				<div id="chart_div" style="width: 500px; height: 300px;"></div>
		  </div><!--end panel body -->
		</div><!--end panel-->
		
		<div class="panel panel-default">
		  <div class="panel-heading">Site Visit Map</div>
		  <div class="panel-body">
				<!--display geo chart-->
				<div id="regions_div" style="width: 500px; height: 300px;"></div>
		  </div><!--end panel body -->
		</div><!--end panel-->
		
		<div class="panel panel-default">
		  <div class="panel-heading">Compare Countries</div>
		  <div class="panel-body">
				<form action="statistics.php" method="POST"> 
					<select>
					
				</form>
				<!--three drop downs and "Chart It" button-->
				
				
				<!--display column chart-->
				<div id="columnchart_material" style="width: 500px; height: 300px;"></div>
				<!--<div id="columnchart2_material" style="width: 500px; height: 300px;"></div>-->
				<!--"Switch" button-->
		  </div><!--end panel body -->
		</div><!--end panel-->

      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
 <!--<div id="chart_div"></div> -->
 
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>

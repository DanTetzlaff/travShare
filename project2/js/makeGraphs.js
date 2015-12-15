/*
Author: Michaela Day
Created: December 2015
Version: 1.0
*/

window.addEventListener('load', init);

// Load the Visualization API and the piechart package.
google.load('visualization', '1', {packages:['corechart']});
// Set a callback to run when the Google Visualization API is loaded.
google.setOnLoadCallback(drawChart);

function drawChart() {
	var data = google.visualization.arrayToDataTable([
          ['Day', 'Visits'],
			for (i = 1; i<31; i++) {
				 var checkDate = '2015-11-' + i;
				 var visits = function(checkDate){<?php $gate = new VisitTableGateway($dbAdapter);
					$count = $gate->countVisitsForDate($checkDate);
					foreach ($count as $result) { echo $result->num; }  ?>}; //all countVisitsForDate($checkDate)
				  document.write('["i", "visits"]');
				 if ( i != 30 ) { document.write(', '); }
			}
        ]);

    var options = {
          title: "November Visits",
          hAxis: {title: 'Day',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

    var chart = new google.visualization.AreaChart(document.getElementById('chartArea_div'));
    chart.draw(data, options);
}

function getGeo() {
					$gate = new VisitTableGateway($dbAdapter);
					$count = $gate->countSixMonths();
					$string = '';
					for ($i = 0; $i<count($count); $i++) {
					   $string .= ("['" . $count[i]->CountryName . "', '" . $count[i]->num . "']"); 
					   if ($i<count($count)) { $string .= ", ";}
 				    }
					return $string;
	}

function drawRegionsMap() {

        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visits'],
          //document.write('<?php getGeo(); ?>');
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

        chart.draw(data, options);
      }








/*
google.load("visualization", "1", {packages:["corechart"]});
google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2013',  1000,      400],
          ['2014',  1170,      460],
          ['2015',  660,       1120],
          ['2016',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      } */





/*function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['Mushrooms', 3],
          ['Onions', 1],
          ['Olives', 1],
          ['Zucchini', 1],
          ['Pepperoni', 2]
        ]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
                       'width':500,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }*/

	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
/*<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Day', 'Visits'],
          ['1',  1000],
          ['2',  1170],
          ['3',  660],
          ['4',  1030]
        ]);

        var options = {
          title: 'Visits in a Month',
          hAxis: {title: 'Day',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chartArea_div'));
        chart.draw(data, options);
      }
    </script>*/
	
	
	
	
	
	
	

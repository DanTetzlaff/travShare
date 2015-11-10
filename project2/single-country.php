<?php

require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php');




if ( isset($_GET['iso']) ) {
   $id = $_GET['iso'];
}
else {
   $id = 1;
}

$countryGate = new CountryTableGateway($dbAdapter);
$country = $countryGate->findById($id);
$cName = $country->CountryName;
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
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
           <li><a href="browse.php">Browse</a></li>
           <li><a href="browse-countries.php">Countries</a></li>
           <li class="active"><?php echo $cName; ?></li>
         </ol>          

		<div class = "well">
			<p><h1><?php ?> </h1><p>
			<p>Capital: <strong><?php ?></strong></p>
			<p>Area: <strong><?php ?></strong> sq km</p>
			<p>Population: <strong><?php  ?></strong></p>
			<p>Currency Name: <strong><?php ?></strong></p>
			<p><?php  ?></p>
		</div>
		<div class="panel panel-primary">
		  <div class="panel-heading">Images From <?php echo $cName;?></div>
		  <div class="panel-body">
				<?php
					//gets all the photos from the country based on countryCode

				?>
		  </div><!--end panel body -->
		</div><!--end panel primary -->
		
         
      </div>  <!-- end main content column -->   
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'includes/travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>
<?php

require_once('travel-setup.inc.php');
include('travel-utilities.inc.php');

$cityGate = new CityTableGateway($dbAdapter);
$cities = $cityGate->findCitiesWithImages();

$countryGate = new CountryTableGateway($dbAdapter);
$countries = $countryGate->findCountriesWithImages();


$continentGate = new ContinentTableGateway($dbAdapter);
$continents = $continentGate->findAllSorted(true);

$imagesGate = new TravelImageTableGateway($dbAdapter);
$city = 0;
$country = "ZZZ";
if ( isset($_GET['iso']) ) {
   $countryParam = $_GET['iso'];
   $requestedCountry = $countryGate->findById($countryParam);   
}
$images = retrieveImages( $imagesGate, $city, $countryParam ); 
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'travel-head.inc.php'; ?>
</head>
<body>

<?php include 'travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
      <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'travel-left-rail.inc.php'; ?>
      </div>  <!-- end left navigation rail --> 
      
      <div class="col-md-9">  <!-- start main content column -->
         <ol class="breadcrumb">
           <li><a href="#">Home</a></li>
           <li><a href="#">Browse</a></li>
           <li class="active">Images</li>
         </ol>          
    
         <div class="well well-sm">
            <h3><?php echo $requestedCountry->CountryName; ?></h3>
            <p>Capital: <strong> <?php echo $requestedCountry->Capital; ?> </strong></p>
            <p>Area: <strong> <?php echo number_format($requestedCountry->Area, 0, '.', ','); ?> </strong> sq km.</p>
            <p>Population: <strong> <?php echo number_format($requestedCountry->Population, 0, '.', ','); ?> </strong></p>
            <p>Currency Name: <strong> <?php echo $requestedCountry->CurrencyName; ?> </strong></p>
            <p><?php echo $requestedCountry->CountryDescription; ?> </p>
         </div>   <!-- end city well -->
         
         <div class="well well-sm">
            <h4>Images from <?php echo $requestedCountry->CountryName; ?></h4>
            <div class="row">
               <?php displayImagesThumbnails($images); ?>
            </div>
         </div>   <!-- end images well -->

      </div>  <!-- end main content column -->
   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
   
<?php include 'travel-footer.inc.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>
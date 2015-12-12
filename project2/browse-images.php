<?php

require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php');

//pull cities, that have images from them, from database
$cityGate = new CityTableGateway($dbAdapter);
$cities = $cityGate->findCitiesWithImages();


//create gateway for image table on db
$imagesGate = new TravelImageTableGateway($dbAdapter);

$city = 0;
$country = "ZZZ";
if ( isset($_GET['city']) && $_GET['city'] != "" && is_numeric($_GET['city']) ) {
   $city = $_GET['city'];
}
if ( isset($_GET['country']) && ($_GET['country'] != "") && ctype_alpha($_GET['country']) && strlen($_GET['country']) == 2 ) {
   $country = $_GET['country'];
}

//retrieve images using image gateway and info about its city and country
$images = retrieveImages( $imagesGate, $city, $country ); 
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Travel Template</title>
   <?php include 'includes/travel-head.inc.php'; ?>
   <script type="text/javascript" language="javascript" src="js/imgPreview.js"></script>
   <link rel="stylesheet" href="lib/helpers/styles.css" />
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
           <li class="active">Images</li>
         </ol>          
    
         <div class="well well-sm">
            <form class="form-inline" role="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group" >
                <select class="form-control" name="city">
                  <option value="0">Filter by City</option>
                 <?php
				 //create option choices based on cities that have images for filter
                  foreach ($cities as $city) {

                     echo '<option value="' . $city->GeoNameID .'" >' . $city->AsciiName . '</option>';
                  }
                 ?>      
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" name="country">
                  <option value="ZZZ">Filter by Country</option>
                          <?php
						  //create option choices based on countries that have images for filter select
                           foreach ($countries as $country) {                          
                              echo '<option value="' . $country->ISO  . '" >' . $country->CountryName . '</option>';
                           }
                          ?>      
                </select>
              </div>  
              <button type="submit" class="btn btn-primary">Filter</button>
            </form>         
         </div>      <!-- end filter well -->
         
         <div class="well">
            <div class="row">
               <?php displayImagesThumbnails($images); ?>
            </div>
         </div>   <!-- end images well -->

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

<?php

require_once('includes/travel-setup.inc.php');
include('lib/helpers/travel-utilities.inc.php');

//error checking for GET variables
$id = "";
$get = $_GET['uid'];
if(isset($get) && $get != "" && is_numeric($get)){ $id = $get; } else { header('Location: error.php'); }

//pull user information from database
$userGate = new TravelUserTableGateway($dbAdapter);
$user = $userGate->findById($id);
$uName = buildUname($user);
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
		   <li><a href="browse-users.php">Users</a></li>
		   <li class='active'><?php echo $uName; ?></li>
		 </ol>
		 
		<div class='panel panel-default'> <!-- Beginning of panel element -->
			<div class='panel-heading'> <!-- Beginning of panel heading -->
				<h2><?php echo $uName; ?></h2>
				<p>Address: <strong><?php echo utf8_encode($user->Address); ?></strong></p>
				<p>City, Country: <strong><?php echo utf8_encode($user->City) . ", " . utf8_encode($user->Country); ?></strong></p>
				<p>Email: <strong><?php echo $user->Email; ?></strong></p>
			</div> <!-- End of panel heading -->
		</div> <!-- End of panel element -->
			
		<div class='panel panel-primary'> <!-- Beginning of images panel -->
			<div class='panel-heading'>Images from <?php echo $uName; ?></div>
			<div class= 'panel-body'> <!-- Beginning of image panel body -->
				<?php
					$imgGate = new TravelImageTableGateway($dbAdapter);
					$result = $imgGate->findForUser($id);
					displayImagesThumbnails($result);
				?>
			</div> <!-- End of image panel body -->
		</div> <!-- End of images panel -->
      
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

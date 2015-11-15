<?php
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if(isset($_SESSION['img']))
	{
		#print_r($_SESSION['img']);
		
		processCart($_SESSION['img'], $dbAdapter);
	}


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel Template</title>
	<?php include 'includes/travel-head.inc.php'; ?>
</head>
<body>

	<?php include 'includes/travel-header.inc.php'; ?>
	
<div class="container"> <!-- Start main content container -->
	<div class="row"> <!-- start main content row -->
		<div class="col-md-3"> <!-- start left navigation rail column -->
			<?php include 'includes/travel-left-rail.inc.php'; ?>
		</div> <!-- end left navigation rail -->
		
		<div class="col-md-9"> <!-- start main content column -->
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Cart</li>
			</ol>


		</div> <!-- end main content column -->
	</div> <!-- end main content row -->
</div> <!-- end main content container -->

<?php include 'includes/travel-footer.inc.php'; ?>

 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_travelTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_travelTheme/dist/js/bootstrap.min.js"></script>
 <script src="bootstrap3_travelTheme/assets/js/holder.js"></script>
</body>
</html>

<?php
	session_start(); //start session to access favorites arrays
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	//print_r($_SESSION['favimgs']);	//Debugging tool
	//print_r($_SESSION['favposts']);
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
				<li class="active">Favorites</li>
			</ol>
			
			<div class="panel panel-default"> <!-- start favPost panel -->
				<div class="panel-heading">
					Favorite Posts
					<div class="pull-right"><button type="button" class="btn btn-info btn-xs"><a href="rm-fav.php?rmAllP=1">Remove All Posts</a></button></div>
				</div>
				<ul class="list-group"> <!-- start favPost panel contents -->
					<?php 
						favPosts($_SESSION['favposts'], $dbAdapter);  //print list of favorite posts
					?>
				</ul> <!-- end favPost panel contents -->
			</div> <!-- end favPost panel -->
			
			<div class="panel panel-default"> <!-- start favImg panel -->
				<div class="panel-heading">
					Favorite Images
					<div class="pull-right"><button type="button" class="btn btn-info btn-xs"><a href="rm-fav.php?rmAllI=1">Remove All Images</a></button></div>
				</div>
				<ul class="list-group"> <!-- start favImg panel contents -->
					<?php
						favImg($_SESSION['favimgs'], $dbAdapter); //print lists of favorite images
					?>
				</ul> <!-- end favImg panel contents -->
			</div> <!-- end favImg panel -->
			<div class="pull-right"><button type="button" class="btn btn-danger btn-xs"><a href="rm-fav.php?clear=1">Remove All Favorites</a></button></div>
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

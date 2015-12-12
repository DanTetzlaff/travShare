<?php
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	$searchResults;
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
	
<div class="container"> <!-- Start main content container -->
	<div class="row"> <!-- start main content row -->
		<div class="col-md-3"> <!-- start left navigation rail column -->
			<?php include 'includes/travel-left-rail.inc.php'; ?>
		</div> <!-- end left navigation rail -->
		
		<div class="col-md-9"> <!-- start main content column -->
			<ol class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li class="active">Search</li>
			</ol>
			<!-- search box for new searches -->
			<form method = "post" class = "inline" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class = "form-group form-group-lg">
					<div class = "col-md-6">
						<input type="text" class="form-control input-lg" placeholder="<?php 
						if(isset($_SESSION['searchString']) && $_SESSION['searchString'] != "") 
						{
					
							print($_SESSION['searchString']);
						}
						else
						{	
							echo 'Search for image';
						}
						?>" name="srch">
					</div>
					<button class="btn btn-default btn-lg" type="submit" name = "submit">Search</button>
				</div>
			</form>
			<div class = "well well-md">
				<!--print out search query -->
				<h4> Results for: <i><?php print($_SESSION['searchString']); ?></i></h4>
				<!-- print out images results as thumbnails. Hover will display the image description and img is a link to the image's single-image.php page -->
				<div class = "panel panel-default">
					<div class = "panel-body">
						<?php 
							searchImages($dbAdapter, $_SESSION['searchString']);
							
							/**
								method found in travel-utilities.inc.php and returns thumbnails from the array of images it is given.
								displayImagesThumbnails($searchResults);
							**/
						?>
					</div>
				</div>
			</div> <!--end well -->
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

<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; 
   charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Travel Template</title>

   <link rel="shortcut icon" href="../../assets/ico/favicon.png">

   <!-- Google fonts used in this theme  -->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,800,600,700,300' rel='stylesheet' type='text/css'>  

   <!-- Bootstrap core CSS -->
   <link href="bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Custom styles for this template -->
   <link href="bootstrap-3.3.5-dist/theme.css" rel="stylesheet">  

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_travelTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_travelTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<?php include 'include/travel-header.php';
	$imgId = $_GET['imgId'];
	if(empty($imgId))
	{
		header( 'Location: error.php' ) ;
	}
	?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
	 <div class="col-md-3">  <!-- start left navigation rail column -->
         <?php include 'include/travel-left-rail.php'; 
		try
		{
			$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}
		catch (PDOException $e) 
		{
			die( $e->getMessage() );
		}
		?>
  </div>  <!-- end left navigation rail --> 
	 <ol class="breadcrumb">
	   <li><?php generateLink('index.php', '', 'Home');?></li>
	   <li><?php generateLink('browse.php', '', 'Browse');?></li>
	   <li><?php generateLink('browse-images.php', '', 'Images');?></li>
	   <?php
	   $results = getPhotoDetails($imgId, $pdo);
	   while($img = $results->fetch())
	   {
		$title = $img['Title'];
		$desc = $img['Description'];
		$cityCode = $img['CityCode'];
		$countryCode = $img['CountryCodeISO'];
	   }	   
	   ?>
	   <li class = "active"><?php echo $title; ?></li>
	 </ol>          
	 <!-- start post summaries -->
	<p><h1><?php echo $title; ?></h1></p>
	<hr/>
		<div class = "col-md-9">
			<div class = "row">
				<div class = "col-lg-8 col-md-8 col-sm-8 col-xs-8">
				<?php
				//grabs the image to be displayed on page as well as the modal
				$image = getImage($imgId, $pdo);
				while($row = $image->fetch())
				{
					$path = $row['Path'];
					$imgUrl = 'travel-images/medium/' . $path;
					$imgPath = '<img src="' . $imgUrl . '" name="' . $title . '" alt="' . $title . '"/>';
				}				
				?>
				
				<a data-toggle="modal" data-target="#myModal"><?php echo $imgPath; ?></a>
				<div class = "reveal-modal large" data-reveal id="myModal" tabindex="-1" role="dialog">
					<div class = "modal-dialog">
						<div class = "modal-content">
							<div class = "modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<h4 class = "modal-title"><?php echo $title; ?></h4>
							</div><!--modal header -->
							<div class = "modal-body">
							<?php
							
							$modalImg = 'travel-images/large/' . $path;
							echo '<img src="' . $modalImg . '" name="' . $title . '" alt="' . $title . '"/>';
							?>
							</div><!--modal body -->
						</div><!--modal content -->
					</div><!--modal dialog -->
				</div><!--modal fade -->
				</div>
				<div class = "col-md-4">
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h3 class="panel-title">Image by</h3>
					  </div>
					  <div class="panel-body">
						<p>
						<?php
						//gets user info based on imageID and links it to the user's single-user profile page
						$user = getUserFromPhotos($imgId, $pdo);
						while($row = $user->fetch())
						{
							$fullName = $row['FirstName'] . " " . $row['LastName'];
							$userLink = 'single-user.php?id=' . $row['UID'];
							generateLink($userLink, " ", utf8_encode($fullName));
						}
						?>
						</p>
					  </div>
					</div>
					<div class="panel panel-default">
					  <div class="panel-heading">
						<h3 class="panel-title">Image Details</h3>
					  </div>
					  <div class="panel-body">
						<p>
						<?php
						if($cityCode != null)
						{
							//gets city name from img photo details
							$cityCountry = getCity($cityCode, $pdo);
							while($row = $cityCountry -> fetch())
							{
								$cityName = $row['AsciiName'];
							}	

							echo $cityName . ", ";
						}
						//gets the country the image was taken and have it link directly to the country's single-country page
						$result = getAllCountryInfo($countryCode, $pdo);
						while($cntry = $result->fetch())
						{
							$countryName = $cntry['CountryName'];
							$countryLink = 'single-country.php?id=' . $countryCode;
							generateLink($countryLink, " ", $countryName);
						}
						?>
						</p>
					  </div>
					</div>
					<div class="panel panel-success">
					  <div class="panel-heading">
						<h3 class="panel-title">Social</h3>
					  </div>
					  <div class="panel-body">
						<div class = "button">
							<?php
								$link = "addToFavourites.php?id=" . $imgId;								
							?>
							<form action = "<?php echo $link ?>" method = "get" target="_blank">
								<?php
								echo "<button class='btn btn-primary btn-sm' name='id' type='submit' formaction='".$link."' value='".$imgId."'>Add To Favourites</button>";
								?>
							</form>
							<br/>
							<a href="#" class="btn btn-success btn-sm" role="button">View Favourites</a>
						</div>
					  </div>
					</div>
				</div>
			</div>
			<div class = "row">
				<br/>
				<p><?php echo $desc; 
				$pdo = null;
				?></p>
			</div>
		</div>

   </div>  <!-- end main content row -->
</div>   <!-- end main content container -->
<?php include 'include/travel-footer.php'; ?>   

   
   
 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
  <script src="bootstrap-3.3.5-dist/assets/js/jquery.js"></script>
 <script src="bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
  <script src="bootstrap-3.3.5-dist/assets/js/holder.js"></script>
</body>
</html>
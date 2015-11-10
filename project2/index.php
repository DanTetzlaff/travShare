<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel Template</title>
	<?php 
		include 'includes/travel-head.inc.php';
		session_start();
	?>
</head>

<body>

<?php include 'includes/travel-header.inc.php'; ?>
   
<div class="container">  <!-- start main content container -->
   <div class="row">  <!-- start main content row -->
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img src="images/travel/large/9498386718.jpg" alt="First slide">
		  <div class="carousel-caption">
			<h3>From St. Peters</h3>
			<p>This photo was taken at St. Peters</p>
			<p><a class="btn btn-info btn-md" href="single-image.php?id=56" role="button">Learn more</a></p>
		  </div>
        </div>
        <div class="item">
          <img src="images/travel/large/9505536014.jpg" alt="Second slide">
		  <div class="carousel-caption">
			<h3>Pisa - Campasanto</h3>
			<p>This photo is from Campasanto, Pisa</p>
			<p><a class="btn btn-info btn-md" href="single-image.php?id=66" role="button">Learn more</a></p>
		  </div>
        </div>
        <div class="item">
          <img src="images/travel/large/9504451722.jpg" alt="Third slide">
		  <div class="carousel-caption">
			<h3>Interior Santo Spirito, Florence</h3>
			<p>Filippo Brunelleschi designed church has been call...</p>
			<p><a class="btn btn-info btn-md" href="single-image.php?id=62" role="button">Learn more</a></p>
		  </div>
        </div>
      </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
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

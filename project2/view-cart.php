<?php
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
		//print_r($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Travel Template</title>
	<?php include 'includes/travel-head.inc.php'; ?>
	<script type="text/javascript" language="javascript" src="js/lab08.js"></script>
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
			
			<div class="panel panel-default"> <!-- start cart panel -->
				<div class="panel-heading">
					Your Cart
					<div class="pull-right"><button type="button" class="btn btn-info btn-xs"><a href="rm-fav.php?rmAllI=1">Remove All Items</a></button></div>
				</div>
				<div class="panel-body">
			    <table class="table"> <!-- start cart item list -->
					<tr>
						<td></td>
						<td>Item</td>
						<td></td>
						<td>Size</td>
						<td>Paper Stock </td>
						<td>Frame</td>
						<td>Quantity</td>
						<td>Total</td><td> </td>
					</tr>
					
					<form action="process-cart.php" method="post">
						<?php 
							
							if(!isset($_SESSION['cart'])) {
								emptyCart();//displays empty cart
							}
							else { processCart($_SESSION['cart']); }						
						?>
					</form>
					
				</table>	
				<br/>
				<br/>
				<div class = "pull-right">
					<a href = "#"><button class="btn btn-success" type = "button" name = "order">Order</button></a>
					<a  href = "index.php"><button class="btn btn-warning"  type = "button" name = "continue">Continue Shopping</button></a>
				</div>
				</div>
			</div> <!-- end cart panel -->
			
			
			
			
			

			
			
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

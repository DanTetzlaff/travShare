<?php
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if(isset($_SESSION['img']))
	{
		print_r($_SESSION['img']);
		
		processCart($_SESSION['img'], $dbAdapter);
	}
	$end = $_GET['img'];
	//$_POST['img'] = end($end);

$size = 2.50;
$qty = 1;
$stock = "Matte";
$frame = "None";

	if(isset($_POST['size']))
	{
		$size = $_POST['size'];
	}
	
	if(isset($_POST['qty']))
	{
		$qty = $_POST['qty'];
	}	
	
	if(isset($_POST['stock']))
	{
		$stock = $_POST['stock'];
	}	
	
	if(isset($_POST['frame']))
	{
		$frame = $_POST['frame'];
	}	
	
	#computeSubtotal($size, $qty, $stock, $frame);
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
				<li class="active">Add to Cart</li>
			</ol>
			<div class = "well well-lg">
			<p> Image Details </p>
				<form method = "post" class = "horizontal" action = "update-cart.php">
					<div class = "form-group form-group-sm">
						<label class="col-sm-3 control-label" for="formGroupInputSmall">Choose size: </label>
						<div class = "col-xs-3">
							<select class="form-control input-sm" name="size">
								<option value='8"x10"'>8"x10"</option>
								<option value='5"x7"'>5"x7"</option>
								<option value='11"x14"'>11"x14"</option>
								<option value='12"x18"'>12"x18"</option>
							</select>
						</div>
					</div>
					<br/>
					<br/>
					<div class = "form-group form-group-sm">
						<label class="col-sm-3 control-label" for="formGroupInputSmall">Choose quantity: </label>
						<div class = "col-xs-3">
							<select class="form-control input-sm" name="qty">
								<option value="1">1</option>
								<?php
								for($i = 2; $i < 16; $i++)
								{
									echo '<option value="' . $i . '">' . $i . '</option>';
								}
								
								?>
							</select>
						</div>
					</div>
					<br/>
					<br/>
					<div class = "form-group form-group-sm">
						<label class="col-sm-3 control-label" for="formGroupInputSmall">Choose paper stock: </label>
						<div class = "col-sm-offset-3 col-sm-9">
							<label class="radio-inline">
							  <input type="radio" name="stock" id="stock1" value="Matte" checked> Matte
							</label>
							<label class="radio-inline">
							  <input type="radio" name="stock" id="stock2" value="Glossy"> Glossy
							</label>
							<label class="radio-inline">
							  <input type="radio" name="stock" id="stock3" value="Canvas"> Canvas
							</label>
						</div>
					</div>
					<br/>
					<br/>
					<div class = "form-group form-group-sm">
						<label class="col-sm-3 control-label" for="formGroupInputSmall">Choose frame: </label>
						<div class = "col-sm-offset-3 col-sm-9">
							<label class="radio-inline">
							  <input type="radio" name="frame" id="frame1" value="None" checked> None
							</label>
							<label class="radio-inline">
							  <input type="radio" name="frame" id="frame2" value="Blond Maple"> Blond Maple
							</label>
							<label class="radio-inline">
							  <input type="radio" name="frame" id="frame3" value="Espresso Walnut"> Espresso Walnut
							</label>
							<label class="radio-inline">
							  <input type="radio" name="frame" id="frame4" value="Gold Accent"> Gold Accent
							</label>
							<label class="radio-inline">
							  <input type="radio" name="frame" id="frame5" value="Silver Metal"> Silver Metal
							</label>							
						</div>
					</div>
					<br/>
					<br/>
					<br/>
					<div class = "pull-right">
						<button class="btn btn-info"  type = "submit" value = "<?php echo $end; ?>" name = "update">Add to Cart</button>
					</div>
					<br/>
					
					
					
					<!--
					<div class = "form-group form-group-sm">
						<div class = "col-sm-offset-3 col-sm-9">
								<?php 
									$subtotal = computeSubtotal($size, $qty, $stock, $frame);
									echo '<strong>SUBTOTAL: </strong> $';
									echo $subtotal;
									checkShippingCost($subtotal);
								?>
						</div>
					</div>
					<br/>
					<div class = "form-group form-group-sm">
						
						<div class = "col-sm-offset-3 col-sm-9">
							<label for="formGroupInputSmall">Shipping: &nbsp;</label>
							<label class="radio-inline">
							  <input type="radio" name="ship" id="ship1" value="Standard" checked> Standard Shipping 
							</label>
							<label class="radio-inline">
							  <input type="radio" name="ship" id="ship2" value="Blond Maple"> Express Shipping
							</label>							
						</div>
					</div>
					<br/>
					<br/>
					<div class = "pull-right">
						<a href = "#"><button class="btn btn-success" type = "button" name = "order">Order</button></a>
						<a  href = "index.php"><button class="btn btn-warning"  type = "button" name = "continue">Continue Shopping</button></a>
						<a href = "view-cart.php"><button class="btn btn-info"  type = "button" name = "update">Update Cart</button></a>	
					</div>
					<br/>
					<br/>-->
				</form>
			</div>

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

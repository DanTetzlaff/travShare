<?php
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	$key = $_POST['submit'];
	$item = $_SESSION['cart'][$key];
	
	$size =  $_POST["itemSize"];//print_r($array)
	$stock =  $_POST['itemStock'];
	$frame =  $_POST['itemFrame'];
	$qty =  $_POST['itemQty'];
	$ship = $_POST['ship'];
	
	$_SESSION['shipping'] = $ship;
	$item->setImageSize($size[$key]);
	$item->setImageStock($stock[$key]);
	$item->setImageFrame($frame[$key]);
	$item->setImageQuantity($qty[$key]);
	$item->getTotal();
	
	print_r($_SESSION['shipping']);
	
	header("Location: view-cart.php");
?>
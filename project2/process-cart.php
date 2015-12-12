<?php
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	$key = $_POST['submit'];
	$item = $_SESSION['cart'][$key];
	
	$size =  $_POST["itemSize"];
	$stock =  $_POST['itemStock'];
	$frame =  $_POST['itemFrame'];
	$qty =  $_POST['itemQty'];
	
	$item->setImageSize($size[$key]);
	$item->setImageStock($stock[$key]);
	$item->setImageFrame($frame[$key]);
	$item->setImageQuantity($qty[$key]);
	$item->getTotal();
	
	//print_r($size);
	//print_r($stock);
	//print_r($frame);
	//print_r($qty);
	print_r($_SESSION['cart']);
	
	header("Location: view-cart.php");
?>
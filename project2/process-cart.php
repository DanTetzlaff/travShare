<?php
/**
Author: Carille Mendoza
Version: 1.5
Desc: Currently saving each cart item's state via php
**/
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	//gets items from individual item forms
	$size =  $_POST["itemSize"];//print_r($array)
	$stock =  $_POST['itemStock'];
	$frame =  $_POST['itemFrame'];
	$qty = $_POST['itemQty'];
	$_SESSION['shipCost'] = $_POST['shipC'];//saved cart shippingCost
	$_SESSION["rT"] = $_POST['rT'];//saved cart runningTotal
	$_SESSION["tot"] = $_POST["tot"];//saved cartTotal
	
	//print_r($size);
	//print_r($stock);
	//print_r($frame);
	//print_r($qty);
	
	
	foreach($_SESSION['cart'] as $key=>$item)
	{
		$item->setImageSize($size[$key]);
		$item->setImageStock($stock[$key]);
		$item->setImageFrame($frame[$key]);
		$item->setImageQuantity($qty[$key]);
		$item->getTotal();
	}
	
	
	header("Location: view-cart.php");
?>
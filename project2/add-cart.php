<?php
/*
Author: Daniel Tetzlaff
Created: November 2015
Version: 2.0
Modified: December 2015 by Carille Mendoza 

Adds items to a cart array stored in session
*/
	include('lib/model/CartItem.class.php');
	session_start(); // begin session to access session array
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if (isset($_GET['img']))
	{
		$img = $_GET['img'];
		if ($img != "" && is_numeric($img)) //check if item has a valid id
		
		{
			$imgGate = new TravelImageTableGateway($dbAdapter);
			$travelImage = $imgGate->findById($img);
			
			if ($travelImage->ImageID == $img) //check if item id exists in database
			{
				$cartItem = new CartItem($img, $travelImage->Path, $travelImage->Title); // create the cart item to add to array
				//array_push($_SESSION['img'], $img);
				//array_push($_SESSION['cart'], $cartItem);
				$_SESSION['cart'][] = $cartItem;
			}
			
			header("Location: view-cart.php"); //completed processing -> redirect to view cart page
		}
		else
		{
			header('Location: browse-images.php'); //not a valid id -> redirect to browse images page
		}
	}
?>

<?php
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if (isset($_GET['img']))
	{
		$img = $_GET['img'];
		if ($img != "" && is_numeric($img))
		{
			$imgGate = new TravelImageTableGateway($dbAdapter);
			$travelImage = $imgGate->findById($img);
			
			if ($travelImage->ImageID == $img)
			{
				$cartItem = new CartItem($img, $travelImage->Path, $travelImage->Title);
				array_push($_SESSION['img'], $img);
				array_push($_SESSION['cart'], $cartItem);
			}
			
			header("Location: view-cart.php");
		}
		else
		{
			header('Location: browse-images.php');
		}
	}
?>

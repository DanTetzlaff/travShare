<?php
	include('lib/model/CartItem.class.php');
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
<<<<<<< HEAD
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
=======
	$size =  $_GET['size'];
	$stock =  $_GET['stock'];
	$frame =  $_GET['frame'];
	$qty =  $_GET['qty'];
	$cartArray = $_SESSION['cart'];
	
	for($i =0; $i < count($cartArray) ; $i++)
		{
			//print_r($cartArray);
			//print_r($_SESSION['cart']);
			if ( isset($cartArray[$i]) )
			{
			if ( $_GET['index'] == $cartArray[$i]->getIndex() ) 
			{
				unset($_SESSION['cart'][$i]);
				//reset($_SESSION['cart']);
				$cartArray[$i]->setImageSize($size);
				$cartArray[$i]->setImageQuantity($qty);
				$cartArray[$i]->setImageStock($stock);
				$cartArray[$i]->setImageFrame($frame);
				$cartArray[$i]->getIndex();
				$_SESSION['cart'][$i] = $cartArray[$i];
			}
			}
		}
		//print_r($cartArray);
		//print_r($_SESSION['cart']);
		header("Location: view-cart.php");
>>>>>>> origin/master
?>
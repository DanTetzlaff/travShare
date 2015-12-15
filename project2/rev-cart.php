<?php
/*
Author: Carille Mendoza
Version: 1.5
Desc: Deals with removes an item from the cart
Version: 2.0
Desc: Removes all cart items
*/
	include('lib/model/CartItem.class.php');
	session_start();

	
	if(isset($_GET['no']) && $_GET['no'] != '' && is_numeric($_GET['no']))
	{
		if($_GET['no'] == 1001)
		{
			unset($_SESSION['cart']);
			$_SESSION['cart'] = array();
			$_SESSION["shipCost"] = 0;
			$_SESSION["rT"] = 0;
			$_SESSION["tot"] = 0;
		}
		else
		{
			unset($_SESSION['cart'][$_GET['no']]);
			$newCart = array_values($_SESSION['cart']);
			$_SESSION['cart'] = $newCart;	
		}
	}
	
	header('Location: view-cart.php');
?>
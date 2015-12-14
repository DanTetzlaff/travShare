<?php
/*
Author: Carille Mendoza
Version: 1.5
Desc: Deals with removes an item from the cart
*/
	include('lib/model/CartItem.class.php');
	session_start();

	
	if(isset($_GET['no']) && $_GET['no'] != '' && is_numeric($_GET['no']))
	{
		unset($_SESSION['cart'][$_GET['no']]);
		$newCart = array_values($_SESSION['cart']);
		$_SESSION['cart'] = $newCart;
	}
	
	header('Location: view-cart.php');
?>
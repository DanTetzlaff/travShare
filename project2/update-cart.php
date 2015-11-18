<?php
	session_start();
	require_once('CartItem.class.php');
	
	$id = $_POST['update'];
	$size = $_POST['size'];
	$quantity = $_POST['qty'];
	$stock = $_POST['stock'];
	$frame = $_POST['frame'];

	// create cartItem object with info and add to cartItems array
	$item = new CartItem($id, $size, $quantity, $stock, $frame);
	
	
	if(!isset ($_SESSION['cartItems']) OR $_SESSION['cartItems'] = null) {
		$_SESSION['cartItems'] = array($item);
	}
	else { array_push($_SESSION['cartItems'], $item); }

	header('Location: view-cart.php');
	
?>
<?php
	include('lib/model/CartItem.class.php');
	session_start();
	//print_r($_SESSION['cart']);
	//$cartArray = $_SESSION['cart'];
	
	if(isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id']))
	{
		if (($key = array_search($_GET['id'], $_SESSION['img'])) !== false)
		{
			unset($_SESSION['img'][$key]);
		}
		
		$cartArray = $_SESSION['cart'];
		//print_r($cartArray);
		for($i = 0; $i < count($cartArray); $i++)
		{
			
			if ( $_GET['index'] == $cartArray[$i]->getIndex() ) 
			{
				unset($_SESSION['cart'][$i]);
				break;
			}	
		}
		
	}
	
	header('Location: view-cart.php');
?>
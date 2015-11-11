<?php
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
			
			if ($travelImage->ImageID == $img && !in_array($img, $_SESSION['img']))
			{
				array_push($_SESSION['img'], $img);
			}
		}
		else
		{
			header('Location: browse-images.php');
		}
	}
?>

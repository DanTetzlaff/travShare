<?php 
	session_start();
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if (isset($_GET['favimg']))
	{
		$img = $_GET['favimg'];
		if ($img != "" && is_numeric($img))
		{
			$imggate = new TravelImageTableGateway($dbAdapter);
			$travelImage = $imggate->findById($img);
			
			if ($travelImage->ImageID == $img && !in_array($img, $_SESSION['favimgs']))
			{
				array_push($_SESSION['favimgs'], $img);
			}
		}
		else
		{
			header('Location: browse-images.php');
		}
	}
	elseif (isset($_GET['favpost']))
	{
		$postId = $_GET['favpost'];
		if ($postId != "" && is_numeric($postId))
		{
			$postgate = new TravelPostTableGateway($dbAdapter);
			$travelPost = $postgate->findById($postId);
			
			if ($travelPost->PostID == $postId && !in_array($postId, $_SESSION['favposts']))
			{
				array_push($_SESSION['favposts'], $postId);
			}
		}
		else
		{
			header('Location: browse-posts.php');
		}
	}
	
	
	
	header('Location: view-favorites.php');
?>

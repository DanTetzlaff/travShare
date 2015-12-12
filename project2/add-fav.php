<?php
/*
Author: Daniel Tetzlaff
Created: November 2015
Version: 1.0

Operates the adding of items to favorites list, redirects to the favorites page when process completes
*/
	session_start(); //begin session to access session variable arrays used to store fav info
	
	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if (isset($_GET['favimg'])) // if the fav being added is image enter here
	{
		$img = $_GET['favimg'];
		if ($img != "" && is_numeric($img)) //check if valid image id
		{
			$imggate = new TravelImageTableGateway($dbAdapter);
			$travelImage = $imggate->findById($img);
			
			if ($travelImage->ImageID == $img && !in_array($img, $_SESSION['favimgs'])) //check if already in favs list - dups not allowed
			{
				array_push($_SESSION['favimgs'], $img);
			}
		}
		else
		{
			header('Location: browse-images.php'); // id was not valid so redirect to browse-images
		}
	}
	elseif (isset($_GET['favpost'])) // if the fav being added is a post
	{
		$postId = $_GET['favpost'];
		if ($postId != "" && is_numeric($postId)) // check if valid id
		{
			$postgate = new TravelPostTableGateway($dbAdapter);
			$travelPost = $postgate->findById($postId);
			
			if ($travelPost->PostID == $postId && !in_array($postId, $_SESSION['favposts'])) // check if already in favs list - dups not allowed
			{
				array_push($_SESSION['favposts'], $postId);
			}
		}
		else
		{
			header('Location: browse-posts.php'); // id was not valid so redirect to browse-posts
		}
	}
	
	
	//processing complete redirect to the main favorites page
	header('Location: view-favorites.php'); 
?>

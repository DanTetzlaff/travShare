<?php
/*
Author: Daniel Tetzlaff
Created: November 2015
Version: 1.0

Operates the removal of items from favorites list
*/
	session_start(); //start session to access required arrays stored in session
	
	if (isset($_GET['rmAllP']) && $_GET['rmAllP'] == 1) //if GET var set to remove all posts
	{
		$_SESSION['favposts'] = Array();
	}
	elseif (isset($_GET['rmAllI']) && $_GET['rmAllI'] == 1) //if GET var set to remove all images
	{
		$_SESSION['favimgs'] = Array();
	}
	elseif (isset($_GET['clear']) && $_GET['clear'] == 1) //if GET var set to remove all items (images and posts)
	{
		$_SESSION['favimgs'] = Array();
		$_SESSION['favposts'] = Array();
	}
	elseif (isset($_GET['postId'])) //if GET var is single post, find and remove that post
	{
		if (($key = array_search($_GET['postId'], $_SESSION['favposts'])) !== false)
		{
			unset($_SESSION['favposts'][$key]);
		}
	}
	elseif (isset($_GET['imgId'])) //if GET var is single image, find and remove that image
	{
		if (($key = array_search($_GET['imgId'], $_SESSION['favimgs'])) !== false)
		{
			unset($_SESSION['favimgs'][$key]);
		}
	}
	
	//completed processing -> redirect to the main favorites page
	header('Location: view-favorites.php');
?>

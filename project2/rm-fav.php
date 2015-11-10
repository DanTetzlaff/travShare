<?php
	session_start();
	
	if (isset($_GET['rmAllP']) && $_GET['rmAllP'] == 1)
	{
		$_SESSION['favposts'] = Array();
	}
	elseif (isset($_GET['rmAllI']) && $_GET['rmAllI'] == 1)
	{
		$_SESSION['favimgs'] = Array();
	}
	elseif (isset($_GET['clear']) && $_GET['clear'] == 1)
	{
		$_SESSION['favimgs'] = Array();
		$_SESSION['favposts'] = Array();
	}
	elseif (isset($_GET['postId']))
	{
		if (($key = array_search($_GET['postId'], $_SESSION['favposts'])) !== false)
		{
			unset($_SESSION['favposts'][$key]);
		}
	}
	elseif (isset($_GET['imgId']))
	{
		if (($key = array_search($_GET['imgId'], $_SESSION['favimgs'])) !== false)
		{
			unset($_SESSION['favimgs'][$key]);
		}
	}
	
	header('Location: view-favorites.php');
?>

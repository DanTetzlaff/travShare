<?php
session_start();

	require_once('includes/travel-setup.inc.php');
	include('lib/helpers/travel-utilities.inc.php');
	
	if(isset($_POST['submit']))
	{
		$string = $_POST['srch'];
		$_SESSION['searchString'] = $string;
	}
	
	header('Location:search-results.php');
?>
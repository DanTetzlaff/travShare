<?php
require_once('includes/travel-setup.inc.php');
?>
<html>
<body>
<h1> Domain Tester </h1>
<?php

echo '<hr/>';
echo '<h2>Test TravelPost</h2>';
 
$tp = new TravelPost(TravelPost::getFieldNames(), false);
$tp->PostID = 223;
$tp->UID = 23432;
$tp->ParentPost = 0;
$tp->Title = "This is the title";
$tp->Message = "Here is a message";
$tp->PostTime = "12/1/2015";
$tp->MainPostImage = 2432;
$tp->FirstName = "Tom";
$tp->LastName = "Smith";

echo '<textarea rows="3" cols="80">';
echo $tp->getXML();
echo '</textarea><br/>';


echo '<hr/>';
echo '<h2>Test TravelImage</h2>';
 
$ti = new TravelImage(TravelImage::getFieldNames(), false);
$ti->ImageID = 1  ;
$ti->Title = "Edworthy Park";
$ti->Description = "Here is a message";
$ti->Latitude = 51.061249;
$ti->Longitude = -114.158077;
$ti->CityCode = "5913490";
$ti->CountryCodeISO = "CA";

echo '<textarea rows="4" cols="80">';
echo $ti->getXML();
echo '</textarea><br/>';


?>
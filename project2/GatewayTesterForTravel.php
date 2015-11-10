<?php
require_once('includes/travel-setup.inc.php');
?>
<html>
<body>
<h1> Table Gateways Tester </h1>
<?php

echo '<hr/>';
echo '<h2>Test ContinentTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new ContinentTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo $row->ContinentCode . " - " . $row->ContinentName . "<br/>";
}

echo '<hr/>';
echo '<h2>Test CountryTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new CountryTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo $row->ISO . " - " . $row->CountryName . "<br/>";
}

echo "<h3>Test findAll('Continent,Population DESC')</h3>";
$gate = new CountryTableGateway($dbAdapter);
$result = $gate->findAll('Continent,Population DESC');
foreach ($result as $row)
{
   echo $row->ISO3 . " - " . $row->CountryName . " - " . $row->Capital . "<br/>";
}

echo '<h3>Test findById("CA")</h3>';
$result = $gate->findById('CA');
echo $result->ISO . " - " . $result->CountryName . " - " . $result->Population . " - " . $result->TopLevelDomain . "<br/>";

echo '<h3>Test getCountriesWithImages()</h3>';
$result = $gate->findCountriesWithImages();
foreach ($result as $row)
{
   echo $row->ISO . " - ";
   echo $row->CountryName . " - ";
   echo $row->Population . " - ";
   echo $row->Continent . "<br/>";
}


echo '<h2>Test CityTableGateway</h2>';
echo '<h3>Test findBy(x,y)</h3>';
$gate = new CityTableGateway($dbAdapter);
$result = $gate->findBy('CountryCodeISO =? and Population>?', Array('CA',200000), 'Population DESC');
foreach ($result as $row)
{
   echo $row->AsciiName . " - " . $row->Population . "<br/>";
}

echo '<h3>Test getCitiesWithImages()</h3>';
$result = $gate->findCitiesWithImages();
foreach ($result as $row)
{
   echo $row->GeoNameID . " - ";
   echo $row->AsciiName . " - ";
   echo $row->Population . " - ";
   echo $row->CountryCodeISO . "<br/>";
}
      
echo '<hr/>';
echo '<h2>Test TravelImageTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new TravelImageTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo '<img src="images/travel/large/' . $row->Path . '">';
   echo '<img src="images/travel/medium/' . $row->Path . '">';
   echo '<img src="images/travel/small/' . $row->Path . '">';
   echo '<img src="images/travel/thumb/' . $row->Path . '">';   
   echo '<img src="images/travel/square/' . $row->Path . '">';
   echo '<img src="images/travel/square-small/' . $row->Path . '">';
   echo '<img src="images/travel/square-tiny/' . $row->Path . '">';
   echo $row->ImageID . " - " . $row->Title . " - " . $row->CountryCodeISO ."<br/>";
} 
echo '<h3>Test findForPost(7)</h3>';
$result = $gate->findForPost(7);
foreach ($result as $row)
{
   echo '<br><img src="images/travel/square/' . $row->Path . '">';
   echo $row->ImageID . " - " . $row->Title . " - " . $row->CountryCodeISO ."<br/>";
} 
echo '<h3>Test findForUser(27)</h3>';
$result = $gate->findForUser(27);
foreach ($result as $row)
{
   echo '<br><img src="images/travel/square/' . $row->Path . '">';
   echo $row->ImageID . " - " . $row->Title . " - " . $row->CountryCodeISO ."<br/>";
} 

echo '<hr/>';
echo '<h2>Test TravelUserTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new TravelUserTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo $row->UID . " - " . $row->UserName . " - " . $row->LastName . " - " . $row->Address ."<br/>";
} 

echo '<hr/>';
echo '<h2>Test TravelPostTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new TravelPostTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
   echo $row->PostID . " - " . $row->UID . " - " . $row->Title . " - " . $row->PostTime ."<br/>";
} 

echo '<h3>Test findForUser(5)</h3>';
$gate = new TravelPostTableGateway($dbAdapter);
$result = $gate->findForUser(5);
foreach ($result as $row)
{
   echo $row->PostID . " - " . $row->UID . " - " . $row->Title . " - " . $row->PostTime ."<br/>";
} 

echo '<hr/>';
echo '<h2>Test TravelImageRatingTableGateway</h2>';
echo '<h3>Test findAll()</h3>';
$gate = new TravelImageRatingTableGateway($dbAdapter);
$result = $gate->findAll();
foreach ($result as $row)
{
	echo $row->ImageRatingID . " - " . $row->ImageID . " - " . $row->Rating  ."<br/>";
   //echo $row->TravelImageID . " - " . $row->ImageID . " - " . $row->Rating  ."<br/>";
} 
echo '<h3>Test findforImage(5)</h3>';
$result = $gate->findforImage(5);
foreach ($result as $row)
{
   echo $row->ImageRatingID . " - " . $row->ImageID . " - " . $row->Rating  ."<br/>";
   //echo $row->TravelImageID . " - " . $row->ImageID . " - " . $row->Rating  ."<br/>";
} 
echo '<h3>Test averageForImage(5)</h3>';
$result = $gate->averageForImage(5);
echo 'Average = ' . $result;
 
      
$dbAdapter->closeConnection();

?>
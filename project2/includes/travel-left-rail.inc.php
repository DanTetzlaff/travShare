<?php

$countryGate = new CountryTableGateway($dbAdapter);
$countries = $countryGate->findCountriesWithImages();

$continentGate = new ContinentTableGateway($dbAdapter);
$continents = $continentGate->findAllSorted(true);

?>
<!--
<div class="panel panel-default">
  <div class="panel-heading">Search</div>
  <div class="panel-body">
    <form>
      <div class="input-group">
         <input type="text" class="form-control" placeholder="search ...">
         <span class="input-group-btn">
           <button class="btn btn-warning" type="button"><span class="glyphicon glyphicon-search"></span>          
           </button>
         </span>
      </div>  
    </form>
  </div>
</div>  <!-- end search panel -->       

<div class="panel panel-default">
  <div class="panel-heading">Continents</div>
  <ul class="list-group">   
     <?php
      foreach ($continents as $cont) {
         echo '<a href="#" class="list-group-item">' . $cont->ContinentName . '</a>';
      }
     ?>

  </ul>
</div>  <!-- end continents panel -->  
<div class="panel panel-default">
  <div class="panel-heading">Popular Countries</div>
  <ul class="list-group">  
     <?php
      foreach ($countries as $country) {
         echo '<a href="single-country.php?cId=' . $country->ISO . '" class="list-group-item">' . $country->CountryName . '</a>';
      }
     ?>

  </ul>
</div>  <!-- end countries panel -->    

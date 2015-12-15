<?php
/*
  Table Data Gateway for the websitevisits table.
 */
class VisitTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "Visit";
   } 
   protected function getTableName()
   {
      return "websitevisits";
   }
   protected function getOrderFields() 
   {
      return 'id';
   }
  
   protected function getPrimaryKeyName() {
      return "id";
   }
	
	//Select number of visits on a given day
      public function countVisitsForDate($givenDate)
   {
      $sql = "SELECT count(id) AS num FROM websitevisits WHERE dateViewed = '$givenDate' ";  
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }
   
   //Number of visits per country for the first 6 months of the year 
      public function countSixMonths()
   {
      $sql = "SELECT count(id) AS num, CountryName FROM websitevisits JOIN geocountries ON websitevisits.countryCode=geocountries.ISO WHERE dateViewed between '2015-01-01' AND '2015-06-30' GROUP BY countryCode HAVING count(id) > 4;"; 
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }
   
   //Select countries with over 50 visits for the dropdown lists
      public function dropdownCountries()
   {
      $sql = "SELECT CountryName, countryCode FROM websitevisits JOIN geocountries ON websitevisits.countryCode=geocountries.ISO GROUP BY CountryName HAVING count(id) > 50;"; 
      
      $result = $this->dbAdapter->fetchAsArray($sql, null);      
      return $this->convertRecordsToObjects($result);         
   }

}

?>
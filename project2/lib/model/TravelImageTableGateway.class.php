<?php
/*
  Table Data Gateway for the TravelImage table.
 */
class TravelImageTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelImage";
   } 
   protected function getTableName()
   {
      return "TravelImage";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
  
   protected function getPrimaryKeyName() {
      return "ImageID";
   }

   // must override this
   protected function getSelectStatement()
   {
      return $this->getSQLwithJoins();
   }   
   
   // must override this
   public function findById($id)
   {
      $sql = $this->getSQLwithJoins() . ' WHERE TravelImageDetails.ImageID=:id';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }    
   
   private function getSQLwithJoins()
   {
      $SQLwithJoins = "SELECT TravelImageDetails.ImageID as ImageID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, UID, Path FROM TravelImage INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID ";  
      
      return $SQLwithJoins;
   }
   
   public function findForPost($postID)
   {      
      $sql = "SELECT TravelImage.ImageID as ImageID,Title,Description,Latitude, Longitude, CityCode, CountryCodeISO, UID, Path FROM  (TravelImage INNER JOIN TravelPostImages ON TravelImage.ImageID = TravelPostImages.ImageID) INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID";
      
      $sql .= " WHERE PostID=?";
      $result = $this->dbAdapter->fetchAsArray($sql, Array($postID));   
      return $this->convertRecordsToObjects($result);   
   }
   
   public function findForUser($userID)
   {      
      //$sql = "SELECT TravelImage.ImageID as ImageID,Title,Description,Latitude, Longitude, CityCode, CountryCodeISO, UID, Path FROM  (TravelImage INNER JOIN TravelPostImages ON TravelImage.ImageID = TravelPostImages.ImageID) INNER JOIN TravelImageDetails ON TravelImage.ImageID = TravelImageDetails.ImageID";
      
      $sql = $this->getSQLwithJoins();
      $sql .= " WHERE UID=?";
      $result = $this->dbAdapter->fetchAsArray($sql, Array($userID));   
      return $this->convertRecordsToObjects($result);   
   }   
   
   public function findForCountry($countryID)
	{
		$sql = $this->getSQLwithJoins();
		$sql .= " WHERE CountryCodeISO=?";
		$result = $this->dbAdapter->fetchAsArray($sql, Array($countryID));
		return $this->convertRecordsToObjects($result);
	}
	
	public function findForSearch($phrase)
	{
		$sql = "SELECT TravelImage.ImageID, Title, Path FROM TravelImageDetails INNER JOIN TravelImage ON TravelImage.ImageID = TravelImageDetails.ImageID WHERE Title LIKE '%$phrase%' OR Description LIKE '%$phrase%';";
		$result = $this->dbAdapter->fetchAsArray($sql, Array());
		return $this->convertRecordsToObjects($result);
	}
}

?>

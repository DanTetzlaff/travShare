<?php
/*
  Table Data Gateway for the TravelPostImages table.
 */
class TravelPostImagesTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelPostImages";
   } 
   protected function getTableName()
   {
      return "TravelPostImages";
   }
   protected function getOrderFields() 
   {
      return 'ImageID';
   }
  
   protected function getPrimaryKeyName() {
      return "PostID";
   }

      protected function getSelect()
   {
      $sql = "SELECT PostID, ImageID FROM TravelPostImages";
	  
	  return $sql;
   }   
   
   // must override this
   public function findById($id)
   {
      $sql = $this->getSelect();
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }   

}

?>
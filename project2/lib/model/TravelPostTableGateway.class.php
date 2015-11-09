<?php
/*
  Table Data Gateway for the TravelPost table.
 */
class TravelPostTableGateway extends TableDataGateway
{    
   public function __construct($dbAdapter) 
   {
      parent::__construct($dbAdapter);
   }
  
   protected function getDomainObjectClassName()  
   {
      return "TravelPost";
   } 
   protected function getTableName()
   {
      return "TravelPost";
   }
   protected function getOrderFields() 
   {
      return 'PostID';
   }
  
   protected function getPrimaryKeyName() {
      return "PostID";
   }   
   
   public function getSelectStatement()
   {
		$sql = $this->getSQL();
		$sql .= "GROUP BY TravelPost.PostID";
		
		return $sql;
   }
   
   public function getSQL()
   {
    $sql = "SELECT TravelPost.PostID, PostTime, Title, UID, ParentPost, Message, ImageID as MainPostImage FROM TravelPost INNER JOIN TravelPostImages ON TravelPost.PostID = TravelPostImages.PostID ";
	
	return $sql;
   }
   
   public function findForUser($userId)
   {
	
	  $sql = $this -> getSQL();
      $sql .= " WHERE UID=?";
	  $sql .= "GROUP BY TravelPost.PostID";
      $result = $this->dbAdapter->fetchAsArray($sql, Array($userId));   
      return $this->convertRecordsToObjects($result); 
   }
   
   // must override this
   public function findById($id)
   {
      $sql = $this->getSQL() . ' WHERE TravelPost.PostID=:id';
      return $this->convertRowToObject($this->dbAdapter->fetchRow($sql, Array(':id' => $id)) );
   }   

}

?>
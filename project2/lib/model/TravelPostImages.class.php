<?php
/*
   Represents a single row for the TravelPostImages table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelPostImages extends DomainObject
{  
   
   static function getFieldNames() {
      return array('PostID', 'ImageID');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>
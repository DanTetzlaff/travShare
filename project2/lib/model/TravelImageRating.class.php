<?php
/*
   Represents a single row for the TravelImageRating table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelImageRating extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ImageRatingID', 'ImageID', 'Rating');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>
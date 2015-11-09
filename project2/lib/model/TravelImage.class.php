<?php
/*
   Represents a single row for the TravelImage table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class TravelImage extends DomainObject
{  
   
   static function getFieldNames() {
      return array('ImageID', 'Path', 'UID', 'ImageContent', 'CityCode', 'CountryCodeISO', 'Description', 'Latitude', 'Longitude', 'Title', 'ImageLocationID', 'LocationName');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>
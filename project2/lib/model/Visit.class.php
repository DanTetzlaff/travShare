<?php
/*
   Represents a single row for the websitevisits table. 
   
   This a concrete implementation of the Domain Model pattern.
 */
class Visit extends DomainObject
{  
   
   static function getFieldNames() {
      return array('id','dateViewed','ip_address','countryCode');
   }

   public function __construct(array $data, $generateExc)
   {
      parent::__construct($data, $generateExc);
   }
   
   // implement any setters that need input checking/validation
}

?>
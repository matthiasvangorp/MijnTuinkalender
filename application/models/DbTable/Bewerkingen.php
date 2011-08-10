<?php

class Application_Model_DbTable_Bewerkingen extends Zend_Db_Table_Abstract
{

    protected $_name = 'bewerkingen';
    
    public function getBewerking($bewerkingID){
    	$bewerkingID = (int)$bewerkingID;
 		$row = $this->fetchRow('bewerkingID = '.$bewerkingID);
		if (!$row){
			throw new Exception("Rij $row niet gevonden");
		}
		return $row->toArray();   	
    }
    

}


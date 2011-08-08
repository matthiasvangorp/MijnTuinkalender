<?php

class Application_Model_DbTable_Bewerkingen extends Zend_Db_Table_Abstract
{

    protected $_name = 'bewerkingen	';

	public function getBewerking($bewerkingID){
		$bewerkingID = (int)$bewerkingID;
		$row = $this->fetchRow('bewerkingID = '.$bewerkingID);
		if (!$row){
			throw new Exception("Rij $row niet gevonden");
		}
		return $row->toArray();
	}
	
	public function addBewerking($bewerking){
		$data = array('bewerking'=>$bewerking);
		$this->insert($data);
	}
	
	public function updateBewerking($bewerkingID, $bewerking){
		$bewerkingID = (int)$bewerkingID;
		$data = array('bewerking'=>$bewerking);
		$this->update($data, 'bewerkingID = '.$bewerkingID);
	}
	
	public function deleteBewerking($bewerkingID){
		$bewerkingID = (int)$bewerkingID;
		$this->delete('bewerkingID = '.$bewerkingID);
	}
}


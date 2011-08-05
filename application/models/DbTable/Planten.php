<?php

class Application_Model_DbTable_Planten extends Zend_Db_Table_Abstract
{

    protected $_name = 'planten';

	public function getPlant($plantID){
		$plantID = (int)$plantID;
		$row = $this->fetchRow('plantID = '.$plantID);
		if (!$row){
			throw new Exception("Rij $row niet gevonden");
		}
		return $row->toArray();
	}
	
	public function addPlant($naam, $beschrijving, $kiemingsduur, $teeltduur, $begieten, $opbrengst, $afbeelding){
		$data = array('naam'=>$naam, 'beschrijving'=>$beschrijving, 'kiemingsduur' =>$kiemingsduur, 
					'teeltduur' => $teeltduur, 'begieten'=> $begieten, 'opbrengst'=>$opbrengst, 'afbeelding'=>$afbeelding);
		$this->insert($data);
	}
	
	public function updatePlant($plantID, $naam, $beschrijving, $kiemingsduur, $teeltduur, $begieten, $opbrengst, $afbeelding){
		$plantID = (int)$plantID;
		$data = array('naam'=>$naam, 'beschrijving'=>$beschrijving, 'kiemingsduur' =>$kiemingsduur, 
				'teeltduur' => $teeltduur, 'begieten'=> $begieten, 'opbrengst'=>$opbrengst, 'afbeelding'=>$afbeelding);
		$this->update($data, 'plantID = '.$plantID);
	}
	
	public function deletePlant($plantID){
		$plantID = (int)$plantID;
		$this->delete('plantID = '.$plantID);
	}
}


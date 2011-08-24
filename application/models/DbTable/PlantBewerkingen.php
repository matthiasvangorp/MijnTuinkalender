<?php

class Application_Model_DbTable_PlantBewerkingen extends Zend_Db_Table_Abstract
{

    protected $_name = 'plantbewerkingen';
    
    public function getPlantBewerking($plantID, $bewerkingID){
    	$plantID = (int)$plantID;
    	$bewerkingID = (int)$bewerkingID;
    	$row = $this->fetchRow('plantID = '.$plantID.' and bewerkingID = ' .$bewerkingID);
    	if (!$row){
			throw new Exception("Rij $row niet gevonden");
		}   
		return $row->toArray(); 	
    }
    
    public function addPlantBewerking($plantID, $bewerkingID, $beschrijving, $afbeelding, $van, $tot){
    	$plantID = (int)$plantID;
    	$bewerkingID = (int)$bewerkingID;
		$data = array('plantID'=>$plantID, 'bewerkingID'=>$bewerkingID,  'beschrijving' =>$beschrijving,
					'afbeelding' => $afbeelding, 'van'=>$van, 'tot'=>$tot);
		$this->insert($data);    
    }

    public function updatePlantBewerking($plantID, $bewerkingID, $beschrijving, $afbeelding, $van, $tot){
    	$plantID = (int)$plantID;
    	$bewerkingID =(int)$bewerkingID;
 		$data = array('beschrijving' =>$beschrijving, 'afbeelding' => $afbeelding, 'van'=>$van, 'tot'=>$tot);
 		$this->update($data,'plantID = '.$plantID.' and bewerkingID = ' .$bewerkingID );  		  	
    }
    
    public function deletePlantBewerking($plantID, $bewerkingID){
    	$plantID = (int)$plantID;
    	$bewerkingID = (int)$bewerkingID;
    	$this->delete('plantID = '.$plantID.' and bewerkingID = ' .$bewerkingID );
    }
    
    
    public function GetPlantBewerkingenByPlantID($plantID, $inornotin = 'in'){
		$db = Zend_Db_Table_Abstract::getDefaultAdapter();
		$sql = sprintf("select * from bewerkingen where bewerkingID $inornotin (select bewerkingID from plantbewerkingen where plantID = %s)", $plantID);
		//echo "sql : $sql <br/>";
		$results = $db->fetchAll($sql);
		print_r($results);
		return $results;
    }

}


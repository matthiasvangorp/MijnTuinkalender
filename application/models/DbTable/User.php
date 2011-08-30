<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

	public function getUser($userID){
		$userID = (int)$userID;
		$row = $this->fetchRow('userID = '.$userID);
		if (!$row){
			throw new Exception("Rij $row niet gevonden");
		}
		return $row->toArray();
	}
	
	public function addUser($firstname, $lastname, $email, $password, $active){
		$data = array('firstname'=>$firstname, 'lastname'=>$lastname, 'email' =>$email, 
					'password' => $password, 'active'=> $active);
		$this->insert($data);
	}
	
	public function updateUser($userID, $firstname, $lastname, $email, $password, $active){
		$userID = (int)$userID;
		$data = array('firstname'=>$firstname, 'lastname'=>$lastname, 'email' =>$email, 
				'password' => $password, 'active'=> $active);
		$this->update($data, 'userID = '.$userID);
	}
	
	public function deletePlant($userID){
		$userID = (int)$userID;
		$this->delete('userID = '.$userID);
	}
}


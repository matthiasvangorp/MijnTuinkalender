<?php
class Zend_View_Helper_LoggedInAs extends Zend_View_Helper_Abstract{
	public function loggedInAs(){
		$auth = Zend_Auth::getInstance();
		if ($auth->hasIdentity()){
			$firstname = $auth->getIdentity()->firstname;
			 $logoutUrl = $this->view->url(array('controller'=>'index',
                'action'=>'logout'), null, true);
			return 'Welkom, '.ucfirst($firstname).'<br/> <a href="'.$logoutUrl.'">Afmelden</a>';
		}
		else return FALSE;	
	}
}
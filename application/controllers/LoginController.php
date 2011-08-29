<?php
class LoginController extends Zend_Controller_Action{
	public function getForm(){
		return new LoginForm(array('action'=>'/login/process', 'method'=>'post'));
	}
	
	public function getAuthAdapter(array $params){
		//here comes the authentication
	}
	
	public function preDispatch(){
		if (Zend_Auth::getInstance()->hasIdentity()){
			//if the user is logged in, we don't want to show the login form;
			//however, the logout action should still be available
			if ('logout' != $this->getRequest()->getActionName()){
				$this->_helper->redirector('index', 'index');
			}
		}else {
			//if they aren't, they can't log out, so that action should redirect
			//to the loginform
			if ('logout' == $this->getRequest()->getActionName()){
				$this->_helper->redirector('index');
			}
		}
		
		
	}
}
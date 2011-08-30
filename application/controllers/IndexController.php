<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $this->view->loginForm = new Application_Form_Login();
    }
    
    public function registrationAction()
    {
    	$form = new Application_Form_Registration();
    	$form->setDefaultTranslator(Zend_Registry::get('translator'));
    	
    	
    	$this->layout = new Application_Form_RegistratioN();
    	$this->view->registrationForm = $form;
       	if ($this->getRequest()->isPost()){		    
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){
    			$firstname = $form->getValue('firstname');
    			$lastname = $form->getValue('lastname');
    			$email = $form->getValue('email');
    			$password = md5($form->getValue('password'));
				$user = new Application_Model_DbTable_User();
				$user->addUser($firstname, $lastname, $email, $password, 'N');
    			//$this->_helper->redirector('controller'=>'index', 'action'=>'registration');
    		}   
        }	
    	
    }
    
    public function loginAction(){
   		if ($this->getRequest()->isPost()){	
   			
   		}	    
    	
    }


}


<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    
    public function registrationAction()
    {
    	$form = new Application_Form_Registration();
    	//$form->setDefaultTranslator(Zend_Registry::get('translator'));
    	
    	
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

    public function indexAction()
    {
        // action body
        $form = new Application_Form_Login();
        $this->view->loginForm = $form;
    	if ($this->getRequest()->isPost()){	
   			$post = $this->getRequest()->getPost(); 
   			//print_r($post);
   			//die();
   			if ($post['login'] == 'Aanmelden'){
				if ($this->_processLogin($post)){
					$this->_helper->redirector('index', 'index');
				}
   			}
   		}	       
    }
    
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }
    
    
    protected function _processLogin($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['email']); 
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }
    
    protected function _getAuthAdapter(){
    	$dbAdapter = Zend_Db_Table::getDefaultAdapter();
    	$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
    	
    	$authAdapter->setTableName('user')
    		->setIdentityColumn('email')
    		->setCredentialColumn('password')
    		->setCredentialTreatment( 'MD5(?)');
    	
    	return $authAdapter;
    }


}


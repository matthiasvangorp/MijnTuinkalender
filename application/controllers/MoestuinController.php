<?php

class MoestuinController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }


    public function indexAction()
    {
        // action body
        $planten = new Application_Model_DbTable_Planten();
        $this->view->planten = $planten->fetchAll($planten->select()->order('naam ASC'));
               
    }
    
    public function detailAction(){
    	$plantID = $this->_getParam('plantID', 0);
    	
    	$plant = new Application_Model_DbTable_Planten();
    	$this->view->plant = $plant->getPlant($plantID);
    	
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


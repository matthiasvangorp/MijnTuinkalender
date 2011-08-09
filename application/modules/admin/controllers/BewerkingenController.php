<?php

class Admin_BewerkingenController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$bewerkingen = new Application_Model_DbTable_Bewerkingen();
    	$this->view->bewerkingen = $bewerkingen->fetchAll();
    }
    
   
}


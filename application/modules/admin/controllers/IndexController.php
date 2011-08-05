<?php

class Admin_IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
        $planten = new Application_Model_DbTable_Planten();
        $this->view->planten = $planten->fetchAll();
        
    }
    
    public function addAction(){
    	$form = new Application_Form_Plant();
    	$form->submit->setLabel('Toevoegen');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()){
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){
    			$naam = $form->getValue('naam');
    			$beschrijving = $form->getValue('beschrijving');
    			$kiemingsduur = $form->getValue('kiemingsduur');
    			$teeltduur = $form->getValue('teeltduur');
    			$begieten = $form->getValue('begieten');
    			$opbrengst = $form->getValue('opbrengst');
    			$afbeelding = $form->getValue('afbeelding');
				//$afbeeldingLocatie = $form->file->getFileName();
				echo "$afbeelding";

				Zend_Debug::dump($afbeelding, '$afbeelding');
				echo "done";
				exit();
    			$planten = new Application_Model_DbTable_Planten();
    			$planten->addPlant($naam, $beschrijving, $kiemingsduur, $teeltduur, $begieten, $opbrengst, $afbeelding);
    			$this->_helper->redirector('index');
    		}
    		else {
    			$form->populate($formData);
    		}
    	}
    }
    
    public function editAction($plantID){
    	$form = new Application_Form_Plant();
    	$form->submit->setLabel('Opslaan');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()){
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){
    			$plantID = $form->getValue('plantID');
      			$naam = $form->getValue('naam');
    			$beschrijving = $form->getValue('beschrijving');
    			$kiemingsduur = $form->getValue('kiemingsduur');
    			$teeltduur = $form->getValue('teeltduur');
    			$begieten = $form->getValue('begieten');
    			$opbrengst = $form->getValue('opbrengst');
    			$afbeelding = $form->getValue('afbeelding');
    			$planten = new Application_Model_DbTable_Planten();
    			$planten->updatePlant($plantID, $naam, $beschrijving, $kiemingsduur, $teeltduur, $begieten, $opbrengst, $afbeelding);
    			
    			$this->_helper->redirector('index');
    			
    		}
    		else{
    			$form->populate($formData);
    		}
    		
    	}
    	else {
    		$plantID = $this->_getParam('plantID', 0);
    		if ($plantID >0){
    			$planten = new Application_Model_DbTable_Planten();
    			 $this->view->planten = $planten->getPlant($plantID);
    			$form->populate($planten->getPlant($plantID));
    		}
    	}
    	
    }
    
	  public function deleteAction()
		 {
	        if ($this->getRequest()->isPost()) {
	            $del = $this->getRequest()->getPost('del');
	            if ($del == 'y') {
	                $plantID = $this->getRequest()->getPost('plantID');
	                $planten = new Application_Model_DbTable_Planten();
	                $planten->deletePlant($plantID);
				}
		        $this->_helper->redirector('index');
	        } 
	        
	        else {
	            $plantID = $this->_getParam('plantID', 0);
	            $planten = new Application_Model_DbTable_Planten();
	            $this->view->planten = $planten->getPlant($plantID);
			}
		}


}


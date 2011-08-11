<?php

class Admin_PlantBewerkingenController extends Zend_Controller_Action
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
    	$date_format = "YYYY-MM-dd"; 
    	$date_functions = new Custom_dateFunctions();
		$plantID = $this->getRequest()->getParam('plantID');
		$formData = array( 'plantID'=> $plantID);
    	$form = new Application_Form_PlantBewerkingen();
    	$form->submit->setLabel('Toevoegen');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()){
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){
    			$plantID = $form->getValue('plantID');
    			$bewerkingID = $form->getValue('bewerking');
    			$beschrijving = $form->getValue('beschrijving');
    			$afbeelding = $form->getValue('afbeelding');
    			
    			$van = $form->getValue('van');
    			//echo "van : $van<br/>";
    			$van = $date_functions->dateToMysql($van);
    			//echo "van : $van<br/>";
    			//$van->toString($date_format);
    			//echo "van : $van <br/>";
    			//die();
    			$tot = $form->getValue('tot');
    			$tot = $date_functions->dateToMysql($tot);
    			$plantenBewerkingen = new Application_Model_DbTable_PlantBewerkingen();
    			$plantenBewerkingen->addPlantBewerking($plantID, $bewerkingID, $beschrijving, $afbeelding, $van, $tot);
    			$this->_helper->redirector('index');
    		}
    		else {
    			$form->populate($formData);
    		}
    	
    	}
    	else {
    		$form->populate($formData);
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


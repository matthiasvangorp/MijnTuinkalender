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
    	$custom_functions = new Custom_customFunctions();
		$plantID = $this->getRequest()->getParam('plantID');
		$formData = array( 'plantID'=> $plantID);
    	$form = new Application_Form_PlantBewerkingen();
    	$form->submit->setLabel('Toevoegen');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()){
    		//rename image 
		    $originalFilename = pathinfo($form->afbeelding->getFileName());
		    $newFilename = 'file-' . uniqid() . '.' . $originalFilename['extension'];
		    $form->afbeelding->addFilter('Rename', $newFilename);
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){

    			
    			
    			$plantID = $form->getValue('plantID');
    			$bewerkingID = $form->getValue('bewerking');
    			$beschrijving = $form->getValue('beschrijving');
    			$afbeelding = $form->getValue('afbeelding');
						
    			$van = $form->getValue('van');
    			$van = $custom_functions->dateToMysql($van);
    			$tot = $form->getValue('tot');
    			$tot = $custom_functions->dateToMysql($tot);
    			$plantenBewerkingen = new Application_Model_DbTable_PlantBewerkingen();
    			$plantenBewerkingen->addPlantBewerking($plantID, $bewerkingID, $beschrijving, $afbeelding, $van, $tot);
    			 
    			$form->reset();
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
    	$date_functions = new Custom_customFunctions();
    	$form = new Application_Form_PlantBewerkingen();
    	$form->submit->setLabel('Opslaan');
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()){
    		
     		//rename image 
		    $originalFilename = pathinfo($form->afbeelding->getFileName());
		    $newFilename = 'file-' . uniqid() . '.' . $originalFilename['extension'];
		    $form->afbeelding->addFilter('Rename', $newFilename);
		    
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)){
    			$currentMicroTime = $date_functions->getMicroTime();
    			$filename = $currentMicroTime;
    			$FullFilename = 'images/'.$filename;
    			echo "filename : $FullFilename";
    			die();
    			$filterRename = new Zend_Filter_File_Rename(array('target' => $FullFilename, 'overwrite'=>TRUE));
    			
    			
    			$plantID = $form->getValue('plantID');
      			$bewerkingID = $form->getValue('bewerkingID');
    			$beschrijving = $form->getValue('beschrijving');
    			$afbeelding = $form->getValue('afbeelding');
    			//rename image
    			$van = $form->getValue('van');
    			$van = $date_functions->dateToMysql($van);
    			$tot = $form->getValue('tot');
    			$tot = $date_functions->dateToMysql($tot);
    			$plantenBewerkingen = new Application_Model_DbTable_PlantBewerkingen();
    			$plantenBewerkingen->updatePlantBewerking($plantID, $bewerkingID, $beschrijving, $afbeelding, $van ,$tot);
    			$this->_helper->redirector('index');
    			
    		}
    		else{
    			$form->populate($formData);
    		}
    		
    	}
    	else {
    		$plantID = $this->_getParam('plantID', 0);
    		$bewerkingID = $this->_getParam('bewerkingID', 0);
    		if ($plantID >0 && $bewerkingID > 0){
    			$plantenBewerkingen = new Application_Model_DbTable_PlantBewerkingen();
    			$this->view->plantenBewerkingen = $plantenBewerkingen->getPlantBewerking($plantID, $bewerkingID);
    			$form->populate($plantenBewerkingen->getPlantBewerking($plantID, $bewerkingID));
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


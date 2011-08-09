<?php

class Application_Form_PlantBewerkingen extends Zend_Form
{

public function __construct($options = null){
		parent::__construct($options);
		$this->setName('plantbewerking');
		$this->setAttrib('enctype', 'multipart/form-data');
		
		$allowed_tags = array(
			'a' =>	array('href', 'title'),
			'strong',
			'img'	=>	array('src', 'alt'),
			'ul',
			'ol',
			'li',
			'em',
			'u',
			'strike');
		
		$bewerkingen = new Application_Model_DbTable_Bewerkingen();
		$bewerkingen = $bewerkingen->fetchAll();
	
		
        $plantID = new Zend_Form_Element_Hidden('plantID');
        $plantID->addFilter('Int');
        $bewerkingID = new Zend_Form_Element_Hidden('bewerkingID');
        $bewerkingID->addFilter('Int');
        $bewerking = new Zend_Form_Element_Select('bewerking');
        $bewerking->setLabel('Bewerking');
        	foreach($bewerkingen as $b){
        			$bewerking->addMultiOption($b->bewerkingID, $b->bewerking);
        	}
        	
        	
        $beschrijving = new Zend_Form_Element_Textarea('beschrijving');
        $beschrijving->setLabel('Beschrijving')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addFilter('Striptags', $allowed_tags)
              ->addValidator('NotEmpty');
        $afbeelding = new Zend_Form_Element_File('afbeelding');
        $basis = Zend_Controller_Front::getInstance()->getBaseUrl();
        //die();
        $afbeelding->setLabel('Afbeelding')
       			 ->setDestination('images/');
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
		
        $this->addElements(array($plantID, $bewerkingID, $bewerking, $beschrijving, $afbeelding, $submit)); }
		
	}




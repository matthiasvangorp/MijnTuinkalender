<?php

class Application_Form_PlantBewerkingen extends ZendX_JQuery_Form
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
		

		$van = new ZendX_JQuery_Form_Element_DatePicker('van');
        $van->setJQueryParam('dateFormat', 'dd/mm/yy');
        $van->setLabel('Van')
        	->setRequired();
        
 		$tot = new ZendX_JQuery_Form_Element_DatePicker('tot');
        $tot->setJQueryParam('dateFormat', 'dd/mm/yy');
        $tot->setLabel('Tot')
        		->setRequired();
		
		$bewerkingen = new Application_Model_DbTable_Bewerkingen();
		$bewerkingen = $bewerkingen->fetchAll();
        $plantID = new Zend_Form_Element_Hidden('plantID');
        $plantID->addFilter('Int');
        $bewerkingID = new Zend_Form_Element_Select('bewerking');
        $bewerkingID->setLabel('Bewerking');
        	foreach($bewerkingen as $b){
        			$bewerkingID->addMultiOption($b->bewerkingID, $b->bewerking);
        	}
        	
        //$van = new ZendX_JQuery_Form_Element_DatePicker('van', array('jQueryParams'));
	
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
		
        $this->addElements(array($plantID, $bewerkingID, $van, $tot, $beschrijving, $afbeelding, $submit)); }
		
	}




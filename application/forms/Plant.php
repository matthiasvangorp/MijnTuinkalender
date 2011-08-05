<?php
class Application_Form_Plant extends Zend_Form
{
	
	
    public function init()
    {
    	$this->addElementPrefixPath('App', '/images/');
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
	    	
    	
        $this->setName('plant');
        $plantID = new Zend_Form_Element_Hidden('plantID');
        $plantID->addFilter('Int');
        $naam = new Zend_Form_Element_Text('naam');
        $naam->setLabel('Naam')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $beschrijving = new Zend_Form_Element_Textarea('beschrijving');
        $beschrijving->setLabel('Beschrijving')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addFilter('Striptags', $allowed_tags)
              ->addValidator('NotEmpty');
        $kiemingsduur = new Zend_Form_Element_Textarea('kiemingsduur');
        $kiemingsduur->setLabel('Kiemingsduur')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addValidator('NotEmpty');
        $teeltduur = new Zend_Form_Element_Textarea('teeltduur');
        $teeltduur->setLabel('Teeltduur')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addValidator('NotEmpty');
        $begieten = new Zend_Form_Element_Textarea('begieten');
        $begieten->setLabel('Begieten')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addValidator('NotEmpty');
        $opbrengst = new Zend_Form_Element_Textarea('opbrengst');
        $opbrengst->setLabel('Opbrengst')
              ->setRequired(true)
              ->addFilter('StringTrim')
              ->setAttrib('class', 'ckeditor')
              ->addValidator('NotEmpty');
        $afbeelding = new Zend_Form_Element_File('afbeelding');
        $afbeelding->setLabel('Afbeelding');
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
		
        $this->addElements(array($plantID, $naam, $beschrijving, $kiemingsduur,$teeltduur, $begieten, $opbrengst, $afbeelding, $submit)); }
}
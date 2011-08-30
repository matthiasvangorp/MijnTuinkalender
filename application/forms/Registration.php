<?php
class Application_Form_Registration extends Zend_Form{
	public function init(){
		
		//$validator = new Zend_Validate_Db_NoRecordExists();
		//$validator->setMessage("Dit emailadres is al geregistreerd", Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND);
		
		
		
		$firstname = new Zend_Form_Element_Text('firstname');
		$firstname->setLabel('Voornaam:')
				->setRequired(true)->addErrorMessage('Geef uw voornaam in')
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $lastname = new Zend_Form_Element_Text('lastname');
		$lastname->setLabel('Naam:')->addErrorMessage('Geef uw naam in')
				->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email:')
        	->setRequired(true)
			->addFilter('StripTags')
			->addFilter('StringTrim')
           	->addValidator('NotEmpty')
           	->addValidator(new Zend_Validate_Db_NoRecordExists(
                                                        array(
                                                                'adapter'=>Zend_Db_Table_Abstract::getDefaultAdapter(),
                                                                'field'=>'email',
                                                                'table'=>'user'
                                                                )))->addErrorMessage("Dit emailadres is al geregistreerd");
                              
                                                               
               //->addValidator('EmailAddress');
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Wachtwoord:')
        	->addFilter('StripTags')
        	->addValidator('NotEmpty');      
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');         
		
		$this->addElements(array($firstname, $lastname, $email, $password, $submit));
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag'=>'dl', 'class'=>'zend_form')),
		array('Description', array('placement'=>'prepend')),
		'Form'
		));
	}
}
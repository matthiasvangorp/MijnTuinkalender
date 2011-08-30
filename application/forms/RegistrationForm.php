<?php
class Application_Form_RegistrationForm extends Zend_Form{
	public function init(){
		
		
		
		$firstname = new Zend_Form_Element_Text('firstname');
		$firstname->setLabel('Voornaam:')
				->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');
        $lastname = new Zend_Form_Element_Text('lastname');
		$lastname->setLabel('Naam:')
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
                                                                )));
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
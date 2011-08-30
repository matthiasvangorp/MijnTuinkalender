<?php
class Application_Form_Login extends Zend_Form{
	public function init(){
		$this->setMethod('post');
		$this->setName('login');
		$email = $this->addElement('text', 'email', array('filters' =>array('StringTrim', 'StringToLower'), 'validators' =>
		array('Alpha', array('StringLength', false, array(3,20)), ), 'required'=> TRUE, 'label' => 'Email:'));
	
		$password = $this->addElement('password', 'password', array('filters' => array('StringTrim'),
			'validators'=>array('Alnum', array('StringLength', false, array (6,20)),
		),
		'required'=> true,
		'label' => 'Wachtwoord: ',
		));
		
		$login = $this->addElement('submit', 'login', array('required'=>false, 'ignore'=>true, 'label'=>'Aanmelden', ));
		
		//$formID = $this->addElement('hidden', 'formID', array('value'=>'loginForm'));
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag'=>'dl', 'class'=>'zend_form')),
		array('Description', array('placement'=>'prepend')),
		'Form'
		));
	}
}
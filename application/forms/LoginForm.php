<?php
class Application_Form_LoginForm extends Zend_Form{
	public function init(){
		$username = $this->addElement('text', 'username', array('filters' =>array('StringTrim', 'StringToLower'), 'validators' =>
		array('Alpha', array('StringLength', false, array(3,20)), ), 'required'=> TRUE, 'label' => 'E-mail:'));
		
		$password = $this->addElement('password', 'password', array('filters' => array('StringTrim'),
			'validators'=>array('Alnum', array('StringLength', false, array (6,20)),
		),
		'required'=> true,
		'label' => 'Wachtwoord: ',
		));
		
		$login = $this->addElement('submit', 'login', array('required'=>false, 'ignore'=>true, 'label'=>'Aanmelden', ));
		
		$this->setDecorators(array('FormElements', array('HtmlTag', array('tag'=>'dl', 'class'=>'zend_form')),
		array('Description', array('placement'=>'prepend')),
		'Form'
		));
	}
}
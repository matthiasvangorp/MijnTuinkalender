<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	
	protected function _initAppAutoload()
	{
		$db = new Zend_Db_Adapter_Pdo_Mysql(array( 'host' => '127.0.0.1', 'username' => 'root', 'password' => 'root', 'dbname' => 'tuinkalender'));

		Zend_Registry::set('database', $db);
		
		$translator = new Zend_Translate(
		    'array',
		    APPLICATION_PATH.'/../public/resources/languages/',
		    'nl',
		    array('scan' => Zend_Translate::LOCALE_DIRECTORY)
		);
		Zend_Validate_Abstract::setDefaultTranslator($translator);
		Zend_Registry::set('translator', $translator);


	    $autoloader = new Zend_Application_Module_Autoloader(array(
	        'namespace' => 'App',
	        'basePath' => dirname(__FILE__),
	    ));
	    return $autoloader;
	    
	   
	}
	
	protected function _initLayoutHelper()
	{
	    $this->bootstrap('frontController');
	    $layout = Zend_Controller_Action_HelperBroker::addHelper(
	        new Amz_Controller_Action_Helper_LayoutLoader());

	}
	
	
	public function _initViewHelpers(){

		$view = new Zend_View();
		$view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
		//$view->jQuery()->addStyleSheet(APPLICATION_PATH."/../public/js/jquery/css/ui-lightness/jquery-ui-1.8.15.custom.css");
		$viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
		$viewRenderer->setView($view);
		Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);
	}
	


	
	
	


}



class Amz_Controller_Action_Helper_LayoutLoader
extends Zend_Controller_Action_Helper_Abstract
{

    public function preDispatch()
    {
        $bootstrap = $this->getActionController()
                         ->getInvokeArg('bootstrap');
        $config = $bootstrap->getOptions();
        $module = $this->getRequest()->getModuleName();
        if (isset($config[$module]['resources']['layout']['layout'])) {
            $layoutScript =
                 $config[$module]['resources']['layout']['layout'];
            $this->getActionController()
                 ->getHelper('layout')
                 ->setLayout($layoutScript);
        }
    }
    
}

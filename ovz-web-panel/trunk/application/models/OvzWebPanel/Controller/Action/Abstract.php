<?php
/**
 * Abstract controller action
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
abstract class OvzWebPanel_Controller_Action_Abstract extends Zend_Controller_Action {
	
	/**
	 * Init controller
	 *
	 */
	public function init() {
		$this->_config = Zend_Registry::get('config');
		$this->_session = Zend_Registry::get('session');
		
		$this->view->productName = $this->_config->general->productName;
		$this->view->productVersion = $this->_config->general->productVersion;
	}
	
}

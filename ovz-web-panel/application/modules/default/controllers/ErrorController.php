<?php
/**
 * Errors controller actions
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class ErrorController extends OvzWebPanel_Controller_Action_Simple {
		
	/**
	 * Error handling
	 *
	 */
	public function errorAction() {
		$this->view->pageTitle = "Error";
		
		$errors = $this->_getParam('error_handler');
		
		if ((Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER == $errors->type)
			|| (Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION == $errors->type)
		) {
			$this->_redirect('/');
		}
		
		$this->view->exception = $errors->exception;
	}
		
}
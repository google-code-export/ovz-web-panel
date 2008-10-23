<?php
/**
 * Auth controller actions
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class AuthController extends OvzWebPanel_Controller_Action_Simple {
		
	/**
	 * Login action
	 *
	 */
	public function loginAction() {
		$this->view->pageTitle = "Login";
		
		if ($this->getRequest()->isPost()) {
			$this->_redirect('/admin/dashboard/index');
		}
	}
	
	/**
	 * Logout action
	 *
	 */
	public function logoutAction() {
		$this->_redirect('/login');
	}

}
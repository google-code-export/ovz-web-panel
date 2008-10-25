<?php
/**
 * Auth controller actions
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class AuthController extends OvzWebPanel_Controller_Action_Simple {
		
	/**
	 * Login action
	 *
	 */
	public function loginAction() {
		if ($this->_auth->hasIdentity()) {
			$this->_redirect('/admin/dashboard');
		}
		
		if ($this->_request->isPost()) {
			$userName = $this->_getParam('login', '*');
			$userPassword = $this->_getParam('password');
			
			$this->_authAdapter
				->setIdentity($userName)
				->setCredential(md5($userPassword));
			
			$result = $this->_auth->authenticate($this->_authAdapter);
			
			if ($result->isValid()) {
				$storage = $this->_auth->getStorage();
				$storage->write($this->_authAdapter->getResultRowObject(array(
					'userName',
					'roleId',
				)));
				
				$this->_redirect('/admin/dashboard');
			} else {
				$this->_helper->flashMessenger(implode(' ', $result->getMessages()));
				$this->_redirect('/login');
			}
		}
		
		$this->view->pageTitle = "Login";
		$this->view->error = implode(' ', $this->_helper->flashMessenger->getMessages());
	}
	
	/**
	 * Logout action
	 *
	 */
	public function logoutAction() {
		$this->_auth->clearIdentity();
		$this->_redirect('/login');
	}

}
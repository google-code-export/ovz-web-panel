<?php
/**
 * Default controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class Admin_IndexController extends OvzWebPanel_Controller_Action_Admin {
		
	/**
	 * Default action
	 *
	 */
	public function indexAction() {
		$this->_redirect('/admin/dashboard');
	}

}
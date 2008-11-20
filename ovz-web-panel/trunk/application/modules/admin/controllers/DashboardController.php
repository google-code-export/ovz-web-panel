<?php
/**
 * Dashboard controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_DashboardController extends Owp_Controller_Action_Admin {

	/**
	 * Default action
	 *
	 */
	public function indexAction() {
		$this->view->pageTitle = "Dashboard";
	}
	
}
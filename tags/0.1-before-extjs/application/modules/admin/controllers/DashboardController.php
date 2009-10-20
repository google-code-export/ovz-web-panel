<?php
/**
 * Dashboard controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_DashboardController extends OvzWebPanel_Controller_Action_Admin {
		
	public function indexAction() {
		$this->view->pageTitle = "Dashboard";
	}
			
}
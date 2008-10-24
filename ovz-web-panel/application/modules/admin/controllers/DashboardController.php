<?php
/**
 * Dashboard controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class Admin_DashboardController extends OvzWebPanel_Controller_Action_Admin {
		
	public function indexAction() {
		$this->view->pageTitle = "Dashboard";
	}
			
}
<?php
/**
 * Index controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class IndexController extends OvzWebPanel_Controller_Action_Admin {
		
	public function indexAction() {
		$this->view->pageTitle = 'Dashboard';
	}
			
}
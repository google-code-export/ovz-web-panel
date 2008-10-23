<?php
/**
 * Index controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class IndexController extends OvzWebPanel_Controller_Action_Simple {
		
	public function indexAction() {
		$this->_redirect('/login');
	}
			
}
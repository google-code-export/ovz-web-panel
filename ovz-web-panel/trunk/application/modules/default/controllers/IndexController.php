<?php
/**
 * Index controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class IndexController extends Owp_Controller_Action_Simple {
		
	public function indexAction() {
		$this->_redirect('/login');
	}
			
}
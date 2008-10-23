<?php
/**
 * Simple (by layout) controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
abstract class OvzWebPanel_Controller_Action_Simple extends OvzWebPanel_Controller_Action_Abstract {
	
	/**
	 * Action init
	 *
	 */
	public function init() {
		parent::init();
		
		$this->_helper->layout->setLayout('simple');
	}
		
}

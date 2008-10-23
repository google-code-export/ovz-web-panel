<?php
/**
 * Admin controller
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
abstract class OvzWebPanel_Controller_Action_Admin extends OvzWebPanel_Controller_Action_Abstract {
	
	/**
	 * Action init
	 *
	 */
	public function init() {
		parent::init();
		
		$this->_helper->layout->setLayout('admin');
	}
	
	/**
	 * Post dispatch routines
	 *
	 */
	public function postDispatch() {
		if ($this->_helper->layout->isEnabled()) {
			$this->_generateMenu();
		}
	}
		
	/**
	 * Generate menu
	 *
	 */
	private function _generateMenu() {
		$this->view->menus = Zend_Registry::get('mainMenu');
		
		// render menu
		$response = $this->getResponse();
		$response->insert('menu', $this->view->render('_default/menu.phtml')); 
	}
	
	/**
	 * Add paginator for list
	 *
	 * @param object $select
	 */
	protected function _addPaginator($select) {
		$paginator = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($select));
		$paginator->setCurrentPageNumber($this->_getParam('page'));
		$this->view->paginator = $paginator;
	}
	
}

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
		$this->view->shortcuts = $this->_getShortcutsList();
	}

	/**
	 * Get shortcuts list
	 *
	 */
	private function _getShortcutsList() {
		$shortcuts = new Owp_Table_Shortcuts();
			
		$select = $shortcuts->select();
		$shortcutsData = $shortcuts->fetchAll($select);
		
		$shortcutsJsonData = array();
		
		foreach ($shortcutsData as $shortcutData) {
			$shortcutsJsonData[] = array(
				'id' => $shortcutData->id, 
				'name' => $shortcutData->name,
				'link' => $shortcutData->link,
			);
		}
		
		return Zend_Json::encode($shortcutsJsonData);
	}
	
}
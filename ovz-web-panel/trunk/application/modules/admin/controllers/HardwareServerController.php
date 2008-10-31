<?php
/**
 * HW-nodes controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_HardwareServerController extends OvzWebPanel_Controller_Action_Admin {

	/**
	 * Default action
	 *
	 */
	public function indexAction() {
		$this->_forward('list');
	}

	/**
	 * List of servers
	 *
	 */
	public function listAction() {
		$this->view->pageTitle = "Hardware servers";
		
		$hwServers = new OvzWebPanel_Table_HwServers();
			
		$select = $hwServers->select();
		$hwServersData = $hwServers->fetchAll($select);
		
		$hwServersJsonData = array();
		
		foreach ($hwServersData as $hwServerData) {
			$hwServersJsonData[] = array($hwServerData->id, $hwServerData->hostName);
		}
		
		$this->view->hwServersJsonData = Zend_Json::encode($hwServersJsonData);
	}
	
}
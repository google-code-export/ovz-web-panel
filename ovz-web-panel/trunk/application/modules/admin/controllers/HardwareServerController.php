<?php
/**
 * HW-nodes controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_HardwareServerController extends Owp_Controller_Action_Admin {

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
		
		$hwServers = new Owp_Table_HwServers();
			
		$select = $hwServers->select();
		$hwServersData = $hwServers->fetchAll($select);
		
		$hwServersJsonData = array();
		
		foreach ($hwServersData as $hwServerData) {
			$hwServersJsonData[] = array($hwServerData->id, $hwServerData->hostName);
		}
		
		$this->view->hwServersJsonData = Zend_Json::encode($hwServersJsonData);
	}
	
	/**
	 * Disconnect server
	 *
	 */
	public function deleteAction() {
		$id = $this->_request->getParam('id');
		
		$hwServers = new Owp_Table_HwServers();
		$hwServer = $hwServers->fetchRow($hwServers->select()->where('id = ?', $id));
		
		$hwServer->delete();
		
		$this->_helper->json(array('success' => true));
	}
	
	/**
	 * Connect new server
	 *
	 */
	public function addAction() {
		$hostName = $this->_request->getParam('hostName');
		$authKey = $this->_request->getParam('authKey');
		
		$hwServers = new Owp_Table_HwServers();
		
		$hwServer = $hwServers->createRow();
		$hwServer->hostName = $hostName;
		$hwServer->authKey = $authKey;
		$hwServer->save();
		
		$this->_helper->json(array('success' => true));
	}
	
}
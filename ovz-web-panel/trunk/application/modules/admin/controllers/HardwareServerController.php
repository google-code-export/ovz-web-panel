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
	}
	
	/**
	 * Json data of list of servers
	 *
	 */
	public function listDataAction() {
		$hwServers = new Owp_Table_HwServers();
			
		$select = $hwServers->select();
		$hwServersData = $hwServers->fetchAll($select);
		
		$hwServersJsonData = array();
		
		foreach ($hwServersData as $hwServerData) {
			$hwServersJsonData[] = array('id' => $hwServerData->id, 'hostName' => $hwServerData->hostName);
		}
		
		$this->_helper->json($hwServersJsonData);
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
		
		$virtualServers = new Owp_Table_VirtualServers();
		$vzlistRawData = $hwServer->execDaemonRequest('vzlist -a -H -o veid,hostname,ip,status');
		$vzlist = explode("\n", $vzlistRawData);
		
		foreach ($vzlist as $vzlistEntry) {
			list($veId, $hostName, $ipAddress, $status) = preg_split("/\s+/", trim($vzlistEntry));
			$virtualServer = $virtualServers->createRow();
			$virtualServer->veId = $veId;
			$virtualServer->ipAddress = $ipAddress;
			$virtualServer->hostName = $hostName;
			$virtualServer->veState = $virtualServer->getVeStateByName($status);
			$virtualServer->hwServerId = $hwServer->id;
			$virtualServer->save();
		}
		
		$this->_helper->json(array('success' => true));
	}
		
	/**
	 * Show server settings and VPS list
	 *
	 */
	public function showAction() {
		$id = $this->_request->getParam('id');
		
		$hwServers = new Owp_Table_HwServers();
		$hwServer = $hwServers->fetchRow($hwServers->select()->where('id = ?', $id));
		
		$this->view->pageTitle = "Hardware server - $hwServer->hostName";
		$this->view->hwServerId = $id;
	}
	
}
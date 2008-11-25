<?php
/**
 * VPS-nodes controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_VirtualServerController extends Owp_Controller_Action_Admin {
		
	/**
	 * Json data of list of servers
	 *
	 */
	public function listDataAction() {
		$hwServerId = $this->_request->getParam('hw-server-id');
		$hwServer = $this->_getHwServer($hwServerId);
		
		$virtualServers = $hwServer->findDependentRowset('Owp_Table_VirtualServers');
				
		$virtualServersJsonData = array();
		
		foreach ($virtualServers as $virtualServer) {
			$virtualServersJsonData[] = array(
				'id' => $virtualServer->id,
				'veId' => $virtualServer->veId,
				'ipAddress' => $virtualServer->ipAddress,
				'hostName' => $virtualServer->hostName,
				'veState' => $virtualServer->veState,
			);
		}
		
		$this->_helper->json($virtualServersJsonData);
	}

	/**
	 * Remove virtual server
	 *
	 */
	public function deleteAction() {
		$id = $this->_request->getParam('id');
		
		$virtualServers = new Owp_Table_VirtualServers();
		$virtualServer = $virtualServers->find($id)->current();
		
		$hwServer = $virtualServer->findParentRow('Owp_Table_HwServers', 'HwServer');
		$hwServer->execDaemonRequest('vzctl', "destroy $virtualServer->veId");
		
		$virtualServer->delete();
		
		$this->_helper->json(array('success' => true));
	}
	
	/**
	 * Create new virtual server
	 *
	 */
	public function addAction() {
		$hwServerId = (int) $this->_request->getParam('hw-server-id');
		
		$virtualServers = new Owp_Table_VirtualServers();
		
		$virtualServer = $virtualServers->createRow();
		$virtualServer->veId = $this->_request->getParam('veId');
		$virtualServer->ipAddress = $this->_request->getParam('ipAddress');
		$virtualServer->hostName = $this->_request->getParam('hostName');
		$virtualServer->veState = true;
		$virtualServer->hwServerId = $hwServerId;
		$virtualServer->save();
		
		$osTemplate = $this->_request->getParam('osTemplate');
		
		$hwServer = $this->_getHwServer($hwServerId);
		$hwServer->execDaemonRequest('vzctl', "create $virtualServer->veId --ostemplate $osTemplate");
		$hwServer->execDaemonRequest('vzctl', "start $virtualServer->veId");
		
		$this->_helper->json(array('success' => true));
	}
	
	/**
	 * Get hardware server
	 *
	 * @param int $id
	 * @return Owp_Table_Row_HwServer
	 */
	private function _getHwServer($id) {
		$hwServers = new Owp_Table_HwServers();
		$hwServer = $hwServers->find($id)->current();
		
		return $hwServer;
	}
	
}
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
		
		$hwServers = new Owp_Table_HwServers();
		$hwServer = $hwServers->find($hwServerId)->current();
		
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
	
}
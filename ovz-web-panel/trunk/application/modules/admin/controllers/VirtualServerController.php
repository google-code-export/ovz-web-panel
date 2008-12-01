<?php
/**
 * VPS-nodes controller
 *
 * @author Alexei Yuzhakov <alex@softunity.com.ru> 
 */
class Admin_VirtualServerController extends Owp_Controller_Action_Admin {
		
	/**
	 * Json data of list of servers
	 *
	 */
	public function listDataAction() {
		$hwServerId = $this->_request->getParam('hw-server-id');
		$hwServer = $this->_getHwServer($hwServerId);
		
		$virtualServers = new Owp_Table_VirtualServers();
		
		$virtualServersData = $virtualServers->fetchAll($virtualServers->select()
			->setIntegrityCheck(false)
			->from('virtualServers')
			->join('osTemplates', 'osTemplates.id = virtualServers.osTemplateId', array('osTemplateName' => 'name'))
			->where('virtualServers.hwServerId = ?', $hwServer->id)		
		);
						
		$virtualServersJsonData = array();
		
		foreach ($virtualServersData as $virtualServerData) {
			$virtualServersJsonData[] = array(
				'id' => $virtualServerData->id,
				'veId' => $virtualServerData->veId,
				'ipAddress' => $virtualServerData->ipAddress,
				'hostName' => $virtualServerData->hostName,
				'veState' => $virtualServerData->veState,
				'osTemplateName' => $virtualServerData->osTemplateName,
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
		$virtualServer->osTemplateId = $this->_request->getParam('osTemplateId');
		$virtualServer->save();
		
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
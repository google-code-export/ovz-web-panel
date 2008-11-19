<?php
/**
 * Shortcuts controller
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class Admin_ShortcutController extends Owp_Controller_Action_Admin {
		
	/**
	 * Delete shortcut
	 *
	 */
	public function deleteAction() {
		$id = $this->_request->getParam('id');
		
		$shortcuts = new Owp_Table_Shortcuts();
		$shortcut = $shortcuts->fetchRow($shortcuts->select()->where('id = ?', $id));
		
		$shortcut->delete();
		
		$this->_helper->json(array('success' => true));
	}
	
	/**
	 * Add shortcut
	 *
	 */
	public function addAction() {
		$shortcuts = new Owp_Table_Shortcuts();
		
		$shortcutTitle = $this->_request->getParam('name');
		$shortcutLink = $this->_request->getParam('link');
		
		$shortcut = $shortcuts->fetchRow($shortcuts->select()
			->where('name = ?', $shortcutTitle)
			->where('link = ?', $shortcutLink)
		);
		
		if ($shortcut) {
			$this->_helper->json(array(
				'success' => false,
				'errors' => array('message' => 'Such shortcut is already present.')
			));
		}
		
		$shortcut = $shortcuts->createRow();
		$shortcut->name = $shortcutTitle;
		$shortcut->link = $shortcutLink;
		$shortcut->save();
				
		$this->_helper->json(array('success' => true));
	}
	
}
<?php
/**
 * Config defaults
 *
 * @author Alexei Yuzhakov <sibprogrammer@mail.ru> 
 */
class OvzWebPanel_Config_Defaults {
	
	/**
	 * Get config defaults
	 *
	 * @return array
	 */
	public static function getDefaults() {
		$defaults = array(
			'general' => array(
				'productName'    => 'OpenVZ Web Panel',
				'productVersion' => '0.2',
			),

			'routes' => array(							
				'login' => array(
					'type' => 'Zend_Controller_Router_Route_Static',
					'route' => 'login',
					'defaults' => array(
						'controller' => 'auth',
						'action' => 'login',
					),
				),
			),
					
			'menu' => array(
				'general' => array(
					'title' => 'General',
					'items' => array(
						array(
							'title' => 'Dashboard',
							'link' => '/admin/dashboard',
							'icon' => 'menu_icon_dashboard.png',
						),
						/*array(
							'title' => 'Configuration',
							'link' => '/admin/configuration',
							'icon' => 'menu_icon_tool.png',
						),*/
						array(
							'title' => 'Hardware servers',
							'link' => '/admin/hardware-server/list',
							'icon' => 'menu_icon_host.png',
						),
						/*array(
							'title' => 'Logs',
							'link' => '/admin/logs',
							'icon' => 'menu_icon_logs.png',
						),*/
						array(
							'title' => 'Logout',
							'link' => 'javascript: OvzWebPanel.Layouts.Admin.onLogoutLinkClick();',
							'icon' => 'menu_icon_logout.png',
						),
					),
				),
			
				/*'hardwareServers' => array(
					'title' => 'Hardware servers',
					'items' => array(
						array(
							'title' => 'note.lan',
							'link' => '/admin/hardware-server/id/10',
							'icon' => 'menu_icon_host.png',
						),
					),
				),*/
				
				'help' => array(
					'title' => 'Help',
					'items' => array(
						array(
							'title' => 'Documentation',
							'link' => 'http://link-here',
							'external' => true,
							'icon' => 'menu_icon_help.png',
						),
						array(
							'title' => 'Support',
							'link' => 'http://link-here',
							'external' => true,
							'icon' => 'menu_icon_docs.png',
						),
					),
				),
			),
		);
		
		return $defaults;
	}
	
}
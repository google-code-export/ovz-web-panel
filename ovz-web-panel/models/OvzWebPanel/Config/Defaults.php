<?php
/**
 * Config defaults
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
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
				'productVersion' => '0.1',
			),
						
			'menu' => array(
				'general' => array(
					'title' => 'General',
					'items' => array(
						array(
							'title' => 'Dashboard',
							'link' => '/dashboard',
							'icon' => 'menu_icon_dashboard.png',
						),
						array(
							'title' => 'Configuration',
							'link' => '/configuration',
							'icon' => 'menu_icon_tool.png',
						),
						array(
							'title' => 'Hardware servers',
							'link' => '/hardware-server/list',
							'icon' => 'menu_icon_host.png',
						),
						array(
							'title' => 'Logs',
							'link' => '/logs',
							'icon' => 'menu_icon_logs.png',
						),
					),
				),
			
				'hardwareServers' => array(
					'title' => 'Hardware servers',
					'items' => array(
						array(
							'title' => 'note.lan',
							'link' => '/hardware-server/id/10',
							'icon' => 'menu_icon_host.png',
						),
					),
				),
				
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
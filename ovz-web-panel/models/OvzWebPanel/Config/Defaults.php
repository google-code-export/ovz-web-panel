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
					),
				),
				
				'reports' => array(
					'title' => 'Statictics reports',
					'items' => array(
						array(
							'title' => 'Latest reports',
							'link' => '/report/latest',
							'icon' => 'menu_icon_report.png',
						),
						array(
							'title' => 'Reports by version',
							'link' => '/report/select-product',
							'icon' => 'menu_icon_product.png',
						),
						array(
							'title' => 'Search reports',
							'link' => '/report/search',
							'icon' => 'search.png',
						),
						array(
							'title' => 'Upload report',
							'link' => '/upload',
							'icon' => 'menu_icon_plus.gif',
						),
					),
				),
				
				'help' => array(
					'title' => 'Help',
					'items' => array(
						array(
							'title' => 'Documentation',
							'link' => 'http://doc.sbts.plesk.ru/stats_server:start',
							'external' => true,
							'icon' => 'menu_icon_docs.png',
						),
						array(
							'title' => 'Feedback',
							'link' => 'http://doc.sbts.plesk.ru/stats_server:feedback',
							'external' => true,
							'icon' => 'menu_icon_help.png',
						),
					),
				),
			),
		);
		
		return $defaults;
	}
	
}
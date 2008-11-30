<?php
/**
 * Virtual server table row gateway
 *
 * @author Alexei Yuzhakov <alex@softunity.com.ru> 
 */
class Owp_Table_Row_VirtualServer extends Zend_Db_Table_Row_Abstract {
	
	const STATE_RUNNING = 1;
	const STATE_STOPPED = 2;
	const STATE_UNKNOWN = 3;
	
	/**
	 * Get virtual server state by state name
	 *
	 * @param string $stateName
	 * @return int
	 */
	public function getVeStateByName($stateName) {
		if ('running' == $stateName) {
			return self::STATE_RUNNING;
		}
		
		if ('stopped' == $stateName) {
			return self::STATE_STOPPED;
		}
		
		return self::STATE_UNKNOWN;
	}
	
}
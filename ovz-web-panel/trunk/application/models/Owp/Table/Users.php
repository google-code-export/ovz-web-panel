<?php
/**
 * Users table gateway
 *
 * @author Alexei Yuzhakov <ayuzhakov@parallels.com> 
 */
class Owp_Table_Users extends Zend_Db_Table_Abstract {
	
	const ROLE_ADMIN = 1;
	
	protected $_name = 'users';
	
}
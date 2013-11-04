<?php
namespace Application\Security\Acl;

use Zend\Permissions\Acl\Role\RoleInterface;

/**
 * 
 * @author zakyalvan
 */
class Role implements RoleInterface {
	/**
	 * @var string
	 */
	private $roleId;
	
	/**
	 * @var string
	 */
	private $roleName;
	
	public function __construct($roleId, $roleName) {
		if(!$roleId) {
			throw new \InvalidArgumentException('Parameter role id tidak boleh null', 100, null);
		}
		
		$this->roleId = (string) $roleId;
		$this->roleName = (string) $roleName;
	}
	
	public function getRoleId() {
		return $this->roleId;
	}
	
	public function getRoleName() {
		return $this->roleName;
	}
	
	public function __toString() {
		return $this->roleName;
	}
}
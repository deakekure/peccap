<?php
namespace Application\Security\Util;

use Doctrine\Common\Collections\ArrayCollection;
use Zend\Permissions\Acl\Role\RoleInterface;
use Application\Security\Acl\Role;

/**
 * Dto object untuk nyimpan informasi login context.
 * 
 * @author zakyalvan
 */
class LoginContext {
	public function __construct($username, $fullname, array $availableRoles, \DateTime $loggedinTimestamp, Role $activeRole = null) {
		$this->username = $username;
		$this->fullname = $fullname;
		
		$this->avalaibleRoles = new ArrayCollection();
		foreach ($availableRoles as $role) {
			if(!$role instanceof Role) {
				throw new \InvalidArgumentException('Parameter role harus instance dari kelas Application\Security\Acl\Role', 100, null);
			}
			
			$this->avalaibleRoles->add($role);
		}
		
		$this->loggedinTimestamp = $loggedinTimestamp;
		
		if($activeRole == null) {
			// Ada automatis active role jika jumlah role hanya satu.
			if(count($this->avalaibleRoles) === 1) {
				$this->activeRole = $this->avalaibleRoles->get(0);
			}
		}
		else {
			$this->activeRole = $activeRole;
		}
	}
	
	/**
	 * @var string
	 */
	private $username;
	public function getUsername() {
		return $this->username;
	}
	
	/**
	 * Nama lengkap dari user yang sedang login.
	 * 
	 * @var string
	 */
	private $fullname;
	public function getFullname() {
		return $this->fullname;
	}
	
	/**
	 * @var Role
	 */
	private $activeRole;
	public function getActiveRole() {
		return $this->activeRole;
	}
	
	/**
	 * @var ArrayCollection
	 */
	private $avalaibleRoles;
	public function getAvailableRoles() {
		return $this->avalaibleRoles;
	}
	
	/**
	 * @var \DateTime
	 */
	private $loggedinTimestamp;
	public function getLoggedinTimestamp() {
		return $this->loggedinTimestamp;
	}
}
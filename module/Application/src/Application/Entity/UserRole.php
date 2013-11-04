<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_user_role_map")
 * 
 * @author zakyalvan
 */
class UserRole {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\User", fetch="LAZY", inversedBy="userRoles")
	 * @Orm\JoinColumn(name="user_id", referencedColumnName="id")
	 * 
	 * @var User
	 */
	private $user;
	public function getUser() {
		return $this->user;
	}
	public function setUser(User $user) {
		$this->user = $user;
	}
	
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\Role", fetch="LAZY", inversedBy="userRoles")
	 * @Orm\JoinColumn(name="role_id", referencedColumnName="id")
	 * 
	 * @var Role
	 */
	private $role;
	public function getRole() {
		return $this->role;
	}
	public function setRole(Role $role) {
		$this->role = $role;
	}
	
	/**
	 * @Orm\Column(name="active_status", type="integer", length=1, nullable=false)
	 * 
	 * @var integer
	 */
	private $active;
	public function getActive() {
		return $this->active;
	}
	public function setActive($active) {
		$this->active = $active;
	}
	
	/**
	 * @Orm\Column(name="start_date", type="datetime", nullable=false)
	 * 
	 * @var \DateTime
	 */
	private $startDate;
	public function getStartDate() {
		return $this->startDate;
	}
	public function setStartDate(\DateTime $startDate) {
		$this->startDate = $startDate;
	}
	
	/**
	 * @Orm\Column(name="end_date", type="datetime", nullable=true)
	 * 
	 * @var \DateTime
	 */
	private $endDate;
	public function getEndDate() {
		return $this->endDate;
	}
	public function setEndDate(\DateTime $endDate) {
		$this->endDate = $endDate;
	}
}
<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Orm\Entity
 * @Orm\Table(name="peccap_role")
 * 
 * @author zakyalvan
 */
class Role {
	public function __construct() {
		$this->userRoles = new ArrayCollection();
	}
	
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="integer")
	 * @Orm\GeneratedValue(strategy="NONE")
	 * 
	 * @var integer
	 */
	private $id;
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * @Orm\Column(name="name", type="string", length=50, unique=true)
	 * 
	 * @var string
	 */
	private $name;
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Application\Entity\UserRole", fetch="LAZY", mappedBy="role")
	 *
	 * @var ArrayCollection
	 */
	private $userRoles;
	public function getUserRoles() {
		return $this->userRoles;
	}
	public function setUserRoles(ArrayCollection $userRoles) {
		$this->userRoles = $userRoles;
	}
	public function addUserRoles(ArrayCollection $userRoles) {
		foreach ($userRoles as $userRole) {
			$this->userRoles->add($userRole);
		}
	}
	public function removeUserRoles(ArrayCollection $userRoles) {
		foreach ($userRoles as $userRole) {
			$this->userRoles->removeElement($userRole);
		}
	}
}
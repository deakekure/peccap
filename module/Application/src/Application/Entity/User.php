<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Orm\Entity(repositoryClass="Application\Entity\Repository\UserRepository")
 * @Orm\Table(name="peccap_user")
 * 
 * @author zakyalvan
 */
class User {
	public function __construct() {
		$this->userRoles = new ArrayCollection();
	}
	
	/**
	 * @Orm\Id
	 * @Orm\Column(name="id", type="integer", nullable=false)
	 * @Orm\GeneratedValue(strategy="IDENTITY")
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
	 * @Orm\Column(name="full_name", type="string", length=255, nullable=false)
	 * 
	 * @var string
	 */
	private $fullName;
	public function getFullName() {
		return $this->fullName;
	}
	public function setFullName($fullName) {
		$this->fullName = $fullName;
	}
	
	/**
	 * @Orm\Column(name="login_user_name", type="string", length=255, unique=true, nullable=false)
	 *
	 * @var string
	 */
	private $userName;
	public function getUserName() {
		return $this->userName;
	}
	public function setUserName($userName) {
		$this->userName = $userName;
	}
	
	/**
	 * @Orm\Column(name="login_password", type="string", length=32, nullable=false)
	 *
	 * @var string
	 */
	private $password;
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	
	/**
	 * @Orm\OneToMany(targetEntity="Application\Entity\UserRole", fetch="LAZY", mappedBy="user")
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
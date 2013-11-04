<?php
namespace Application\Security\Authentication;

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use Zend\Authentication\Result;
use Application\Entity\User;
use Application\Security\Util\LoginContext;
use Application\Entity\UserRole;
use Application\Security\Acl\Role;

/**
 * Custom login adapter.
 * 
 * @author zakyalvan
 */
class Adapter implements AdapterInterface {
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	public function __construct(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}
	
	private $username;
	public function getUsername() {
		return $this->username;
	}
	public function setUsername($username) {
		$this->username = $username;
	}
	
	private $password;
	public function getPassword() {
		return $this->password;
	}
	public function setPassword($password) {
		$this->password = $password;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Authentication\Adapter\AdapterInterface::authenticate()
	 */
	public function authenticate() {
		/* @var $entityManager EntityManager */
		$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		
		$queryBuilder = $entityManager->createQueryBuilder();
		/* @var $user User */
		$user = $queryBuilder->select('user')
			->from('Application\Entity\User', 'user')
			->leftJoin('user.userRoles', 'userRoles', Join::WITH, $queryBuilder->expr()->eq('userRoles.active', ':userRoleActive'))
			->leftJoin('userRoles.role', 'role')
			->where($queryBuilder->expr()->eq('user.userName', ':username'))
			->setParameter('userRoleActive', 1)
			->setParameter('username', $this->username)
			->getQuery()
			->getOneOrNullResult();
		
		if($user === null) {
			return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, null);
		}
		
		if(md5($this->password) === $user->getPassword()) {
			$availableRoles = array();
			
			/* @var $userRole UserRole */
			foreach($user->getUserRoles() as $userRole) {
				$availableRoles[] = new Role($userRole->getRole()->getId(), $userRole->getRole()->getName());
			}
			
			$loginContext = new LoginContext(
				$user->getUserName(), 
				$user->getFullName(), 
				$availableRoles,
				new \DateTime()
			);
			
			return new Result(Result::SUCCESS, $loginContext);
		}
		else {
			return new Result(Result::FAILURE_CREDENTIAL_INVALID, null);
		}
	}
}
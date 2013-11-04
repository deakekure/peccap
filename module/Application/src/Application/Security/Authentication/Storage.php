<?php
namespace Application\Security\Authentication;

use Zend\Authentication\Storage\StorageInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Application\Security\Util\LoginContext;
use Doctrine\ORM\EntityManager;
use Application\Security\Acl\Role;
use Application\Entity\User;

/**
 * Implementasi custom storage untuk auth service.
 * 
 * @author zakyalvan
 */
class Storage implements StorageInterface {
	const SESSION_NAMESPACE = 'security_context_container';
	
	const SESSION_STORAGE_KEY = 'login_info_custom';
	
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;
	
	/**
	 * @var Container
	 */
	private $sessionContainer;
	
	/**
	 * @var LoginContext
	 */
	private $cachedLoginContext;
	
	/**
	 * @var string
	 */
	private $storageKey;
	
	/**
	 * Format waktu standard
	 * 
	 * @var string
	 */
	private $timestampFormat = 'd/m/Y H:i:s';
	
	public function __construct(ServiceLocatorInterface $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
		
		$this->sessionContainer = new Container(self::SESSION_NAMESPACE);
		$this->storageKey = self::SESSION_STORAGE_KEY;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Authentication\Storage\StorageInterface::isEmpty()
	 */
	public function isEmpty() {
		return !isset($this->sessionContainer->{$this->storageKey});
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Authentication\Storage\StorageInterface::read()
	 */
	public function read() {
		if(!isset($this->sessionContainer->{$this->storageKey})) {
			return null;
		}
		
		if($this->cachedLoginContext != null) {
			return $this->cachedLoginContext;
		}
		
		$loginContextArray = $this->sessionContainer->{$this->storageKey};
		
		$activeRole = null;
		if(isset($loginContextArray['activeRole'])) {
			$activeRole = new Role($loginContextArray['activeRole']['id'], $loginContextArray['activeRole']['name']);
		}
		
		$availableRoles = array();
		foreach ($loginContextArray['availableRoles'] as $role) {
			$availableRoles[] = new Role($role['id'], $role['name']);
		}
		
		$loginContext = new LoginContext(
			$loginContextArray['username'], 
			$loginContextArray['fullname'],
			$availableRoles,
			\DateTime::createFromFormat($this->timestampFormat, $loginContextArray['loggedinTimestamp']),
			$activeRole
		);
		
		$this->cachedLoginContext = $loginContext;
		
		return $loginContext;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Authentication\Storage\StorageInterface::write()
	 */
	public function write($contents) {
		if(!$contents instanceof LoginContext) {
			throw new \InvalidArgumentException(sprintf('Parameter harus instance dari kelas %s', 'Application\Security\Util\LoginContext'), 100, null);
		}
		
		// Pastiin login context kosong.
		$this->cachedLoginContext = null;
		
		$loginContextArray = array(
			'username' => $contents->getUsername(),
			'fullname' => $contents->getFullname(),
			'loggedinTimestamp' => $contents->getLoggedinTimestamp()->format($this->timestampFormat)
		);
		
		if($contents->getActiveRole() !== null) {
			$loginContextArray['activeRole'] = array(
				'id' => $contents->getActiveRole()->getRoleId(),
				'name' => $contents->getActiveRole()->getRoleName()
			);
		}
		
		$loginContextArray['availableRoles'] = array();
		
		/* @var $availableRole Role */
		foreach ($contents->getAvailableRoles() as $availableRole) {
			$loginContextArray['availableRoles'][] = array(
				'id' => $availableRole->getRoleId(),
				'name' => $availableRole->getRoleName()
			);
		}
		
		$this->sessionContainer->{$this->storageKey} = $loginContextArray;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Authentication\Storage\StorageInterface::clear()
	 */
	public function clear() {
		unset($this->sessionContainer->{$this->storageKey});
		$this->cachedLoginContext = null;
	}
}
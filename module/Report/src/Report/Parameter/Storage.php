<?php
namespace Report\Parameter;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Zend\Session\Container as SessionContainer;
use Report\Contract\Parameter;
use Doctrine\ORM\EntityManager;
use Application\Entity\Repository\AnnualPeriodRepository;

/**
 * Implementasi default parameter storage.
 * 
 * @author zakyalvan
 */
class Storage implements StorageInterface, ServiceLocatorAware {
	/**
	 * @var Container
	 */
	private $sessionContainer;
	
	/**
	 * @var string
	 */
	private $storageNamespace = 'REPORT_PARAMETER_NAMESPACE';
	
	/**
	 * @var string
	 */
	private $storageKey = 'REPORT_PARAMETER_STORAGE_KEY';
	
	/**
	 * @var Parameter
	 */
	private $defaultParameter;
	
	/**
	 * @var Parameter
	 */
	private $cachedParameter;
	
	/**
	 * @var ConverterInterface
	 */
	private $converter;
	
	/**
	 * @var ServiceLocator
	 */
	private $serviceLocator;
	
	public function __construct(ConverterInterface $converter) {
		$this->sessionContainer = new SessionContainer($this->storageNamespace);
		$this->converter = $converter;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::getDefault()
	 */
	public function getDefault() {
		if($this->defaultParameter === null) {
			$parameter = new Parameter();
			
			/* @var $entityManager EntityManager */
			$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
			
			/* @var $annualPeriodRepository AnnualPeriodRepository */
			$annualPeriodRepository = $entityManager->getRepository('Application\Entity\AnnualPeriod');
			$currentAnnualPeriod = $annualPeriodRepository->getCurrent();
			
			$parameter->getAnnualPeriods()->add($currentAnnualPeriod);
			
			
			
			$this->defaultParameter = $parameter;
		}
		return $this->defaultParameter;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::isEmpty()
	 */
	public function isEmpty() {
		return isset($this->sessionContainer->{$this->storageKey});
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::write()
	 */
	public function write(Parameter $parameter) {
		$this->sessionContainer->{$this->storageKey} = $this->converter->convertToStorage($parameter);
		$this->cachedParameter = $parameter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::read()
	 */
	public function read() {
		if($this->cachedParameter !== null) {
			return $this->cachedParameter;
		}
		
		if(!$this->isEmpty()) {
			$parameter = $this->converter->convertToParameter($this->sessionContainer->{$this->storageKey});
			$this->cachedParameter = $parameter;
			return $parameter;
		}
		return null;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Parameter\StorageInterface::reset()
	 */
	public function reset() {
		unset($this->sessionContainer->{$this->storageKey});
		$this->cachedParameter = null;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
	public function setServiceLocator(ServiceLocator $serviceLocator) {
		$this->serviceLocator = $serviceLocator;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
	 */
	public function getServiceLocator() {
		return $this->serviceLocator;
	}
}
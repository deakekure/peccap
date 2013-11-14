<?php
namespace Report\Generator\Service;

use Zend\Stdlib\InitializableInterface as Initializable;
use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Zend\Stdlib\InitializableInterface as Initializable;
use Zend\Form\FormElementManager;
use Zend\ModuleManager\Listener\ServiceListener;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Report\Parameter\Storage as ParameterStorage;
use Report\Service\Exception\InvalidGeneratorException;
use Report\Contract\GeneratorInterface as ReportGenerator;
use Report\Parameter\Converter\ParameterConverter;
use Report\Parameter\Converter\AnnualPeriodConveter;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Report\Parameter\Converter\TerritoryConverter;
use Report\Parameter\Converter\DomainConverter;
use Report\Parameter\Converter\CategoryConverter;
use Report\Parameter\Converter\SourceConverter;

/**
 * Implementasi default report service.
 * 
 * @author zakyalvan
 */
class GeneratorManager extends AbstractPluginManager implements GeneratorManagerInterface, Initializable {
	/**
	 * @var ParameterStorage
	 */
	private $parameterStorage;
	
	/**
	 * @var boolean
	 */
	protected $shareByDefault = false;
	
	public function __construct(ConfigInterface $configuration = null) {
		parent::__construct($configuration);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\Stdlib\InitializableInterface::init()
	 */
	public function init() {
		// Create parameter converter. Akan digunakan dalam parameter storage.
		$parameterConverter = new ParameterConverter();
		if($parameterConverter instanceof ServiceLocatorAwareInterface) {
			$parameterConverter->setServiceLocator($this->getServiceLocator());
		}
		
		$annualPeriodConverter = new AnnualPeriodConveter();
		if($annualPeriodConverter instanceof ObjectManagerAwareInterface) {
			$annualPeriodConverter->setObjectManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		$parameterConverter->addConverter('Application\Entity\AnnualPeriod', $annualPeriodConverter);
		
		$territoryConverter = new TerritoryConverter();
		if($territoryConverter instanceof ObjectManagerAwareInterface) {
			$territoryConverter->setObjectManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		$parameterConverter->addConverter('Application\Entity\Territory', $territoryConverter);
		
		$domainConverter = new DomainConverter();
		if($domainConverter instanceof ObjectManagerAwareInterface) {
			$domainConverter->setObjectManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		$parameterConverter->addConverter('Expenditure\Entity\Domain', $domainConverter);
		
		$categoryConverter = new CategoryConverter();
		if($categoryConverter instanceof ObjectManagerAwareInterface) {
			$categoryConverter->setObjectManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		$categoryConverter->addConverter('Expenditure\Entity\Category', $categoryConverter);
		
		$sourceConverter = new SourceConverter();
		if($sourceConverter instanceof ObjectManagerAwareInterface) {
			$sourceConverter->setObjectManager($this->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
		}
		$categoryConverter->addConverter('Income\Entity\Source', $sourceConverter);
		
		// Create parameter storage.
		$parameterStorage = new ParameterStorage($parameterConverter);
		if($parameterStorage instanceof  ServiceLocatorAwareInterface) {
			$parameterStorage->setServiceLocator($this->getServiceLocator());
		}
		
		// Create default parameter jika parameter dalam storage kosong.
		if($parameterStorage->isEmpty()) {
			$parameterStorage->write($parameterStorage->getDefault());
		}
		
		$this->parameterStorage = $parameterStorage;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Generator\Service\GeneratorManagerInterface::getParameterStorage()
	 */
	public function getParameterStorage() {
		return $this->parameterStorage;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Generator\Service\GeneratorManagerInterface::getReportGenerator()
	 */
	public function getReportGenerator($id) {
		return $this->get($id);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\AbstractPluginManager::validatePlugin()
	 */
	public function validatePlugin($plugin) {
		if ($plugin instanceof Initializable) {
			$plugin->init();
		}
		
		if($plugin instanceof ReportGenerator) {
			return;
		}
		
		throw new InvalidGeneratorException(
			sprintf('Generator report harus instance dari object %s', 'Report\Generator\GeneratorInterface'), 
			100, 
			null
		);
	}
}
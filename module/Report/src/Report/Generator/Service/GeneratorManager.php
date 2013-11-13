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
		$parameterConverter = new ParameterConverter();
		if($parameterConverter instanceof ServiceLocatorAwareInterface) {
			$parameterConverter->setServiceLocator($this->getServiceLocator());
		}
		
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
<?php
namespace Report\Contract;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * Abstract report generator.
 * 
 * @author zakyalvan
 */
abstract class AbstractGenerator implements GeneratorInterface, DataProviderInterface, ServiceLocatorAware {
	/**
	 * Id generator.
	 * 
	 * @var string
	 */
	private $id;
	
	/**
	 * FQCN data class yang di-provide.
	 * 
	 * @var string
	 */
	protected $dataClass;
	
	/**
	 * Data query.
	 * 
	 * @var Query
	 */
	protected $dataQuery;
	
	/**
	 * @var ServiceLocator
	 */
	protected $serviceLocator;
	
	public function __construct($id, $dataClass) {
		$this->id = $id;
		$this->dataClass = $dataClass;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\GeneratorInterface::getId()
	 */
	public function getId() {
		return $this->id;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\GeneratorInterface::canGenerate()
	 */
	abstract public function canGenerate(Parameter $parameter);
	
	/**
	 * Build query berdasarkan parameter yang diberikan.
	 *
	 * @return Query|QueryBuilder
	 */
	abstract protected function buildDataQuery(Parameter $parameter, EntityManager $entityManager);
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\GeneratorInterface::generate()
	 */
	public function generate(Parameter $parameter) {
		/* @var $entityManager EntityManager */ 
		$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		
		$this->dataQuery = $this->buildDataQuery($parameter, $entityManager);
		
		$report = new Report($this->dataClass);
		$report->setDataProvider($this);
		return $report;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataProviderInterface::getDataClass()
	 */
	public function getDataClass() {
		return $this->dataClass;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataProviderInterface::getData()
	 */
	public function getData() {
		if(!$this->dataQuery) {
			throw new DataProviderException(
				sprintf('Data provider error, object data-query belum disediakan.'), 
				100,
				null
			);
		}
		
		try {
			return $this->dataQuery->getSingleResult();
		}
		catch(\Exception $e) {
			throw new DataProviderException(
				sprintf('Terjadi kesalahan pada proses query data, perhatikan trace exception.'),
				100,
				$e
			);
		}
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
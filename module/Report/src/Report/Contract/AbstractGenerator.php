<?php
namespace Report\Contract;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Zend\ServiceManager\ServiceLocatorInterface as ServiceLocator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Common\Collections\ArrayCollection;
use Report\Contract\Exception\GeneratorException;

/**
 * Abstract report generator.
 * 
 * @author zakyalvan
 */
abstract class AbstractGenerator implements GeneratorInterface, DataProviderInterface, ServiceLocatorAware {
	/**
	 * Id dari generator.
	 * 
	 * @var string
	 */
	protected $id;
	
	/**
	 * Parameter untuk generator.
	 * 
	 * @var Parameter
	 */
	protected $parameter;
	
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
	
	/**
	 * Array strategy untuk report.
	 * 
	 * @var array
	 */
	protected $strategies = array();
	
	public function __construct($id) {
		$this->id = $id;
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
	 * @see \Report\Contract\ParameterAwareInterface::setParameter()
	 */
	public function setParameter(Parameter $parameter) {
		$this->parameter = $parameter;
	}
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ParameterAwareInterface::getParameter()
	 */
	public function getParameter() {
		return $this->parameter;
	}
	
	/**
	 * Check apakah report dapat digenerate berdasarkan parameter yang diberikan.
	 * 
	 * @param Parameter $parameter
	 */
	abstract protected function checkCanGenerate(Parameter $parameter);
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\GeneratorInterface::canGenerate()
	 */
	public function canGenerate(Parameter $parameter = null) {
		// Jika parameter sama sekali belum diberikan.
		if($this->parameter === null && $parameter === null) {
			return false;
		}
		
		if($parameter !== null) {
			$this->setParameter($parameter);
		}
		
		return $this->checkCanGenerate($this->parameter);
	}
	
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
	public function generate(Parameter $parameter = null) {
		if($this->parameter === null && $parameter === null) {
			throw new GeneratorException('Object parameter belum diberikan', 100, null);
		}
		
		if($parameter !== null) {
			$this->setParameter($parameter);
		}
		
		if(!$this->canGenerate($this->getParameter())) {
			throw new GeneratorException('Tidak dapat menggenarate report berdasarkan parameter yang diberikan.', 100, null);
		}
		
		/* @var $entityManager EntityManager */
		$entityManager = $this->serviceLocator->get('Doctrine\ORM\EntityManager');
		
		$dataQuery = $this->buildDataQuery($this->parameter, $entityManager);
		if($dataQuery instanceof QueryBuilder) {
			$this->dataQuery = $dataQuery->getQuery();
		}
		else if($dataQuery instanceof Query) {
			$this->dataQuery = $dataQuery;
		}
		else {
			throw new GeneratorException(
				sprintf('Object data-query bukan instance dari %s atau %s', 'Doctrine\ORM\Query', 'Doctrine\ORM\QueryBuilder'), 
				100,
				null
			);
		}
		
		// Create report object.
		$report = new Report($this->getDataClass());
		$report->setDataProvider($this);
		
		// Populate seluruh strategy yang telah terdaftar ke dalam report object.
		foreach ($this->strategies as $name => $strategy) {
			$report->addStrategy($name, $strategy);
		}
		
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
	 * Create data object untuk masing-masing item data (Jika bukan instance dari DataInterface).
	 * Jika data object t
	 *
	 * @param Object $object
	 * @return DataInterface
	 */
	abstract protected function createDataObject($object);
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\DataProviderInterface::getDatas()
	 */
	public function getDatas() {
		if(!$this->dataQuery) {
			throw new DataProviderException(
				sprintf('Data provider error, object data-query belum disediakan (report belum digenerate).'), 
				100,
				null
			);
		}
		
		try {
			$datas = $this->dataQuery->getResult();
			
			$dataCollection = new ArrayCollection();
			foreach ($datas as $data) {
				$dataObject = $data;
				if(get_class($data) !== $this->getDataClass()) {
					$dataObject = $this->createDataObject($data);
				}
				$dataCollection->add($dataObject);
			}
			return $dataCollection;
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
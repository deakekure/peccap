<?php
namespace Report\Contract;

/**
 * Kelas report.
 * 
 * @author zakyalvan
 */
class Report implements ReportInterface, StrategyHolderInterface {
	/**
	 * Id dari report. Ini akan diset oleh object report-generator.
	 * 
	 * @var string
	 */
	private $id;
	
	/**
	 * FQCN data class yang dibutuhkan oleh report.
	 * 
	 * @var string
	 */
	private $dataClass;
	
	/**
	 * @var DataProviderInterface
	 */
	private $dataProvider;
	
	/**
	 * Stack dari strategy.
	 * 
	 * @var array
	 */
	private $strategies = array();
	
	/**
	 * Apakah override strategi (berdasarkan nama) diizinkan.
	 * 
	 * @var boolean
	 */
	private $allowStrategyOverride = false;
	
	/**
	 * Konstruktor.
	 * 
	 * @param string $dataClass
	 * @throws \InvalidArgumentException
	 */
	public function __construct($dataClass) {
		if(!class_exists($dataClass)) {
			throw new \InvalidArgumentException(sprintf('Data class tidak ditemukan.'), 100, null);
		}
		
		$dataClassInterfaces = class_implements($dataClass, true);
		if(!array_key_exists('Report\Contract\DataInterface', $dataClassInterfaces)) {
			throw new \InvalidArgumentException(sprintf('Data bukan instance dari DataInterface'), 100, null);
		}
		$this->dataClass = $dataClass;
	}
	
	/**
	 * Retrieve id dari report.
	 * 
	 * @return string
	 */
	public function getId() {
		return $this->id;
	}
	/**
	 * Set id report.
	 * Id ini harus diset oleh report-generator.
	 * 
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::getDataProvider()
	 */
	public function getDataProvider() {
		return $this->dataProvider;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\ReportInterface::setDataProvider()
	 */
	public function setDataProvider(DataProviderInterface $dataProvider) {
		// @TODO Validasi apakah dataClass dari provider sama dengan dataClass yang dibutuhkan.
		
		$this->dataProvider = $dataProvider;
		
		/* @var $strategy StrategyInterface */
		foreach ($this->strategies as $strategy) {
			$strategy->setDataProvider($dataProvider);
		}
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::addStrategy()
	 */
	public function addStrategy($name, StrategyInterface $strategy) {
		if($this->hasStrategy($name) && !$this->allowStrategyOverride) {
			throw new \InvalidArgumentException(sprintf('Strategy dengan nama %s sudah ada dalam stack strategies dan override tidak diizinkan', $name), 100, null);
		}
		
		if($this->dataProvider !== null) {
			$strategy->setDataProvider($this->dataProvider);
		}
		$this->strategies[$name] = $strategy;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::hasStrategy()
	 */
	public function hasStrategy($name) {
		return array_key_exists($name, $this->strategies);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::getStrategy()
	 */
	public function getStrategy($name) {
		if($this->hasStrategy($name)) {
			return $this->strategies[$name];
		}
		return null;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::getStrategies()
	 */
	public function getStrategies() {
		return array_merge(array(), $this->strategies);
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::removeStrategy()
	 */
	public function removeStrategy($name) {
		if($this->hasStrategy($name)) {
			unset($this->strategies[$name]);
			return true;
		}
		return false;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::setAllowStrategyOverride()
	 */
	public function setAllowStrategyOverride($allowStrategyOverride) {
		$this->allowStrategyOverride = (boolean) $allowStrategyOverride;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\Contract\StrategyHolderInterface::getAllowStrategyOverride()
	 */
	public function getAllowStrategyOverride() {
		return $this->allowStrategyOverride;
	}
}
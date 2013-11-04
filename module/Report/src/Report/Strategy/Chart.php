<?php
namespace Report\Strategy;

use Report\Contract\StrategyInterface;
use Report\Contract\DataProviderInterface;

/**
 * Strategy reporting menggunakan chart.
 * Lebih spesifik chart ini menggunakan fussion chart.
 * 
 * @author zakyalvan
 */
class Chart implements StrategyInterface {
	/**
	 * @var DataProviderInterface
	 */
	private $dataProvider;
	
	/**
	 * @var string
	 */
	private $chartType;
	
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
		$this->dataProvider = $dataProvider;
	}
	
	public function getChartType() {
		return $this->chartType;
	}
	
	public function getChartData() {
		$data = $this->dataProvider->getData();
		
		// @TODO Generate chart data xml.
	}
}
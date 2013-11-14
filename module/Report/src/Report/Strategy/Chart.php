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
	 * @var string
	 */
	protected $name = self::CHART_STRATEGY;
	
	/**
	 * @var DataProviderInterface
	 */
	protected $dataProvider;
	
	/**
	 * @var string
	 */
	protected $chartType;
	
	public function getName() {
		return $this->name;
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
		$this->dataProvider = $dataProvider;
	}
	
	public function getChartType() {
		return $this->chartType;
	}
	
	public function getChartData() {
		$datas = $this->dataProvider->getDatas();
		
		// @TODO Generate chart data xml.
		$xml = '';
		
		return $xml;
	}
}
<?php
namespace Report\Strategy;

use Report\Contract\AbstractStrategy;

/**
 * Strategy reporting menggunakan chart.
 * Lebih spesifik chart ini menggunakan highcharts (http://www.highcharts.com).
 * 
 * @author zakyalvan
 */
class Chart extends AbstractStrategy {	
	/**
	 * @var string
	 */
	protected $chartType;
	
	public function getChartType() {
		return $this->chartType;
	}
	public function setChartType($chartType) {
		$this->chartType = $chartType;
	}
}
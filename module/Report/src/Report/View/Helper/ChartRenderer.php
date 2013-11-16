<?php
namespace Report\View\Helper;

use Report\Contract\GeneratorInterface;
use Report\Contract\AnnualPeriodVaryingInterface;
use Report\Contract\TerritoryVaryingInterface;
use Report\Contract\Parameter;
use Report\Contract\Report;
use Report\Strategy\Chart;

/**
 * View helper untuk ngerender chart report.
 * Secara spesifik, object ini menggunakan library js highcharts (http://www.highcharts.com)
 * 
 * @author zakyalvan
 */
class ChartRenderer extends AbstractReportRenderer {
	/**
	 * @var boolean
	 */
	private $developmentMode = false;
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\View\Helper\AbstractReportRenderer::doRender()
	 */
	protected function doRender(GeneratorInterface $reportGenerator, Parameter $parameter, $isDefaultParameter) {
		/* @var $report Report */
		$report = $reportGenerator->generate($parameter);
		
		/* @var $chartStrategy Chart */
		$chartStrategy = $report->getStrategy('chart');
		$chartType = $chartStrategy->getChartType();
		
		$annualPeriodSelections = array();
		if($reportGenerator instanceof AnnualPeriodVaryingInterface) {
			$annualPeriodSelections = $reportGenerator->getPeriodSelections();
		}
		
		$territorySelections = array();
		if($reportGenerator instanceof TerritoryVaryingInterface) {
			$territorySelections = $reportGenerator->getTerritorySelections();
		}
		
		return $this->view->partial(
			'chart/highcharts-column.phtml', 
			array(
				'id' => $report->getId(),
				'chartTitle' => 'Apalah',
				'annualPeriodSelections' => $annualPeriodSelections,
				'territorySelections' => $territorySelections,
			)
		);
	}
}
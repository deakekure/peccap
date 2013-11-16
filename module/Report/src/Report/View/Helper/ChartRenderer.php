<?php
namespace Report\View\Helper;

use Report\Contract\GeneratorInterface;

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
	protected function doRender(GeneratorInterface $reportGenerator) {
		$parameter = $this->getReportGeneratorManager()->getParameterStorage()->read();
		$report = $reportGenerator->generate($parameter);
		
		
	}
}
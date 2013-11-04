<?php
namespace Report\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface as ServiceLocatorAware;
use Report\Contract\GeneratorInterface;
use Report\Contract\Report;

/**
 * View helper untuk ngerender chart report.
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
	 * @see \Report\View\Helper\ReportRendererInterface::render()
	 */
	protected function doRender(Report $report) {
		
	}
}
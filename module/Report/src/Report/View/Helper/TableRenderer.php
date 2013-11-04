<?php
namespace Report\View\Helper;

use Report\Contract\Report;

class TableRenderer extends AbstractReportRenderer {
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
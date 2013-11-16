<?php
namespace Report\View\Helper;

use Report\Contract\Report;
use Report\Contract\GeneratorInterface;

/**
 * Ngerender data laporan dalam bentuk table.
 * 
 * @author zakyalvan
 */
class TableRenderer extends AbstractReportRenderer {
	/**
	 * @var boolean
	 */
	private $developmentMode = false;
	
	/**
	 * (non-PHPdoc)
	 * @see \Report\View\Helper\AbstractReportRenderer::doRender()
	 */
	protected function doRender(GeneratorInterface $reportGenerator, $useDefaultParameter = false) {
		
	}
}
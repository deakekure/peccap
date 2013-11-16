<?php
namespace Report\View\Helper;

use Report\Contract\GeneratorInterface;
use Report\Contract\Parameter;

/**
 * Kelas view helper untuk nge-render container report.
 * 
 * @author zakyalvan
 */
class ContainerRenderer extends AbstractReportRenderer {
	/**
	 * (non-PHPdoc)
	 * @see \Report\View\Helper\AbstractReportRenderer::doRender()
	 */
	protected function doRender(GeneratorInterface $reportGenerator, Parameter $parameter, $isDefaultParameter) {
		
	}
}
<?php
namespace Report\Contract;

/**
 * Kontrak untuk strategy reporting.
 * 
 * @author zakyalvan
 */
interface StrategyInterface extends ReportInterface {
	const CHART_STRATEGY = 'chart';
	const TABULAR_STRATEGY = 'tabular';
	
	/**
	 * Retrieve nama dari strategy.
	 * 
	 * @return string
	 */
	public function getName();
}
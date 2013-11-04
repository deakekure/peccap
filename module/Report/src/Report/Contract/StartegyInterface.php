<?php
namespace Report\Contract;

/**
 * Kontrak untuk strategy report.
 * 
 * @author zakyalvan
 */
interface StrategyInterface extends ReportInterface {
	const CHART_STRATEGY = 'chart';
	const TABULAR_STRATEGY = 'tabular';
}
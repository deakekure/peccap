<?php
namespace Report\Contract;

/**
 * Kontrak untuk strategy reporting.
 * 
 * @author zakyalvan
 */
interface StrategyInterface extends \Serializable, ReportInterface, DataSerializerAwareInterface {
	const CHART_STRATEGY = 'chart';
	const TABULAR_STRATEGY = 'tabular';
	
	/**
	 * Retrieve nama dari strategy.
	 * 
	 * @return string
	 */
	public function getName();
	
	/**
	 * Set nama strategy.
	 * 
	 * @param string $name
	 */
	public function setName($name);
}
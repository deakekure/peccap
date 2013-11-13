<?php
namespace Report\Generator\Data;

use Report\Contract\DataInterface;

/**
 * DTO untuk data periodic total expenditure untuk masing-masing daerah.
 * 
 * @author zakyalvan
 */
class PeriodicalTerritoryTotalIncome implements DataInterface {
	public function __construct($territoryId, $territoryName, $annualPeriod, $totalIncome) {
		$this->territoryId = $territoryId;
		$this->territoryName = $territoryName;
		$this->annualPeriod = $annualPeriod;
		$this->totalIncome = $totalIncome;
	}
	
	/**
	 * @var string
	 */
	private $territoryId;
	public function getTerritoryId() {
		return $this->territoryId;
	}
	
	/**
	 * @var string
	 */
	private $territoryName;
	public function getTerritoryName() {
		return $this->territoryName;
	}
	
	/**
	 * @var integer
	 */
	private $annualPeriod;
	public function getAnnualPeriod() {
		return $this->annualPeriod;
	}
	
	/**
	 * @var float
	 */
	private $totalIncome;
	public function getTotalIncome() {
		return $this->totalIncome;
	}
}
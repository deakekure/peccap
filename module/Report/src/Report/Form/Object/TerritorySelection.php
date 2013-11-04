<?php
namespace Report\Form\Object;

use Application\Entity\AnnualPeriod;
use Application\Entity\Territory;

/**
 * Form backing object untuk pilihan wilayah administratif.
 * 
 * @author zakyalvan
 */
class TerritorySelection {
	public static function createFromTerritoryArray(array $territories) {
		$territorySelections = array();
		
		foreach ($territories as $territory) {
			$territorySelection = new self();
			$territorySelection->setTerritory($territory);
			
			$territorySelections[] = $territorySelection;
		}
		
		return $territorySelections;
	}
	
	private $selection = 0;
	public function getSelection() {
		return $this->selection;
	}
	public function setSelection($selection) {
		$this->selection = $selection;
	}
		
	private $territory;
	public function getTerritory() {
		return $this->territory;
	}
	public function setTerritory(Territory $territory) {
		$this->territory = $territory;
	}
}
<?php
namespace Report\Form\Object;

use Application\Entity\AnnualPeriod;

/**
 * Ini form backing object untuk pemilihan periode tahunan.
 * 
 * @author zakyalvan
 */
class AnnualPeriodSelection {
	public static function createFromAnnualPeriodArray(array $annualPeriods) {
		$annualPeriodSelections = array();
		
		foreach ($annualPeriods as $annualPeriod) {
			$annualPeriodSelection = new self();
			$annualPeriodSelection->setAnnualPeriod($annualPeriod);
			
			$annualPeriodSelections[] = $annualPeriodSelection;
		}
		
		return $annualPeriodSelections;
	}
	
	private $selection = 0;
	public function getSelection() {
		return $this->selection;
	}
	public function setSelection($selection) {
		$this->selection = $selection;
	}
		
	private $annualPeriod;
	public function getAnnualPeriod() {
		return $this->annualPeriod;
	}
	public function setAnnualPeriod(AnnualPeriod $annualPeriod) {
		$this->annualPeriod = $annualPeriod;
	}
}
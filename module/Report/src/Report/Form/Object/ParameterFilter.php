<?php
namespace Report\Form\Object;

/**
 * Form backing object untuk form parameter filter form.
 * 
 * @author zakyalvan
 */
class ParameterFilter {
	public function __construct(array $territories, array $annualPeriods, array $domains, array $categories, array $sources) {
		$this->setTerritorySelection(TerritorySelection::createFromTerritoryArray($territories));
		$this->setAnnualPeriodSelections(AnnualPeriodSelection::createFromAnnualPeriodArray($annualPeriods));
		$this->setDomainSelections(DomainSelection::createFromDomainArray($domains));
		$this->setCategorySelections(CategorySelection::createFromCategoryArray($categories));
		$this->setSourceSelections(SourceSelection::createFromSourceArray($sources));
	}
	
	private $territorySelections;
	public function getTerritorySelections() {
		return $this->territorySelections;
	}
	public function setTerritorySelection($territorieSelections) {
		$this->territorySelections = $territorieSelections;
	}
	
	private $annualPeriodSelections;
	public function getAnnualPeriodSelections() {
		return $this->annualPeriodSelections;
	}
	public function setAnnualPeriodSelections($annualPeriodSelections) {
		$this->annualPeriodSelections = $annualPeriodSelections;
	}
	
	private $domainsSelections;
	public function getDomainSelections() {
		return $this->domainsSelections;
	}
	public function setDomainSelections($domainSelections) {
		$this->domainsSelections = $domainSelections;
	}
	
	private $categorySelections;
	public function getCategorySelections() {
		return $this->categorySelections;
	}
	public function setCategorySelections($categorySelections) {
		$this->categorySelections = $categorySelections;
	}
	
	private $sourceSelections;
	public function getSourceSelections() {
		return $this->sourceSelections;
	}
	public function setSourceSelections($sourceSelections) {
		$this->sourceSelections = $sourceSelections;
	}
}
<?php
namespace Report\Contract;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * DTO parameter report.
 * 
 * @author zakyalvan
 */
final class Parameter {
	/**
	 * @var ArrayCollection
	 */
	private $territories;
	
	/**
	 * @var ArrayCollection
	 */
	private $annualPeriods;
	
	/**
	 * @var ArrayCollection
	 */
	private $domains;
	
	/**
	 * @var ArrayCollection
	 */
	private $categories;
	
	/**
	 * @var ArrayCollection
	 */
	private $sources;
	
	public function __construct() {
		$this->territories = new ArrayCollection();
		$this->annualPeriods = new ArrayCollection();
		$this->domains = new ArrayCollection();
		$this->categories = new ArrayCollection();
		$this->sources = new ArrayCollection();
	}
	
	public function getTerritories() {
		return $this->territories;
	}
	public function setTerritories(ArrayCollection $territories) {
		$this->territories = $territories;
	}
	
	public function getAnnualPeriods() {
		return $this->annualPeriods;
	}
	public function setAnnualPeriods(ArrayCollection $annualPeriods) {
		$this->annualPeriods = $annualPeriods;
	}
	
	public function getDomains() {
		return $this->domains;
	}
	public function setDomains(ArrayCollection $domains) {
		$this->domains = $domains;
	}
	
	public function getCategories() {
		return $this->categories;
	}
	public function setCategories(ArrayCollection $categories) {
		$this->categories = $categories;
	}
	
	public function getSources() {
		return $this->sources;
	}
	public function setSources(ArrayCollection $sources) {
		$this->sources = $sources;
	}
}
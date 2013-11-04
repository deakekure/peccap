<?php
namespace Report\Form\Object;

use Expenditure\Entity\Domain;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Form backing object untuk pilihan fungsi pengeluaran.
 * 
 * @author zakyalvan
 */
class DomainSelection {
	public static function createFromDomainArray(array $domains) {
		$domainSelections = array();
		
		foreach ($domains as $domain) {
			$domainSelection = new DomainSelection();
			$domainSelection->setDomain($domain);
			$domainSelections[] = $domainSelection;
		}
		
		return $domainSelections;
	}
	
	/**
	 * @var integer
	 */
	private $selection = 0;
	public function getSelection() {
		return $this->selection;
	}
	public function setSelection($selection) {
		$this->selection = $selection;
	}
	
	/**
	 * @var Domain
	 */
	private $domain;
	public function getDomain() {
		return $this->domain;
	}
	public function setDomain(Domain $domain) {
		$this->domain = $domain;
	}
}
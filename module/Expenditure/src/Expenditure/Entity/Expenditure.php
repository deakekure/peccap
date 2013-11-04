<?php
namespace Expenditure\Entity;

use Doctrine\ORM\Mapping as Orm;
use Application\Entity\Territory;
use Application\Entity\AnnualPeriod;

/**
 * Kelas entity pengeluaran.
 * 
 * @Orm\Entity(repositoryClass="Expenditure\Entity\Repository\ExpenditureRepository")
 * @Orm\Table(name="peccap_expenditure")
 * 
 * @author zakyalvan
 */
class Expenditure {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Expenditure\Entity\Domain", fetch="LAZY")
	 * @Orm\JoinColumn(name="domain_id", referencedColumnName="id")
	 * 
	 * @var Domain
	 */
	private $domain;
	public function getDomain() {
		return $this->domain;
	}
	public function setDomain(Domain $domain) {
		$this->domain = $domain;
	}
	
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Expenditure\Entity\Category", fetch="LAZY")
	 * @Orm\JoinColumn(name="category_id", referencedColumnName="id")
	 * 
	 * @var Category
	 */
	private $category;
	public function getCategory() {
		return $this->category;
	}
	public function setCategory(Category $category) {
		$this->category = $category;
	}
	
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\Territory", fetch="LAZY")
	 * @Orm\JoinColumn(name="territory_id", referencedColumnName="id")
	 * 
	 * @var Territory
	 */
	private $territory;
	public function getTerritory() {
		return $this->territory;
	}
	public function setTerritory(Territory $territory) {
		$this->territory = $territory;
	}
	
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\AnnualPeriod", fetch="LAZY")
	 * @Orm\JoinColumn(name="annual_period", referencedColumnName="year")
	 * 
	 * @var AnnualPeriod
	 */
	private $annualPeriod;
	public function getAnnualPeriod() {
		return $this->annualPeriod;
	}
	public function setAnnualPeriod(AnnualPeriod $annualPeriod) {
		$this->annualPeriod = $annualPeriod;
	}
	
	/**
	 * @Orm\Column(name="expenditure_total", type="float", nullable=false)
	 * 
	 * @var float
	 */
	private $total;
	public function getTotal() {
		return $this->total;
	}
	public function setTotal($total) {
		$this->total = $total;
	}
}
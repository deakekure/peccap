<?php
namespace Income\Entity;

use Doctrine\ORM\Mapping as Orm;
use Application\Entity\Territory;
use Application\Entity\AnnualPeriod;

/**
 * Entity pendapatan daerah.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_income")
 * 
 * @author zakyalvan
 */
class Income {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Income\Entity\Source", fetch="LAZY")
	 * @Orm\JoinColumn(name="source_name", referencedColumnName="name")
	 * 
	 * @var Source
	 */
	private $source;
	public function getSource() {
		return $this->source;
	}
	public function setSource(Source $source) {
		$this->source = $source;
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
	public function setYearPeriod(AnnualPeriod $annualPeriod) {
		$this->annualPeriod = $annualPeriod;
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
	 * @Orm\Column(name="income_total", type="float", nullable=false)
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
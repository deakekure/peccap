<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * Entity yang nyatet jumlah penduduk.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_population")
 * 
 * @author zakyalvan
 */
class Population {
	/**
	 * @Orm\Id
	 * @Orm\ManyToOne(targetEntity="Application\Entity\Territory", fetch="LAZY", inversedBy="populations")
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
	 * @Orm\Column(name="population_number", type="integer", nullable=false)
	 * 
	 * @var integer
	 */
	private $number;
	public function getNumber() {
		return $this->number;
	}
	public function setNumber($number) {
		$this->number = $number;
	}
}
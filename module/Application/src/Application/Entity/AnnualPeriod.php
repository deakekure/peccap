<?php
namespace Application\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * Perode pencatatan. Sebenarnya hanya bernilai tahun saja.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_annual_period")
 * 
 * @author zakyalvan
 */
class AnnualPeriod {
	/**
	 * @Orm\Id
	 * @Orm\Column(name="year", type="integer", nullable=false)
	 * @Orm\GeneratedValue(strategy="NONE")
	 * 
	 * @var integer
	 */
	private $year;
	public function getYear() {
		return $this->year;
	}
	public function setYear($year) {
		$this->year = $year;
	}
	
	/**
	 * @Orm\Column(name="current", type="integer", nullable=false)
	 * 
	 * @var integer
	 */
	private $current;
	public function getCurrent() {
		return $this->current;
	}
	public function setCurrent($current) {
		$this->current = current;
	}
	
	/**
	 * @return \DateTime
	 */
	public function getStart() {
		if(!$this->year) {
			return null;
		}
		return \DateTime::createFromFormat('d m Y', sprintf('01 01 %d', $this->year));
	}
	
	/**
	 * @return \DateTime
	 */
	public function getEnd() {
		if(!$this->year) {
			return null;
		}
		return \DateTime::createFromFormat('d m Y', sprintf('31 12 %d', $this->year));
	}
	
	public function __toString() {
		return (string) $this->year;
	}
}
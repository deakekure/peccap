<?php
namespace Income\Entity;

use Doctrine\ORM\Mapping as Orm;

/**
 * Entity sumber pendapatan.
 * 
 * @Orm\Entity
 * @Orm\Table(name="peccap_income_source")
 * 
 * @author zakyalvan
 */
class Source {
	/**
	 * @Orm\Id
	 * @Orm\Column(name="name", type="string", length=10)
	 * @Orm\GeneratedValue(strategy="NONE")
	 * 
	 * @var string
	 */
	private $name;
	public function getName() {
		return $this->name;
	}
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @Orm\Column(name="description", type="string", length=255, nullable=true)
	 * 
	 * @var string
	 */
	private $description;
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	
	/**
	 * @Orm\Column(name="order_number", type="integer", length=1, nullable=true)
	 *
	 * @var integer
	 */
	private $orderNumber;
}